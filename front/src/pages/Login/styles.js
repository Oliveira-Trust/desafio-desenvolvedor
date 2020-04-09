import { grey } from "@material-ui/core/colors";

const styles = {
  loginContainer: {
    minWidth: 320,
    maxWidth: 400,
    height: "auto",
    position: "absolute",
    top: "20%",
    left: 20,
    right: 20,
    margin: "auto"
  },
  customlogo: {
    color: "rgb(158, 158, 158)", 
    fontSize: 40
  },
  paper: {
    padding: 20,
    overflow: "auto",
    backgroundColor: "#eeeeee"
  },
  buttonsDiv: {
    textAlign: "center",
    padding: 10
  },
  flatButton: {
    color: grey[500],
    margin: 5
  },
  checkRemember: {
    style: {
      float: "left",
      maxWidth: 180,
      paddingTop: 5
    },
    labelStyle: {
      color: grey[500]
    },
    iconStyle: {
      color: grey[500],
      borderColor: grey[500],
      fill: grey[500]
    }
  },
  loginBtn: {
    float: "right"
  },
  btn: {
    background: "#4f81e9",
    color: "white",
    padding: 7,
    borderRadius: 2,
    margin: 2,
    fontSize: 13
  },
  btnSpan: {
    marginLeft: 5
  }
};

export default styles;