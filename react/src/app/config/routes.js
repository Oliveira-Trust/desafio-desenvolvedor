import React from "react";
import {
  Redirect
} from "react-router-dom";
import Categories from "../main/category/Categories";
import Products from "../main/product/Products";
import Customers from "../main/customer/Customers";

export const routes = [
  {
    path: "/",
    exact: true,
    component: () => <Redirect to="/product" />
  },
  {
    path: "/customer",
    exact: true,
    component: Customers
  },
  {
    path: "/product",
    exact: true,
    component: Products
  },
  {
    path: "/category",
    exact: true,
    component: Categories
  }

];
