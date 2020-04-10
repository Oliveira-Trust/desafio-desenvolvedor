import React, { useState, useEffect } from "react";
import { ThemeProvider } from "@material-ui/core/styles";
import Paper from "@material-ui/core/Paper";
import Button from "@material-ui/core/Button";
import PersonAdd from "@material-ui/icons/PersonAdd";
import Help from "@material-ui/icons/Help";
import TextField from "@material-ui/core/TextField";
import Fade from '@material-ui/core/Fade';
import Collapse from '@material-ui/core/Collapse';

import theme from "../../theme";
import styles from "./styles";

import api from "../../services/api";
import { login } from "../../services/auth";

import { useDispatch } from "react-redux";

function LoginPage() {
  const dispatch = useDispatch()

  const [user, setUser] = useState({
    email: "",
    password: ""
  })

  const [error, setError] = useState({
    value: false,
    errorMessage:""
  })

  const [loaded, setLoaded] = useState(false)
  const [isButtonDisabled, setIsButtonDisabled] = useState(true)
  
  useEffect(() => {
    if (user.email.trim() && user.password.trim()) {
      setIsButtonDisabled(false);
    } else {
      setIsButtonDisabled(true);
    }
    setLoaded(true)
  }, [user.email, user.password]);

  const LoginUser = (e) => {
    e.preventDefault();
    api.post("/auth/login", user)
      .then(async (res) => {
        await dispatch({type: 'SAVE_USER_DATA', user: res.data.data})
        login(res.data.data);
        window.location.href = "/";
      })
      .catch((err) => {
        if(err.response) {
          setError({ value: true, errorMessage: err.response.data.message });
        }
      });
  }

  const handleFieldChange = (field, value) => {
    setError({value: false, errorMessage: ""})
    setUser({...user,  [field]: value})
  }

  return (
    <ThemeProvider theme={theme}>
      <div>
        <div style={styles.loginContainer}>
          <Collapse in={loaded}>
            <div>
              <Paper style={styles.paper}>
                <form onSubmit={LoginUser}>
                  <TextField 
                    label="E-mail" 
                    fullWidth={true}
                    required
                    error={error.value}
                    helperText={error.errorMessage}
                    onChange={(e) => handleFieldChange('email', e.target.value)} />
                  
                  <div style={{ marginTop: 16 }}>
                    <TextField 
                      label="Senha" 
                      fullWidth={true} 
                      required
                      error={error.value}
                      type="password" 
                      onChange={(e) => handleFieldChange('password', e.target.value)} />
                  </div>

                  <div style={{ marginTop: 10 }}>
                    <Button
                      type="submit"
                      variant="contained" 
                      color="primary" 
                      style={styles.loginBtn}
                      disabled={isButtonDisabled}>
                      Login
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
              <Button href="/registrar" style={styles.flatButton}>
                <PersonAdd />
                <span style={{ margin: 5 }}>Registrar</span>
              </Button>
            </div>
          </Fade>
        </div>
      </div>
    </ThemeProvider>
  );
};

export default LoginPage;
