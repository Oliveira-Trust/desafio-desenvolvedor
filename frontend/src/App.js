
import React from "react"
import { AppTheme } from './contexts/themeContext'
import { GlobalStyles } from './styles/GlobalStyles'
import RoutesApp from './routes/routes';
import { AuthProvider } from "./contexts/authContext";

const App = () => {
  return (
    <AppTheme>
      <AuthProvider>
        <GlobalStyles />
        <RoutesApp />
      </AuthProvider>
    </AppTheme>
  )
}

export default App;
