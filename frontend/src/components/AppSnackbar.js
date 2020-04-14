import React from "react";
import { useDispatch, useSelector } from "react-redux";
import Snackbar from "@material-ui/core/Snackbar";
// import Slide from '@material-ui/core/Slide';
import IconButton from "@material-ui/core/IconButton";
import CloseIcon from "@material-ui/icons/Close";
import { clearSnackbar } from "../_actions/snackbar";

export default function AppSnackbar() {
  const dispatch = useDispatch();

  const { snackbarMessage, snackbarOpen } = useSelector(
    state => state.snackbar
  );

  function handleClose() {
    dispatch(clearSnackbar());
  }

  return (
    <Snackbar
      // bodyStyle={{ backgroundColor: 'white', color: 'black' }}
      anchorOrigin={{
        vertical: "bottom",
        horizontal: "left"
      }}
      open={snackbarOpen}
      autoHideDuration={4000}
      onClose={handleClose}
      aria-describedby="client-snackbar"
      message={
        <span id="client-snackbar">
          {snackbarMessage}
        </span>
      }
      action={[
        <IconButton
          key="close"
          aria-label="close"
          color="inherit"
          onClick={handleClose}
        >
          <CloseIcon />
        </IconButton>
      ]}
      // transition={}
    />
  );
}