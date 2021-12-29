
import React from "react"
import { AppTheme } from './contexts/themeContext'
import { GlobalStyles } from './styles/GlobalStyles'
import { DataProvider } from "./contexts/dataContext"
import 'animate.css'
import RoutesApp from './routes/routes';
import { AuthProvider } from "./contexts/userContext"

const App = () => {
  return (
    <AppTheme>
      <GlobalStyles />
      <DataProvider>
        <AuthProvider>
          <RoutesApp />
        </AuthProvider>
      </DataProvider>
    </AppTheme>
  )
}

export default App;
