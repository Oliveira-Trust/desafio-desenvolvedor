import { formatMoney } from '../../services/functions'
import * as C from './Styles'

const LastConversion = (props) => {
    const transaction = props.lastTransaction[0]
    return (
        <C.Container>
            <C.TitleLastConversion>Resultado da conversão</C.TitleLastConversion>
            <C.Item>
                <C.ItemValue>Moeda de origem:</C.ItemValue>
                <C.ItemValue>{transaction.moeda_origem}</C.ItemValue>
            </C.Item>
            <C.Item>Moeda de destino:
                <C.ItemValue>{transaction.moeda_destino}</C.ItemValue>
            </C.Item>
            <C.Item>Valor para conversão:
                <C.ItemValue>{formatMoney(transaction.valor_para_conversao, transaction.moeda_origem)}</C.ItemValue>
            </C.Item>
            <C.Item>Forma de pagamento:
                <C.ItemValue>{transaction.forma_pagamento}</C.ItemValue>
            </C.Item>
            <C.Item>Valor da "{transaction.moeda_destino}" usado para conversão:
                <C.ItemValue>{formatMoney(transaction.valor_moeda_destino, transaction.moeda_destino)}</C.ItemValue>
            </C.Item>
            <C.Item>Valor comprado em "{transaction.moeda_destino}":
                <C.ItemValue>{formatMoney(transaction.valor_comprado, transaction.moeda_destino)}</C.ItemValue>
            </C.Item>
            <C.Item>Taxa de pagamento:
                <C.ItemValue>{formatMoney(transaction.taxa_pagamento)}</C.ItemValue>
            </C.Item>
            <C.Item>Taxa de conversão:
                <C.ItemValue>{formatMoney(transaction.taxa_conversao)}</C.ItemValue>
            </C.Item>
            <C.Item>Valor utilizado para conversão:
                <C.ItemValue>{formatMoney(transaction.valor_convertido, transaction.moeda_destino)}</C.ItemValue>
            </C.Item>
        </C.Container>
    )
}

export default LastConversion