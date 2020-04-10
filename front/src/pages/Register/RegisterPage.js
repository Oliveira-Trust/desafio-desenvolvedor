import React, { useState, useEffect } from "react";
import { ThemeProvider } from "@material-ui/core/styles";
import Paper from "@material-ui/core/Paper";
import Button from "@material-ui/core/Button";
import PersonAdd from "@material-ui/icons/PersonAdd";
import TextField from "@material-ui/core/TextField";
import theme from "../../theme";
import Collapse from '@material-ui/core/Collapse';
import styles from "./styles";
import Fade from '@material-ui/core/Fade';

import { useDispatch } from "react-redux";

import api from "../../services/api";
import { login } from "../../services/auth";

function RegisterPage() {

  const dispatch = useDispatch()

  const [user, setUser] = useState({
    name: "",
    email: "",
    password: ""
  })

  const [error, setError] = useState({
    errorMessages:""
  })

  const [isButtonDisabled, setIsButtonDisabled] = useState(true)
  const [loaded, setLoaded] = useState(false)
  
  useEffect(() => {
    if (user.name.trim() && user.email.trim() && user.password.trim()) {
      setIsButtonDisabled(false);
    } else {
      setIsButtonDisabled(true);
    }
    setLoaded(true)
  }, [user.name, user.email, user.password]);

  const registerUser = (e) => {
    e.preventDefault();
    api.post("/auth/register", user)
      .then(async (res) => {
        await dispatch({type: 'SAVE_USER_DATA', user: res.data.data})
        login(res.data.data);
        window.location.href = "/";
      })
      .catch((err) => {
        if(err.response) {
          setError({ errorMessages: err.response.data.errors });
        }
      });
  };

  const handleFieldChange = (field, value) => {
    setError({errorMessages: {}})
    setUser({...user,  [field]: value})
  }

  return (
    <ThemeProvider theme={theme}>
      <div>
          <div style={styles.loginContainer}>
            <Collapse in={loaded}>
              <div>
                <Paper style={styles.paper}>
                  <form onSubmit={registerUser}>
                    <TextField 
                      label="Nome" 
                      fullWidth={true}
                      required
                      error={Boolean(error.errorMessages.name)}
                      onChange={(e) => handleFieldChange('name', e.target.value)}/>
                  
                    <div style={{ marginTop: 16 }}>
                      <TextField 
                        label="E-mail" 
                        fullWidth={true}
                        required
                        error={Boolean(error.errorMessages.email)}
                        helperText={error.errorMessages.email ? error.errorMessages.email[0] : ""}
                        onChange={(e) => handleFieldChange('email', e.target.value)}/>
                    </div>
                  
                    <div style={{ marginTop: 16 }}>
                      <TextField
                        label="Senha"
                        fullWidth={true}
                        required
                        error={Boolean(error.errorMessages.password)}
                        helperText={error.errorMessages.password ? error.errorMessages.password[0] : ""}
                        type="password"
                        onChange={(e) => handleFieldChange('password', e.target.value)}/>
                    </div>
                  
                    <div style={{ marginTop: 10 }}>
                      <Button 
                        type="submit"
                        variant="contained" 
                        color="primary" 
                        style={styles.loginBtn}
                        disabled={isButtonDisabled}>
                        Registrar
                      </Button>
                    </div>
                  </form>
                </Paper>
              </div>
            </Collapse>
            <Fade 
              in={loaded}
              style={{ transformOrigin: '0 0 0' }}
              {...(loaded ? { timeout: (2500)  } : {})}>
              <div style={styles.buttonsDiv} >
                <Button href="/login" style={styles.flatButton}>
                  <PersonAdd />
                  <span style={{ margin: 5 }}>Login</span>
                </Button>
              </div>
            </Fade> 
          </div>
      </div>
    </ThemeProvider>
  );
}

export default RegisterPage;
