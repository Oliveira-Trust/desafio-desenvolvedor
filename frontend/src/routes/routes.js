import React from "react";
import { Switch, Route, BrowserRouter } from "react-router-dom";

import PageLogin from "../pages/Login";
import PageHome from '../pages/Home'
import PageHistorico from "../pages/Historico";
import PageNotFound from "../pages/NotFound";

const routes = [
  { path: '/', exact: true, Component: PageHome },
  { path: '/login', exact: false, Component: PageLogin },
  { path: '/conversoes', exact: true, Component: PageHistorico },
  { path: '*', exact: false, Component: PageNotFound }
]
const AppRoutes = () => {

  return (
    <BrowserRouter>
        <Switch>
          {routes.map(({ path, exact, Component }) =>
            <Route key={path} exact={exact} path={path}>
                <Component />
            </Route>
          )}
        </Switch>
    </BrowserRouter>
  )
}

export default AppRoutes