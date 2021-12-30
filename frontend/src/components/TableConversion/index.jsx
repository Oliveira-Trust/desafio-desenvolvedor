import * as C from './Styles'

const TableConversion = ({transactionsUser}) => {
    const columns = transactionsUser.length > 0 ? Object.keys(transactionsUser[0]) : []
    return (
        <C.Container>
            <C.TitleTable>Historico de Converções</C.TitleTable>
            {transactionsUser.length > 0 ? (
                <C.TableConversion>
                    <C.TableHead>
                        <tr>
                            {(columns.length > 0) && columns.map((data, index) => {
                                        const dataArr = data.split('_')
                                        const title = dataArr.map(word => word.toUpperCase()).join(" ")
                                        return (
                                        <th key={index}>{title}</th>
                                        )
                                    })}
                        </tr>
                    </C.TableHead>
                    <C.TableBody>
                        {transactionsUser.map((transaction, index) => {
                            return (
                                <tr key={index}>
                                    <td>{transaction.moeda_origem}</td>
                                    <td>{transaction.moeda_destino}</td>
                                    <td>R{transaction.valor_para_conversao}</td>
                                    <td>{transaction.forma_pagamento}</td>
                                    <td>{transaction.valor_moeda_destino}</td>
                                    <td>{transaction.valor_comprado}</td>
                                    <td>{transaction.taxa_pagamento}</td>
                                    <td>{transaction.taxa_conversao}</td>
                                    <td>{transaction.valor_convertido}</td>
                                    <td>{(new Date(transaction.data_transaction)).toLocaleDateString('pt-BR', {year:'2-digit', month: '2-digit', day:'2-digit', hour:'numeric', minute:'numeric'})}</td>
                                </tr>
                            )
                        })}
                    </C.TableBody>
                </C.TableConversion>
            ) : <p>Sem Conversões no momento.</p>}
        </C.Container>
    )
}
export default TableConversion