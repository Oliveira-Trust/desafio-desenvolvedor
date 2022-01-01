import { ErrorMessage, Field, Form, Formik } from 'formik';
import { ContainerForm, LinkBotton } from '../FormSingup/Styles'
import * as Yup from 'yup'
import * as C from './Styles'
import { TextInput } from '../InputField/inde';

const initValues = {
    username: '',
    password: '',
}
const FormLogin = ({ handleLogin }) => {
    const login = (values, {resetForm}) => {
        resetForm()
        handleLogin(values)
    }
    return (
        <Formik
            validationSchema={Yup.object().shape({
                username: Yup
                    .string()
                    .required("Digite seu usuario ou e-mail."),
                password: Yup
                    .string()
                    .required("Digite sua senha.")
            })}
            initialValues={{ ...initValues }}
            onSubmit={login}>
            {({ errors, values, handleChange, ...formProps }) => {
                return (
                    <Form autoComplete="off">
                        <ContainerForm>
                            <Field
                                component={TextInput}
                                label="Usuário ou E-mail"
                                className={!!errors.username ? 'error' : ''}
                                id="username"
                                name="username"
                                onChange={handleChange}
                                placeholder="Usuario ou e-mail"
                                type="text"
                                value={values.username}
                                {...formProps.field}
                            />
                            <C.Error>
                                <ErrorMessage name="username" />
                            </C.Error>
                        </ContainerForm>
                        <ContainerForm>
                            <Field
                                component={TextInput}
                                label="Senha:"
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
                        </ContainerForm>
                        <C.ContainerFormButtons>
                            <C.Button type="submit">Entrar</C.Button>
                            <LinkBotton to="/singup">Cadastrar</LinkBotton>
                        </C.ContainerFormButtons>
                    </Form>
                )
            }
            }
        </Formik>
    );
};
export default FormLogin