import React, { useState, useEffect } from "react";
import { Link } from "react-router-dom";
import Button from "@material-ui/core/Button";
import TextField from "@material-ui/core/TextField";
import PageBase from "../../components/PageBase";
import styles from "./styles";
import { Row, Col } from 'react-bootstrap';
import CreateIcon from '@material-ui/icons/Create';
import Fade from '@material-ui/core/Fade';

import api from "../../services/api";

import { useSelector, useDispatch } from "react-redux";

import FileUploadModal from "../../components/FileUploadModal";

function UserProfile (props) {
  const userState = useSelector(state => state.user)
  const dispatch = useDispatch()

  const [user, setUser] = useState({
    name: "",
    email: "",
    role: "",
    avatar_url: null,
  })
  const [avatarHover, setAvatarHover] = useState(false)
  const [uploadModalShow, setUploadModalShow] = useState(false)
  const [isAuth, setIsAuth] = useState(false)

  useEffect(() => {
    setIsAuth(parseInt(userState.id) === parseInt(props.match.params.user))
    
    const fetchUser = () => {
      api.get(`/user/${parseInt(props.match.params.user)}`)
        .then((res) =>{
          setUser(res.data.data)
        })
        .catch((err) => {
          if(err.response && err.response.status === 404) {
            props.history.push('/404');
          }
        });
    }
    fetchUser()
  }, [props, userState.id])
  
  const getUser = async () => {
    await api.get(`/user/${parseInt(props.match.params.user)}`)
    .then((res) =>{
      setUser(res.data.data)
    })
  }
  const handleSubmit = async (e) => {
    e.preventDefault();

    if(isAuth) {
      await api.patch("/user/auth-update", user)
        .then((res) =>{
          dispatch({type: 'SNACKBAR_SHOW', message: "Dados alterados com sucesso"})
          dispatch({type: 'SAVE_USER_DATA', user: res.data.data})
        })

    } else {
      delete user.auth_token;
      await api.patch(`/user/${user.id}`, user)
        .then((res) =>{
          dispatch({type: 'SNACKBAR_SHOW', message: "Usuário alterado com sucesso"})
        })
    }
  }

  const handleAvatarChange = () => {
    setUploadModalShow(true)
  }

  /**
   * upon confirmation, save the file uploaded by user
   */
  const handleUploadSave = async file => {
    if(file) {
      const data = new FormData() 
      data.append('avatar', file)

      await api.post('/user/avatar-upload', data)
      await api.get('/auth/by-token')
        .then((res) => {
          dispatch({type: 'SAVE_USER_DATA', user: res.data.data})
          getUser()
        })
      setUploadModalShow(false)
    } else {
      setUploadModalShow(false)
    }
  }


  return (
    <PageBase title={"Perfil"}>
      <div>
        {uploadModalShow && 
          <FileUploadModal
            show={uploadModalShow}
            onHide={handleUploadSave}
          />
        }  
        <Fade
          in={true}
          style={{ transformOrigin: '0 0 0' }}
          {...(true ? { timeout: (1000)  } : {})}>
          <form onSubmit={handleSubmit}>
            <Row>
              <Col xs={12} sm={12} md={12} lg={12} >
                <Row>
                  <Col xs={12} sm={12} md={4} lg={4}>
                    {/* Div on avatar hover */}
                    {avatarHover && 
                      <div 
                        style={styles.hoverCircle} 
                        onClick={() => { return isAuth ? handleAvatarChange() : null}}
                        onMouseLeave={() => setAvatarHover(false)}>
                        <div style={{marginTop: 70}}>
                          <CreateIcon fontSize="large" />
                        </div>
                      </div> 
                    }
                    {/* Avatar div */}
                    <div style={styles.userAvatar}>
                      <img 
                        style={styles.avatarImg}
                        alt="user-profile"
                        src={user.avatar ? user.avatar_url : require('../../images/user-profile.png')}
                        onMouseEnter={() => { return isAuth ? setAvatarHover(true) : null}}
                        onClick={() => { return isAuth ? handleAvatarChange() : null}}
                      />
                    </div>
                  </Col>
                  <Col xs={12} sm={12} md={8} lg={8}>
                  <TextField
                    label="Nome"
                    fullWidth={true}
                    margin="normal"
                    value={user.name}
                    onChange={(e) => setUser({...user, name: e.target.value})}
                  />

                  <TextField
                    label="E-mail"
                    fullWidth={true}
                    margin="normal"
                    value={user.email}
                    onChange={(e) => setUser({...user, email: e.target.value})}
                  />
                  </Col>
                </Row>
              </Col>
            </Row>


            <div style={styles.buttons}>
              <Button variant="contained" onClick={() => props.history.goBack()}>Voltar</Button>

              <Button
                style={styles.saveButton}
                variant="contained"
                type="submit"
                color="primary"
              >
                {isAuth ? "Salvar" : "Alterar" }
              </Button>
            </div>
          </form>
        </Fade>
      </div>
    </PageBase>
  );
};

export default UserProfile;