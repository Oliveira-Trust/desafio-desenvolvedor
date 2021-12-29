import { ErrorMessage, Field, Form, Formik } from 'formik';
import { useState } from 'react';
import { useHistory } from 'react-router';

import * as Yup from 'yup'
import { useData } from '../../contexts/dataContext';
import { sendConversation } from '../../services/api';
import * as C from './Styles'

const initValues = {
    moeda_origem: 'BRL',
    moeda_destino: 'USD',
    valor: '',
    forma_pagamento: '1'
}
const CardConvertion = () => {
    const { currencies, currencyBRL, payments } = useData();
    const [ showMessage, setShowMessage ] = useState({show: false, message: ''})
    const history = useHistory();
    const handleOnSubmit = (values, onSubmitProps) => {
        sendConversation(values).then((res)=>{
            console.log(res)
            if(res.status === 'error'){
                setShowMessage({show: true, message: res.message})
            } else {
                history.push('/conversoes')
            }
        })
        onSubmitProps.resetForm()
    }
    return (
        <Formik
            validationSchema={Yup.object().shape({
                moeda_origem: Yup
                    .string()
                    .required("Selecione a moeda de origem."),
                moeda_destino: Yup
                    .string()
                    .required("Selecione a moeda de destino."),
                valor: Yup
                    .number()
                    .required("Qual valor gostaria de converter?"),
                forma_pagamento: Yup.string().required("Selecione uma forma de pagamento.")
            })}
            initialValues={{ ...initValues }}
            onSubmit={handleOnSubmit}>
            {({errors, values, handleChange, ...formProps}) => {
                return (
                    <Form autoComplete="off">
                        <C.ContainerForm>
                            <label>Converter De:</label>
                            <Field  defaultValue={currencyBRL.code} value={values.moeda_origem} name="moeda_origem" as="select" onChange={handleChange}>
                                <option defaultValue value={currencyBRL.code}>{`[${currencyBRL.code}] ${currencyBRL.name}`}</option>
                            </Field>
                            <C.Error>
                                <ErrorMessage name="moeda_origem" />
                            </C.Error>
                        </C.ContainerForm>
                        <C.ContainerForm>
                        <label>Converter para:</label>
                            <Field value={values.moeda_destino} name="moeda_destino" as="select" onChange={handleChange}>
                                {currencies.length > 0 && (
                                    currencies.map((item, i)=><option key={i} value={item.code}>{`[${item.code}] ${item.name}`}</option>)
                                )}
                            </Field>
                            <C.Error>
                                <ErrorMessage name="moeda_destino" />
                            </C.Error>
                        </C.ContainerForm>
                        <C.ContainerForm>
                            <label>Forma de Pagamento:</label>
                            <Field value={values.forma_pagamento} name="forma_pagamento" as="select" onChange={handleChange}>
                                {payments.length > 0 && (
                                    payments.map((item)=><option key={item.id} value={item.id}>{`[${item.type}] Taxa de ${item.conversionTax}%`}</option>)
                                )}
                            </Field>
                            <C.Error>
                                <ErrorMessage name="forma_pagamento" />
                            </C.Error>
                        </C.ContainerForm>
                        <C.ContainerForm>
                            <label>Valor para conversão:</label>
                            <Field
                                component={C.InputArea}
                                className={!!errors.valor ? 'error' : ''}
                                id="valor"
                                name="valor"
                                onChange={handleChange}
                                placeholder="R$ 0,00"
                                type="number"
                                value={values.valor}
                                {...formProps.field}
                            />
                           <C.Error>
                                <ErrorMessage name="valor" />
                            </C.Error>
                        </C.ContainerForm>
                        {showMessage.show && (
                            <C.Error>{showMessage.message}</C.Error>
                        )}
                        <C.ContainerForm>
                            <C.Button type="submit">Converter</C.Button>
                        </C.ContainerForm>
                    </Form>
                )
            }
            }
        </Formik>
    );
};
export default CardConvertion