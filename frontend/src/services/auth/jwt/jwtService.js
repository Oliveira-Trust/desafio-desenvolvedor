import jwtDefaultConfig from '@/services/auth/jwt/jwtDefaultConfig.js'

export default class JwtService {
  axiosIns = null

  jwtConfig = { ...jwtDefaultConfig }

  isAlreadyFetchingAccessToken = false

  constructor(axiosIns, jwtOverrideConfig) {
    this.axiosIns = axiosIns
    this.jwtConfig = { ...this.jwtConfig, ...jwtOverrideConfig }

    // Request Interceptor
    this.axiosIns.interceptors.request.use(
      config => {
        const accessToken = this.getToken()

        if (accessToken) {
          config.headers.Authorization = `${this.jwtConfig.tokenType} ${accessToken}`
        }

        return config
      },
      error => Promise.reject(error),
    )

    this.axiosIns.interceptors.response.use(
      response => response,
      error => {
        const { config, response } = error
        const originalRequest = config

        if (response && response.status === 401) {
          const refreshToken = this.getRefreshToken();
          if (!this.isAlreadyFetchingAccessToken && refreshToken) {
            this.isAlreadyFetchingAccessToken = true
            this.refreshToken().then(r => {
              this.isAlreadyFetchingAccessToken = false

              // Update accessToken in localStorage
              this.setToken(r.data.accessToken)
              this.setRefreshToken(r.data.refreshToken)

              this.onAccessTokenFetched(r.data.accessToken)
            })

            const retryOriginalRequest = new Promise(resolve => {
              this.addSubscriber(accessToken => {
                // Make sure to assign accessToken according to your response.
                // Check: https://pixinvent.ticksy.com/ticket/2413870
                // Change Authorization header
                originalRequest.headers.Authorization = `${this.jwtConfig.tokenType} ${accessToken}`
                resolve(this.axiosIns(originalRequest))
              })
            })
            return retryOriginalRequest
          }
        }
        return Promise.reject(error)
      },
    )
  }

  getToken() {
    return store.state.Auth.accessToken;
  }

  getRefreshToken() {
    return localStorage.getItem(this.jwtConfig.storageRefreshTokenKeyName)
  }

  setToken(value) {
    return store.dispatch('Auth/updateAccessToken',value);
  }

  setRefreshToken(value) {
    if(!value){
      return localStorage.removeItem(this.jwtConfig.storageRefreshTokenKeyName)
    }
    localStorage.setItem(this.jwtConfig.storageRefreshTokenKeyName, value)
  }

  login(...args) {
    return this.axiosIns.post(this.jwtConfig.loginEndpoint, ...args)
  }

  register(...args) {
    return this.axiosIns.post(this.jwtConfig.registerEndpoint, ...args)
  }

  refreshToken() {
    return this.axiosIns.post(this.jwtConfig.refreshEndpoint, {
      refreshToken: this.getRefreshToken(),
    })
  }
}
