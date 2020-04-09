export const TOKEN_KEY = "token";
export const USER_DATA = "user";
export const isAuthenticated = () => localStorage.getItem(TOKEN_KEY) !== null;
export const getToken = () => localStorage.getItem(TOKEN_KEY);
export const login = async user => {
  await localStorage.setItem(TOKEN_KEY, user.auth_token);
  delete user.auth_token;
  await localStorage.setItem(USER_DATA, JSON.stringify(user));
};
export const logout = async () => {
  await localStorage.removeItem(TOKEN_KEY);
  await localStorage.removeItem(USER_DATA);
};