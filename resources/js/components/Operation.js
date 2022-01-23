import React, { Component } from 'react';

export const Operation = (data) => {

    const langCoin = {"BRL":"pt-BR",
                      "USD":"en-US",
                      "EUR":"fr-FR",
                      "GBP":"en-IN",
                      "CNY":"zh-CN",
                    }
    
    return (
            <div class="desafio-oliveira__operation">
                <div class="desafio-oliveira__operation__control">
                    <div class="desafio-oliveira__operation__control__field">
                        <label>Moeda de origem</label>
                        <select onChange={(e)=>data.changeInputValue(e,'source_coin_id','select')}>
                            {data.list_coins.length > 0 ?
                                data.list_coins.map(item=>{
                                    if(item.symbol == "BRL"){
                                        return <option value={item.coin_id}>{item.symbol}</option>
                                    }
                                })
                                : <></>
                            }
                        </select>
                    </div>
                    <div class="desafio-oliveira__operation__control__field">
                        <label>Moeda de destino</label>
                        <select onChange={(e)=>data.changeInputValue(e,'target_coin_id','select')}>
                            {data.list_coins.length > 0 ?
                                data.list_coins.map(item=>{
                                    if(item.symbol != "BRL"){
                                        return <option value={item.coin_id}>{item.symbol}</option>
                                    }
                                })
                                : <></>
                            }
                        </select>
                    </div>
                    <div class="desafio-oliveira__operation__control__field">
                        <label>Valor para compra</label>
                        <input type="number" onChange={(e)=>data.changeInputValue(e,'value_for_convertion', 'input')}/>
                    </div>
                    <div class="desafio-oliveira__operation__control__field">
                        <label>Forma de pagamento</label>
                        <select onChange={(e)=>data.changeInputValue(e,'form_of_payment_id','select')}>
                            {data.list_form_payment.length > 0 ?
                                data.list_form_payment.map(item=>{
                                    return <option value={item.form_id}>{item.name}</option>
                                })
                                : <></>
                            }
                        </select>
                    </div>
                    <div class="desafio-oliveira__operation__control__field">
                        <button onClick={()=>data.process()}>Processar</button>
                    </div>
                </div>

                {data.processed_data != null && data.processed_data != undefined && data.processed_data != "" ?
                    <div class="desafio-oliveira__operation__body">
                        <div class="desafio-oliveira__operation__body__content">
                            <h1>Resultado da operação</h1>
                            <p><span>Moeda de origem:</span> {data.processed_data.symbol_source_coin}</p>
                            <p><span>Moeda de destino:</span> {data.processed_data.symbol_target_coin}</p>
                            <p><span>Valor para conversão:</span> {parseFloat(data.processed_data.value_for_conversion).toLocaleString(langCoin[data.processed_data.symbol_source_coin], { style: 'currency', currency: data.processed_data.symbol_source_coin })}</p>
                            <p><span>Forma de pagamento:</span> {data.processed_data.name_form_of_payment}</p>
                            <p><span>Valor atual da moeda de destino:</span> {parseFloat(data.processed_data.target_currency_value).toLocaleString(langCoin[data.processed_data.symbol_target_coin], { style: 'currency', currency: data.processed_data.symbol_target_coin })}</p>
                            <p><span>Valor comprado (- taxas):</span> {parseFloat(data.processed_data.converted_value).toLocaleString(langCoin[data.processed_data.symbol_target_coin], { style: 'currency', currency: data.processed_data.symbol_target_coin })}</p>
                            <p><span>Taxa de pagamento:</span> {parseFloat(data.processed_data.payment_rate).toLocaleString(langCoin[data.processed_data.symbol_source_coin], { style: 'currency', currency: data.processed_data.symbol_source_coin })}</p>
                            <p><span>Taxa de conversão:</span> {parseFloat(data.processed_data.conversion_rate).toLocaleString(langCoin[data.processed_data.symbol_source_coin], { style: 'currency', currency: data.processed_data.symbol_source_coin })}</p>
                            <p><span>Valor utilizado para conversão descontando as taxas:</span> {parseFloat(data.processed_data.value_for_conversion_minus_rate).toLocaleString(langCoin[data.processed_data.symbol_source_coin], { style: 'currency', currency: data.processed_data.symbol_source_coin })}</p>

                        </div>
                    </div> : <></>
                }
                
            </div>
        )
}