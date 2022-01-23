import React, { Component } from 'react';

export const Historic = (data) => {

    const langCoin = {"BRL":"pt-BR",
                      "USD":"en-US",
                      "EUR":"fr-FR",
                      "GBP":"en-IN",
                      "CNY":"zh-CN",
                    }

    return (
            <div class="desafio-oliveira__historic">
                <div class="desafio-oliveira__historic__body">
                    <div class="desafio-oliveira__historic__body__content">
                        <table>
                            <thead>
                                <th>Origem</th>
                                <th>Destino</th>
                                <th>Valor <br/>para conversão</th>
                                <th>Forma de pagamento</th>
                                <th>Valor da moeda <br/>de destino</th>
                                <th>Valor comprado</th>
                                <th>Taxa de pagamento</th>
                                <th>Taxa de conversão</th>
                                <th>Valor utilizado <br/>para conversão</th>
                                <th>Data</th>
                            </thead>
                            <tbody>
                                {data.historic.length > 0 ?
                                    data.historic.map(item=>{
                                        return <tr>
                                                    <td>{item.symbol_source_coin}</td>
                                                    <td>{item.symbol_target_coin}</td>
                                                    <td>{item.value_for_conversion.toLocaleString(langCoin[item.symbol_source_coin], { style: 'currency', currency: item.symbol_source_coin })}</td>
                                                    <td>{item.name_form_of_payment}</td>
                                                    <td>{item.target_currency_value.toLocaleString(langCoin[item.symbol_target_coin], { style: 'currency', currency: item.symbol_target_coin })}</td>
                                                    <td>{item.converted_value.toLocaleString(langCoin[item.symbol_target_coin], { style: 'currency', currency: item.symbol_target_coin })}</td>
                                                    <td>{item.payment_rate.toLocaleString(langCoin[item.symbol_source_coin], { style: 'currency', currency: item.symbol_source_coin })}</td>
                                                    <td>{item.conversion_rate.toLocaleString(langCoin[item.symbol_source_coin], { style: 'currency', currency: item.symbol_source_coin })}</td>
                                                    <td>{item.value_for_conversion_minus_rate.toLocaleString(langCoin[item.symbol_source_coin], { style: 'currency', currency: item.symbol_source_coin })}</td>
                                                    <td>{item.date}</td>
                                                </tr>
                                    }) :<></>
                                }
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        )
}