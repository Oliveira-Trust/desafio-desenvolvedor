
import React from "react"
import { AppTheme } from './contexts/themeContext'
import { GlobalStyles } from './styles/GlobalStyles'
import RoutesApp from './routes/routes';

const App = () => {
  return (
    <AppTheme>
        <GlobalStyles />
        <RoutesApp />
    </AppTheme>
  )
}

export default App;
