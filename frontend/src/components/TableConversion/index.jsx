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
                        <C.TableRow>
                            {(columns.length > 0) && columns.map((data, index) => {
                                        const dataArr = data.split('_')
                                        const title = dataArr.map(word => word.toUpperCase()).join(" ")
                                        return (
                                        <C.TableTh key={index}>{title}</C.TableTh>
                                        )
                                    })}
                        </C.TableRow>
                    </C.TableHead>
                    <C.TableBody>
                        {transactionsUser.map((transaction, index) => {
                            return (
                                <C.TableRow key={index}>
                                    <C.TableTd>{transaction.moeda_origem}</C.TableTd>
                                    <C.TableTd>{transaction.moeda_destino}</C.TableTd>
                                    <C.TableTd>{formatMoney(transaction.valor_para_conversao)}</C.TableTd>
                                    <C.TableTd>{transaction.forma_pagamento}</C.TableTd>
                                    <C.TableTd>{formatMoney(transaction.valor_moeda_destino, transaction.moeda_destino)}</C.TableTd>
                                    <C.TableTd>{formatMoney(transaction.valor_comprado)}</C.TableTd>
                                    <C.TableTd>{formatMoney(transaction.taxa_pagamento)}</C.TableTd>
                                    <C.TableTd>{formatMoney(transaction.taxa_conversao)}</C.TableTd>
                                    <C.TableTd>{formatMoney(transaction.valor_convertido, transaction.moeda_destino)}</C.TableTd>
                                    <C.TableTd>{formatDate(transaction.data_transaction)}</C.TableTd>
                                </C.TableRow>
                            )
                        })}
                    </C.TableBody>
                </C.TableConversion>
            ) : <p>Sem Conversões no momento.</p>}
        </C.Container>
    )
}
export default TableConversion