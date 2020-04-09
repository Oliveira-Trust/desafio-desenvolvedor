import { combineReducers } from "redux";
import user from "./user";
import snackbar from "./snackbar";

export default combineReducers({
  user,
  snackbar
});