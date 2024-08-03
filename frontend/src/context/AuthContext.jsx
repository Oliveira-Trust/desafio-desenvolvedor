import { createContext, useRef } from "react";

export const AuthContext = createContext();

export const AuthProvider = ({ children }) => {
  let token = useRef(localStorage.getItem('token'));
  let user = useRef(JSON.parse(localStorage.getItem('user')));

  const setTokenValue = (tokenValue) => {
    localStorage.setItem('token', tokenValue);
    token.current = tokenValue;
  }

  const setUserValue = (userValue) => {
    localStorage.setItem('user', JSON.stringify(userValue));
    user.current = userValue;
  }

  const logout = () => {
    localStorage.removeItem('token');
    localStorage.removeItem('user');
    token.current = '';
    user.current = '';
  }

  const isAuthenticated = () => {
    return localStorage.getItem('token') && localStorage.getItem('user');
  }

  const isAdmin = () => {
    return user?.current?.type === 'admin';
  }

  const firstName = () => {
    return user.current.name.split(' ')[0];
  }

  const userProfilePicture = () => {
    return user?.current?.profile_picture;
  }

  return (
    <AuthContext.Provider
      value={{
        token,
        setTokenValue,
        user,
        firstName,
        userProfilePicture,
        setUserValue,
        logout,
        isAuthenticated,
        isAdmin,
      }}
    >
      {children}
    </AuthContext.Provider>
  )
}