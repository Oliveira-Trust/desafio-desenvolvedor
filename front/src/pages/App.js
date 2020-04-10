import React, { useState, useEffect } from "react";
import { Route, Switch } from "react-router-dom";
import classNames from "classnames";
import defaultTheme from "../theme";
import { ThemeProvider } from "@material-ui/core/styles";
import Header from "../components/Header";
import LeftDrawer from "../components/LeftDrawer";
import Data from "../data";
import NotFound from "./NotFoundPage/NotFoundPage";
import UserProfile from "./UserProfile/UserProfile";
import ClientList from "./Clients/ClientList/ClientList";
import ProductList from "./Products/ProductList/ProductList";
import OrderList from "./Orders/OrderList/OrderList";
import Logout from "./Logout";
import { useSelector, useDispatch } from "react-redux";
import { makeStyles } from "@material-ui/core/styles";

import { isAuthenticated, logout } from "../services/auth";
import api from "../services/api";
import { hot } from 'react-hot-loader/root';

const useStyles = makeStyles(theme => ({
  container: {
    margin: "80px 20px 20px 15px",
    paddingLeft: defaultTheme.drawer.width,
    [defaultTheme.breakpoints.down("sm")]: {
      paddingLeft: 0
    }
  },
  containerFull: {
    paddingLeft: defaultTheme.drawer.miniWidth,
    [defaultTheme.breakpoints.down("sm")]: {
      paddingLeft: 0
    }
  },
  settingBtn: {
    top: 80,
    backgroundColor: "rgba(0, 0, 0, 0.3)",
    color: "white",
    width: 48,
    right: 0,
    height: 48,
    opacity: 0.9,
    padding: 0,
    zIndex: 999,
    position: "fixed",
    minWidth: 48,
    borderTopRightRadius: 0,
    borderBottomRightRadius: 0
  }
}));

function App(props) {
  const user = useSelector(state => state.user)
  const dispatch = useDispatch()
  const classes = useStyles()

  const [state, setState] = useState({
    theme: defaultTheme,
    navDrawerOpen:
      window && window.innerWidth && window.innerWidth >= defaultTheme.breakpoints.values.md
        ? true
        : false
  })

  useEffect(() => {
    // Get user data
    api.get("/auth/by-token")
    .then((res) => {
      dispatch({type: 'SAVE_USER_DATA', user: res.data.data})
      localStorage.setItem("token", res.data.data.auth_token);
      delete res.data.data.auth_token;
      localStorage.setItem("user", JSON.stringify(res.data.data));
      })
      .catch((err) => {
        logout();
        props.history.push("/login");
        console.log("token expired");
      });
  },[props, dispatch])

  const handleChangeNavDrawer = () => {
    setState({
      theme: defaultTheme,
      navDrawerOpen: !state.navDrawerOpen
    });
  }

  // const handleChangeTheme = colorOption => {
  //   const theme = customTheme({
  //     palette: colorOption
  //   });
  //   setState({
  //     theme
  //   });
  // }
  return (
    <ThemeProvider theme={state.theme}>
      <Header handleChangeNavDrawer={handleChangeNavDrawer} navDrawerOpen={state.navDrawerOpen} history={props.history}/>
      <LeftDrawer
        user={user}
        history={props.history}
        isLogged={isAuthenticated()}
        navDrawerOpen={state.navDrawerOpen}
        handleChangeNavDrawer={handleChangeNavDrawer}
        menus={Data.menus}
      />
      <div className={classNames(classes.container, !state.navDrawerOpen && classes.containerFull)}>
        <Switch>
          <Route path="/clientes" component={ClientList} />
          <Route path="/produtos" component={ProductList} />
          <Route path="/pedidos" component={OrderList} />
          <Route path="/perfil/:user" component={UserProfile} />
          <Route path="/logout" component={Logout} />
          <Route component={NotFound} />
        </Switch>
      </div>
    </ThemeProvider>
  );
}

export default hot(App);
