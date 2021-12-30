import { ErrorMessage, Field, Form, Formik } from 'formik';
import { FieldLabel, ContainerForm, LinkBotton } from '../FormSingup/Styles'
import * as Yup from 'yup'
import * as C from './Styles'

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
                    .required("Digite seu usuario."),
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
                        </ContainerForm>
                        <ContainerForm>
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
                        </ContainerForm>
                        {/* {hasError && hasError.show && (
                            <C.Error>
                                <p>{hasError.message}</p>
                            </C.Error>
                        )} */}
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