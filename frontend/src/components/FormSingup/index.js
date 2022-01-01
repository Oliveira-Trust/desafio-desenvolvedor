import { ErrorMessage, Field, Form, Formik } from 'formik';
import * as Yup from 'yup'
import { TextInput } from '../InputField/inde';
import * as C from './Styles'

const initValues = {
	name :"",
	username :"",
	email :"",
	password :""
}
const FormSingup = ({ handleSingup }) => {
    const singUp = (values, {resetForm}) => {
        resetForm()
        handleSingup(values)
    }
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
            onSubmit={singUp}>
            {({errors, values, handleChange, ...formProps}) => {
                return (
                    <Form autoComplete="off">
                        <C.ContainerForm>
                            <Field
                                component={TextInput}
                                label="Nome:"
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
                            <Field
                                component={TextInput}
                                label="Usuário:"
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
                            <Field
                                component={TextInput}
                                label="E-mail:"
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
                        </C.ContainerForm>
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