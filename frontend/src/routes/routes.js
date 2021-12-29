import React from "react";
import { Switch, Route, BrowserRouter } from "react-router-dom";

import PageLogin from "../pages/Login";
import PageSingup from "../pages/Singup";
import PageHome from '../pages/Home'
import PageHistorico from "../pages/Historico";
import PageNotFound from "../pages/NotFound";
import PrivateRoute from "./privateRoute";

const routes = [
  { path: '/', exact: true, Component: PageHome },
  { path: '/login', exact: false, Component: PageLogin },
  { path: '/singup', exact: true, Component: PageSingup },
  { path: '/conversoes', exact: true, Component: PageHistorico },
  { path: '*', exact: false, Component: PageNotFound }
]
const AppRoutes = () => {

  return (
    <BrowserRouter>
        <Switch>
          <Route path="/login" exact component={PageLogin} />
          <Route path="/singup" exact component={PageSingup} />
          <PrivateRoute path="/" exact component={PageHome} />
          <PrivateRoute path="/conversoes" exact component={PageHistorico} />
          <Route path="*" component={PageNotFound} />
        </Switch>
    </BrowserRouter>
  )
}

export default AppRoutes