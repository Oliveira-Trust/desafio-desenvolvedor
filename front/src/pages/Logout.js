import React from "react";
import { logout } from "../services/auth";

export default function Logout() {
  logout();
  window.location.href = "/login";
  return (<> </>);
}
