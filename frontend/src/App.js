
import React from "react"
import { AppTheme } from './contexts/themeContext'
import { GlobalStyles } from './styles/GlobalStyles'
import { DataProvider } from "./contexts/dataContext"
import 'animate.css'
import RoutesApp from './routes/routes';

const App = () => {
  return (
    <AppTheme>
      <GlobalStyles />
      <DataProvider>
        <RoutesApp />
      </DataProvider>
    </AppTheme>
  )
}

export default App;
