import { ErrorMessage, Field, Form, Formik } from 'formik';

import * as Yup from 'yup'
import { sendLogin } from '../../services/api';
import * as C from './Styles'
import { FieldLabel } from '../FormSingup/Styles'
import { useEffect, useState } from 'react';
import { isAuthenticated, singIn } from '../../auth/authReducer';
import { useHistory } from 'react-router';

const initValues = {
    username: 'danielmn',
    password: '123456',
}
const FormLogin = () => {
    const [ showMessage, setShowMessage ] = useState({show: false, message: ''})
    const history = useHistory();
    const handleOnSubmit = (values, onSubmitProps) => {
        sendLogin(values).then((res)=>{
            if(res.status === 'error'){
                setShowMessage({show: true, message: res.message})
            } else {
                singIn(res.token)
                history.push('/')
            }
        })
        onSubmitProps.resetForm()
    }
    useEffect(()=>{
        if(isAuthenticated()){
            history.push('/')
        }
    },[])

    return (
        <Formik
            validationSchema={Yup.object().shape({
                username: Yup
                    .string()
                    .required("Digite seu usuario."),
                password: Yup
                    .string()
                    .required("Digite sua senha.")
            })}
            initialValues={{ ...initValues }}
            onSubmit={handleOnSubmit}>
            {({errors, values, handleChange, ...formProps}) => {
                return (
                    <Form autoComplete="off">
                        <C.ContainerForm>
                            <FieldLabel>Usuário</FieldLabel>
                            <Field
                                component={C.InputAreaLogin}
                                className={!!errors.username ? 'error' : ''}
                                id="username"
                                name="username"
                                onChange={handleChange}
                                placeholder="Digite seu usuario"
                                type="username"
                                value={values.username}
                                {...formProps.field}
                            />
                           <C.Error>
                                <ErrorMessage name="username" />
                            </C.Error>
                        </C.ContainerForm>
                        <C.ContainerForm>
                            <FieldLabel>Senha</FieldLabel>
                            <Field
                                component={C.InputAreaLogin}
                                className={!!errors.password ? 'error' : ''}
                                id="password"
                                name="password"
                                onChange={handleChange}
                                placeholder="Digite sua senha"
                                type="password"
                                value={values.password}
                                {...formProps.field}
                            />
                           <C.Error>
                                <ErrorMessage name="password" />
                            </C.Error>
                        </C.ContainerForm>
                        {showMessage.show && (
                            <C.Error>
                                <p>{showMessage.message}</p>
                            </C.Error>
                        )}
                        <C.ContainerFormButtons>
                            <C.Button type="submit">Entrar</C.Button>
                            <C.LinkBotton to="/singup">Cadastrar</C.LinkBotton>
                        </C.ContainerFormButtons>
                    </Form>
                )
            }
            }
        </Formik>
    );
};
export default FormLogin