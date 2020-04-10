import React from "react";
import ShoppingCartIcon from '@material-ui/icons/ShoppingCart';
import ExtensionIcon from '@material-ui/icons/Extension';
import PeopleIcon from '@material-ui/icons/People';
import ReplyRoundedIcon from "@material-ui/icons/ReplyRounded";

const data = {
  menus: [
    { text: "Clientes", icon: <PeopleIcon />, link: "/clientes" },
    { text: "Produtos", icon: <ExtensionIcon />, link: "/produtos" },
    { text: "Pedidos", icon: <ShoppingCartIcon />, link: "/pedidos" },
    { text: "Sair", icon: <ReplyRoundedIcon />, link: "/logout" },
  ]
};

export default data;
