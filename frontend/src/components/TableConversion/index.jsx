import { useData } from "../../contexts/dataContext";
import * as C from './Styles'
const TableConversion = props => {
    const { transactions } = useData();
    return (
        <C.Container>
            <h1>Historico de Converções</h1>
            {transactions.length > 0 ? (
                <C.TableConversion>
                    <C.TableHead>
                        <tr>
                            {Object.keys(transactions[0]).map((data, index) => {
                                        const dataArr = data.split('_')
                                        const title = dataArr.map(word => word.toUpperCase()).join(" ")
                                        return (
                                        <th key={index}>{title}</th>
                                        )
                                    })}
                        </tr>
                    </C.TableHead>
                    <C.TableBody>
                        {transactions.map((transaction, index) => {
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
                                    <td>{transaction.data_transaction}</td>
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