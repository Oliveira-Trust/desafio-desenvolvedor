import React from "react";
import Button from "@material-ui/core/Button";
import Dialog from '@material-ui/core/Dialog';
import DialogActions from '@material-ui/core/DialogActions';
import DialogContent from '@material-ui/core/DialogContent';
import DialogContentText from '@material-ui/core/DialogContentText';
import DialogTitle from '@material-ui/core/DialogTitle';

export default function ConfirmationModal(props) {
  const styles = {
    buttons: {
      marginTop: 30,
      float: "right"
    },
    saveButton: {
      marginLeft: 10
    },
    customColorButton: {
      marginLeft: 10,
      backgroundColor: props.confirmcolor
    }
  };

  return (
    <Dialog
      {...props}
      // { onHide(true or false), title, body, confirmcolor, confirmtext }
      fullWidth={true}
      maxWidth="sm"
      aria-labelledby="contained-modal"
      onClose={() => props.onClose(false)}
    >
      <DialogTitle>
        { props.title ? props.title : "Confirmação" }
      </DialogTitle>
      <DialogContent>
        <DialogContentText>
          { props.body ? props.body : "Tem certeza que deseja fazer isso?" }
        </DialogContentText>

      </DialogContent>
      <DialogActions>
        <div style={styles.buttons}>
          <Button variant="contained" onClick={() => props.onClose(false)}>Cancelar</Button>
          <Button
            style={props.confirmcolor ? styles.customColorButton : styles.saveButton}
            variant="contained"
            type="submit"
            color="primary"
            onClick={() => props.onClose(true)}
          >
            { props.confirmtext ? props.confirmtext : "Confirmar" }
          </Button>
        </div>
      </DialogActions>
    </Dialog>
  );
}