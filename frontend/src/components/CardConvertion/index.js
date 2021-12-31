import React, { useState } from 'react';
import { ErrorMessage, Field, Form, Formik } from 'formik';
import * as Yup from 'yup'
import * as C from './Styles'
import { FieldLabel } from '../FormSingup/Styles'
import { sendConversion } from '../../services/api';
import { useHistory } from 'react-router';
import LastConversion from '../LastConversion';

const initValues = {
    moeda_origem: 'BRL',
    moeda_destino: 'USD',
    valor: '',
    forma_pagamento: '1'
}

const CardConvertion = ({currencyBRL, currencies, paymentTypes }) => {
    const [ error , setError ] = useState('')
    const [ lastConversion, setLastConversion ] = useState([])
    const history = useHistory()
    const handleOnSubmit = async(values, {resetForm}) => {
        const tResponse = await sendConversion(values)
        resetForm()
        if(tResponse.status === 'sucesso'){
            // history.push('/conversoes')
            setLastConversion([tResponse.data])
        } else {
            setError(c => tResponse.message)
        }
    }
    return (
        <>
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
                         {error &&  <C.Error>{error}</C.Error>}
                        <C.ContainerForm>
                            <FieldLabel>Converter De:</FieldLabel>
                            {currencyBRL && (
                                <Field options={[currencyBRL]} value={values.moeda_origem} name="moeda_origem" as="select" onChange={handleChange}>
                                    <option defaultValue value={currencyBRL.code}>{`[${currencyBRL.code}] ${currencyBRL.name}`}</option>
                                </Field>
                            )}
                            <C.Error>
                                <ErrorMessage name="moeda_origem" />
                            </C.Error>
                        </C.ContainerForm>
                        <C.ContainerForm>
                        <FieldLabel>Converter para:</FieldLabel>
                            <Field value={values.moeda_destino} name="moeda_destino" as="select" onChange={handleChange}>
                                {(currencies.length > 0) && (
                                    currencies.map((item, i)=><option key={i} value={item.code}>{`[${item.code}] ${item.name}`}</option>)
                                )}
                            </Field>
                            <C.Error>
                                <ErrorMessage name="moeda_destino" />
                            </C.Error>
                        </C.ContainerForm>
                        <C.ContainerForm>
                            <FieldLabel>Forma de Pagamento:</FieldLabel>
                            <Field value={values.forma_pagamento} name="forma_pagamento" as="select" onChange={handleChange}>
                                {(paymentTypes.length > 0) && (
                                    paymentTypes.map((item)=><option key={item.id} value={item.id}>{`[${item.type}] Taxa de ${item.conversionTax}%`}</option>)
                                )}
                            </Field>
                            <C.Error>
                                <ErrorMessage name="forma_pagamento" />
                            </C.Error>
                        </C.ContainerForm>
                        <C.ContainerForm>
                            <FieldLabel>Valor para conversão:</FieldLabel>
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
                        <C.ContainerForm>
                            <C.Button type="submit">Converter</C.Button>
                        </C.ContainerForm>
                    </Form>
                )
            }
            }
        </Formik>
        {lastConversion.length > 0 && <LastConversion title="Resultado da conversão" lastTransaction={[lastConversion[0]]}/>}
        </>
    );
};
export default CardConvertion