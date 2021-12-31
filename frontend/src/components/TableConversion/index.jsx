import { formatDate, formatMoney } from '../../services/functions'
import * as C from './Styles'

const TableConversion = ({transactionsUser, title}) => {
    const columns = transactionsUser.length > 0 ? Object.keys(transactionsUser[0]) : []
    return (
        <C.Container>
            <C.TitleTable>{title}</C.TitleTable>
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
                                    <td>{formatMoney(transaction.valor_para_conversao)}</td>
                                    <td>{transaction.forma_pagamento}</td>
                                    <td>{formatMoney(transaction.valor_moeda_destino, transaction.moeda_destino)}</td>
                                    <td>{formatMoney(transaction.valor_comprado)}</td>
                                    <td>{formatMoney(transaction.taxa_pagamento)}</td>
                                    <td>{formatMoney(transaction.taxa_conversao)}</td>
                                    <td>{formatMoney(transaction.valor_convertido, transaction.moeda_destino)}</td>
                                    <td>{formatDate(transaction.data_transaction)}</td>
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