const userKey = "_conversion_user";

export const isAuthenticated = () => localStorage.getItem(userKey) !== null;

export const getToken = () => localStorage.getItem(userKey);

export const singIn = token => {
  localStorage.setItem(userKey, token);
}

export const logout = () => {
  localStorage.removeItem(userKey);
}