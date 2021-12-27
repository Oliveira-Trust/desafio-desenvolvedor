import { createContext, useContext, useEffect, useState } from "react";
import { ThemeProvider } from "styled-components";
import { darkTheme } from "../styles/darkTheme";
import { lightTheme } from "../styles/lightTheme";

const ThemeContext = createContext();

export const useThemeToggler = () => {
  const context = useContext(ThemeContext);
  if (!context) {
    throw new Error("A troca de thema deve estar dentro do contexto.");
  }
  return context;
};

export const AppTheme = ({ children }) => {
  const [isDark, setIsDark] = useState(false);

  const getFromLocalStorage = () => {
    const themeFromLS = localStorage.getItem("darkMode");
    if (themeFromLS) {
      setIsDark(themeFromLS === "true");
    }
  }
  const setToLocalStorage = () => {
    return localStorage.setItem("darkMode", isDark);
  }

  useEffect(getFromLocalStorage, []);
  useEffect(setToLocalStorage, [isDark]);

  const toggleTheme = () => {
    setIsDark(c => !c);
  }

  return (
    <ThemeContext.Provider value={{ isDark, toggleTheme }}>
      <ThemeProvider theme={isDark ? darkTheme : lightTheme}>{children}</ThemeProvider>
    </ThemeContext.Provider>
  );
};
