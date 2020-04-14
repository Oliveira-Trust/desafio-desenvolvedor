import React, {useState, useEffect} from "react";
import Modal from "react-bootstrap/Modal";
import Button from "@material-ui/core/Button";
import Input from '@material-ui/core/Input';

export default function FileUploadModal(props) {
  const styles = {
    buttons: {
      marginTop: 30,
      float: "right"
    },
    saveButton: {
      marginLeft: 10
    },
  };
  
  useEffect(() => {
    setFile('')
  },[])
  const [file, setFile] = useState('');

  const handleUpload = async (uploadedFile) => {
    await setFile(uploadedFile)
  }

  return (
    <Modal
      {...props}
      // { onHide(true or false), title, confirmtext }
      size="md"
      aria-labelledby="contained-modal"
      style={{zIndex: 99999}}
    >
      <Modal.Header closeButton>
        <Modal.Title id="contained-modal">
            { props.title ? props.title : "Upload de Arquivo" }
        </Modal.Title>
      </Modal.Header>
      <Modal.Body>
        <p>
          Faça upload do seu arquivo aqui!
        </p>
          <Input
            accept="image/*"
            // style={{ display: 'none' }}
            id="upload-component"
            onChange={e => handleUpload(e.target.files[0])}
            type="file"
          />
          {/* <label htmlFor="upload-component">
            <Button component="span">
                Upload
            </Button>
        </label>  */}
        <div style={styles.buttons}>
          <Button
            style={styles.saveButton}
            variant="contained"
            type="submit"
            color="primary"
            disabled={file === ''}
            onClick={() => props.onHide(file)}
          >
            { props.confirmtext ? props.confirmtext : "Salvar" }
          </Button>
        </div>
      </Modal.Body>
    </Modal>
  );
}