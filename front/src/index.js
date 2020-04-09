import React from "react";
import { render } from "react-dom";
import { Router, Route, Switch } from "react-router-dom";
import { Provider } from "react-redux";
import { createBrowserHistory } from "history";
import registerServiceWorker from "./registerServiceWorker";
import "./styles.scss";
import "font-awesome/css/font-awesome.css";
import "bootstrap/dist/css/bootstrap.min.css";
import App from "./pages/App";
import Login from "./pages/Login/LoginPage";
import Register from "./pages/Register/RegisterPage";
import store from "./store";
import AppSnackbar from "./components/AppSnackbar";

import { isAuthenticated } from "./services/auth";

const history = createBrowserHistory();

// console.log(isAuthenticated())
render(
  <div>
    <Provider store={store}>
      <AppSnackbar />
      <Router history={history}>
        <Switch>
          <Route
            exact={!isAuthenticated()}
            path="/"
            render={ (props) => (
              isAuthenticated()
                ? <App {...props} />
                : window.location.href = "/login"// <Redirect from="/" to="/login" /> 
            ) }
          />
          <Route exact path="/login" component={Login} />
          <Route path="/registrar" component={Register} />
        </Switch>
      </Router>
    </Provider>
  </div>,
  document.getElementById("root")
);
registerServiceWorker();
