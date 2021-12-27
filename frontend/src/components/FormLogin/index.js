import { ErrorMessage, Field, Form, Formik } from 'formik';

import * as Yup from 'yup'
import { sendLogin } from '../../services/api';
import * as C from './Styles'

const initValues = {
    username: '',
    password: '',
}
const FormLogin = () => {
    const handleOnSubmit = (values, onSubmitProps) => {
        sendLogin(values).then((res)=>{
            console.log(res)
        })
        onSubmitProps.resetForm()
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
            onSubmit={handleOnSubmit}>
            {({errors, values, handleChange, ...formProps}) => {
                return (
                    <Form autoComplete="off">
                        <C.ContainerForm>
                            <label>Usuário</label>
                            <Field
                                component={C.InputArea}
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
                            <label>Senha</label>
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
                        <C.ContainerForm>
                            <C.Button type="submit">Entrar</C.Button>
                        </C.ContainerForm>
                    </Form>
                )
            }
            }
        </Formik>
    );
};
export default FormLogin