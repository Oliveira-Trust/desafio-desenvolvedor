import React, { createContext, useState, useContext } from 'react';
import api from '../services/api';

const AuthContext = createContext();

const AuthProvider = ({ children })=> {
  const [data, setData] = useState(() => {
    const token = localStorage.getItem('token');
    if (token) {
      api.defaults.headers.Authorization = `${token}`;
      return { token };
    }
    return {};
  });
  const signIn = async ({ username, password }) => {
    const response = await api.post('singin', {
      username,
      password,
    });
    const { token } = response.data;
    localStorage.setItem('token', token);
    api.defaults.headers.Authorization = `${token}`;
    setData({ token });
  };
  const signOut = ()=> {
    localStorage.removeItem('token');
    localStorage.removeItem('user');
    setData({});
  };

  return (
    <AuthContext.Provider
      value={{ token: data.token, signIn, signOut }}
    >
      {children}
    </AuthContext.Provider>
  );
};
const useAuth = () => {
  const context = useContext(AuthContext);
  if (!context) {
    throw new Error('UseAuth deve ser utilizado junto com o AuthProvider');
  }
  return context;
}
export { AuthProvider, useAuth };