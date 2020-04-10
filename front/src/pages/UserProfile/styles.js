import { grey } from "@material-ui/core/colors";

const styles = {
  toggleDiv: {
    marginTop: 20,
    marginBottom: 5
  },
  toggleLabel: {
    color: grey[400],
    fontWeight: 100
  },
  buttons: {
    marginTop: 30,
    float: "right"
  },
  saveButton: {
    marginLeft: 5
  },
  userAvatar: {
    marginTop: 30,
    marginBottom: 30,
    textAlign: 'center',
    borderRadius: '50%',
  },
  avatarImg: {
    cursor: 'pointer',
    textAlign: 'center',
    position: 'relative',
    borderRadius: '50%',
    maxWidth:200,
    maxHeight:150,
    width: 'auto',
    height: 'auto',
    backgroundColor: '#ddd',
    zIndex:10
  },
  hoverCircle: {
    marginTop: 20,
    marginLeft: 10,
    marginBottom: 30,
    borderRadius: '50%',
    cursor: 'pointer',
    position: 'absolute',
    textAlign: 'center',
    color: 'black',
    backgroundColor: 'white',
    opacity: 0.3,
    zIndex: 20,
    width: '85%',
    height: '80%',
  }
};

export default styles;