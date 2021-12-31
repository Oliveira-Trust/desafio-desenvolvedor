import * as C from './Styles'

const LastConversion = (props)=>{
    const transaction = props.lastTransaction[0]
    return (
        <C.Container>
            <C.TitleLastConversion>Resultado da conversão</C.TitleLastConversion>
            <C.Item>Moeda de origem: <C.ItemValue>{transaction.moeda_origem}</C.ItemValue></C.Item>
            <C.Item>Moeda de destino: <C.ItemValue>{transaction.moeda_destino}</C.ItemValue></C.Item>
            <C.Item>Valor para conversão: <C.ItemValue>{transaction.valor_para_conversao.toLocaleString('pt-BR', { minimumFractionDigits: 2 , style: 'currency', currency: 'BRL' })}</C.ItemValue></C.Item>
            <C.Item>Forma de pagamento: <C.ItemValue>{transaction.forma_pagamento}</C.ItemValue></C.Item>
            <C.Item>Valor da "{transaction.moeda_destino}" usado para conversão: <C.ItemValue>{transaction.valor_moeda_destino}</C.ItemValue></C.Item>
            <C.Item>Valor comprado em "{transaction.moeda_destino}": <C.ItemValue>{transaction.valor_comprado}</C.ItemValue></C.Item>
            <C.Item>Taxa de pagamento: <C.ItemValue>R{transaction.taxa_pagamento}</C.ItemValue></C.Item>
            <C.Item>Taxa de conversão: <C.ItemValue>R{transaction.taxa_conversao}</C.ItemValue></C.Item>
            <C.Item>Valor utilizado para conversão: <C.ItemValue>{transaction.valor_convertido}</C.ItemValue></C.Item>
        </C.Container>
    )
}

export default LastConversion