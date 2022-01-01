import { ErrorMessage, Field, Form, Formik } from 'formik';
import * as Yup from 'yup'
import { TextInput } from '../InputField/inde';
import * as C from './Styles'

const shape = Yup.object().shape({
    lowValue: Yup
        .number()
        .required("Ei, Você esqueceu transa"),
    maximumTransactionValue: Yup
        .number()
        .required("Ei, Você esqueceu do valor maximo."),
    minimumTransactionValue: Yup
        .number()
        .required("Ei, Você esqueceu do valor minimo."),
    rateForHighValue: Yup
        .number()
        .required("Ei, Você esqueceu do taxa para transasões acima do valor médio."),
    rateForlowValue: Yup
        .number()
        .required("Ei, Você esqueceu do taxa para transasões abaixo do valor médio.")
})
const FormTaxTransactions = ({ handleSubmit, taxTransaction }) => {
    const singUp = (values) => {
        handleSubmit(values)
    }
    return (
        <Formik
            validationSchema={shape}
            initialValues={taxTransaction}
            onSubmit={singUp}>
            {({ errors, values, handleChange, ...formProps }) => {
                return (
                    <Form autoComplete="off">
                        <C.Container>
                            <Field
                                component={TextInput}
                                className={!!errors.minimumTransactionValue ? 'error' : ''}
                                id="minimumTransactionValue"
                                name="minimumTransactionValue"
                                onChange={handleChange}
                                placeholder="Digite o valor maximo aceito"
                                type="number"
                                label="Valor Minimo de uma transação:"
                                value={values.minimumTransactionValue}
                                {...formProps.field}
                            />
                            <C.Error>
                                <ErrorMessage name="minimumTransactionValue" />
                            </C.Error>
                            <Field
                                component={TextInput}
                                label="Valor Maximo de uma transação:"
                                className={!!errors.maximumTransactionValue ? 'error' : ''}
                                id="maximumTransactionValue"
                                name="maximumTransactionValue"
                                onChange={handleChange}
                                placeholder="Digite o valor maximo aceito"
                                type="number"
                                {...formProps.field}
                            />
                            <C.Error>
                                <ErrorMessage name="maximumTransactionValue" />
                            </C.Error>
                        </C.Container>
                        <C.Container>
                            <Field
                                component={TextInput}
                                label={`Taxa para valor abaixo de ${values.lowValue}`}
                                className={!!errors.rateForlowValue ? 'error' : ''}
                                id="rateForlowValue"
                                name="rateForlowValue"
                                onChange={handleChange}
                                placeholder="Digite o valor maximo aceito"
                                type="number"
                                value={values.rateForlowValue}
                                {...formProps.field}
                            />
                            <C.Error>
                                <ErrorMessage name="rateForlowValue" />
                            </C.Error>
                            <Field
                                component={TextInput}
                                label="Valor médio:"
                                className={!!errors.lowValue ? 'error' : ''}
                                id="lowValue"
                                name="lowValue"
                                onChange={handleChange}
                                placeholder="Digite o valor médio"
                                type="number"
                                value={values.lowValue}
                                {...formProps.field}
                            />
                            <C.Error>
                                <ErrorMessage name="lowValue" />
                            </C.Error>
                            <Field
                                component={TextInput}
                                label={`Taxa para valor acima de ${values.lowValue}`}
                                className={!!errors.rateForHighValue ? 'error' : ''}
                                id="rateForHighValue"
                                name="rateForHighValue"
                                onChange={handleChange}
                                placeholder="Taxa para transações acima do valor"
                                type="number"
                                value={values.rateForHighValue}
                                {...formProps.field}
                            />
                            <C.Error>
                                <ErrorMessage name="rateForHighValue" />
                            </C.Error>
                        </C.Container>
                        <C.ContainerFormButtons>
                            <C.Button type="submit">Salvar</C.Button>
                        </C.ContainerFormButtons>
                    </Form>
                )
            }
            }
        </Formik>
    );
};
export default FormTaxTransactions