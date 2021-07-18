import React from "react";
import { Container } from "react-bootstrap";
import {
  Route, Switch
} from "react-router-dom";
import './App.css';
import { routes } from "./config/routes";
import useToken from "./config/useToken";
import Navigation from "./layout/Navigation";
import Login from "./main/login/Login";

const classes = {
  navigation: {
    marginTop: '80px'
  }
};

function App(props) {

  const { token, setToken, removeToken, setInterceptor } = useToken();

  if (!token) {
    return <Login setToken={setToken} />
  }

  setInterceptor()

  return (
    <>
      <Navigation removeToken={removeToken} />
      <Container style={classes.navigation}>
        <Switch>
          {routes.map((route, i) => (
            <Route
              key={i}
              path={route.path}
              exact={route.exact}
              component={route.component} />
          ))}
        </Switch>
      </Container>
    </>
  );
}

export default App;