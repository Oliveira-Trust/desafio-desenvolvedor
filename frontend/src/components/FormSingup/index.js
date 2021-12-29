import { ErrorMessage, Field, Form, Formik } from 'formik';
import { useState, useEffect } from 'react';
import { useHistory } from 'react-router';

import * as Yup from 'yup'
import { isAuthenticated, singIn } from '../../auth/authReducer';
import { saveUser } from '../../services/api';
import * as C from './Styles'

const initValues = {
	name :"Daniel Meireles",
	username :"daniel",
	email :"daniel@yaho.com",
	password :"123456"
}
const FormSingup = () => {
    const [ showMessage, setShowMessage ] = useState({show: false, message: ''})
    const history = useHistory();
    const handleOnSubmit = (values, onSubmitProps) => {
        saveUser(values).then((res)=>{
            console.log(res)
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
                name: Yup
                    .string()
                    .required("Ei, Você esqueceu do nome."),
                username: Yup
                    .string()
                    .required("Ei, Você esqueceu do username."),
                email: Yup
                    .string()
                    .email("Ei, Esse formato de e-mail é invalido.")
                    .required("Ei, Você esqueceu do e-mail."),
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
                            <C.FieldLabel>Nome</C.FieldLabel>
                            <Field
                                component={C.InputArea}
                                className={!!errors.name ? 'error' : ''}
                                id="name"
                                name="name"
                                onChange={handleChange}
                                placeholder="Digite seu nome"
                                type="text"
                                value={values.name}
                                {...formProps.field}
                            />
                           <C.Error>
                                <ErrorMessage name="name" />
                            </C.Error>
                        </C.ContainerForm>
                        <C.ContainerForm>
                            <C.FieldLabel>Usuário</C.FieldLabel>
                            <Field
                                component={C.InputArea}
                                className={!!errors.username ? 'error' : ''}
                                id="username"
                                name="username"
                                onChange={handleChange}
                                placeholder="Digite seu Usuário"
                                type="text"
                                value={values.username}
                                {...formProps.field}
                            />
                           <C.Error>
                                <ErrorMessage name="username" />
                            </C.Error>
                        </C.ContainerForm>
                        <C.ContainerForm>
                            <C.FieldLabel>E-mail</C.FieldLabel>
                            <Field
                                component={C.InputArea}
                                className={!!errors.email ? 'error' : ''}
                                id="email"
                                name="email"
                                onChange={handleChange}
                                placeholder="Digite um email"
                                type="email"
                                value={values.email}
                                {...formProps.field}
                            />
                           <C.Error>
                                <ErrorMessage name="email" />
                            </C.Error>
                        </C.ContainerForm>
                        <C.ContainerForm>
                            <C.FieldLabel>Senha</C.FieldLabel>
                            <Field
                                component={C.InputArea}
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
                            <C.Error>{showMessage.message}</C.Error>
                        )}
                        <C.ContainerFormButtons>
                            <C.Button type="submit">Salvar</C.Button>
                            <C.LinkBotton to="/login">Login</C.LinkBotton>
                        </C.ContainerFormButtons>
                    </Form>
                )
            }
            }
        </Formik>
    );
};
export default FormSingup