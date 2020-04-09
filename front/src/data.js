import React from "react";
import Faker from "faker";
// import Assessment from "@material-ui/icons/Assessment";
// import GridOn from "@material-ui/icons/GridOn";
import PermIdentity from "@material-ui/icons/PermIdentity";
import OpenInBrowserIcon from '@material-ui/icons/OpenInBrowser';
// import Web from "@material-ui/icons/Web";
// import Home from "@material-ui/icons/Home";
import MenuBook from "@material-ui/icons/MenuBook";
import ReplyRoundedIcon from "@material-ui/icons/ReplyRounded";
import ForumIcon from '@material-ui/icons/Forum';
// import BorderClear from "@material-ui/icons/BorderClear";
// import BorderOuter from "@material-ui/icons/BorderOuter";
// import api from "./services/api"

const data = {
  menus: [
    { text: "Clientes", icon: <MenuBook />, link: "/clientes" },
    { text: "Produtos", icon: <OpenInBrowserIcon />, link: "/produtos" },
    { text: "Pedidos", icon: <PermIdentity />, link: "/pedidos" },

    { text: "Sair", icon: <ReplyRoundedIcon />, link: "/logout" },
    // { text: "DashBoard", icon: <Assessment />, link: "/dashboard" },
    // { text: "Form Page", icon: <Web />, link: "/form" },
    // {
    //   text: "Table Page",
    //   icon: <GridOn />,
    //   // link: "/table",
    //   subMenus: [
    //     {
    //       text: "Basic Table",
    //       icon: <BorderClear />,
    //       link: "/table/basic"
    //     },
    //     {
    //       text: "Data Table",
    //       icon: <BorderOuter />,
    //       link: "/table/data"
    //     }
    //   ]
    // },
    // { text: "Login Page", icon: <PermIdentity />, link: "/login" }

  ],
  isLoggedIn: false,
  user: {
    userName: `${Faker.name.firstName()} ${Faker.name.lastName()}`,
    avatar: null,// 'https://secure.gravatar.com/avatar/6a892a927dfbe1345572ab1e34780f0a?s=800&d=identicon'
  },
  tablePage: {
    items: Array.from({ length: 105 }, (item, index) => ({
      id: index,
      name: Faker.commerce.productName(),
      price: Faker.commerce.price(),
      category: Faker.commerce.productMaterial()
    }))
  }
};

export default data;
