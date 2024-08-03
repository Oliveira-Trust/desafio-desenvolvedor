import { BrowserRouter as Router, Routes, Route } from "react-router-dom";

import { AuthProvider } from './context/AuthContext.jsx';
import { SnackbarProvider, useSnackbar } from 'notistack'

import NavBar from './components/NavBar.jsx';

import LandingPage from './pages/LandingPage.jsx';
import Login from './pages/Login.jsx';
import Register from './pages/Register.jsx';
import Profile from "./pages/Profile.jsx";
import Exchange from './pages/Exchange.jsx';
import Config from "./pages/Config.jsx";

import './App.css';

function App() {
  return (
    <AuthProvider>
      <SnackbarProvider anchorOrigin={{ vertical: 'top', horizontal: 'center' }}>
        <Router>
          <NavBar/>
          <Routes>
            <Route path="/" element={ <LandingPage/> }/>
            <Route path="/login" element={ <Login/> }/>
            <Route path="/register" element={ <Register/> }/>
            <Route path="/profile" element={ <Profile/> }/>
            <Route path="/exchange" element={ <Exchange/> }/>
            <Route path="/config" element={ <Config/> }/>
          </Routes>
        </Router>
      </SnackbarProvider>
    </AuthProvider>
  );
}

export default App;
