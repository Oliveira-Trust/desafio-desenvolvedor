import React, { Component } from 'react';
import ReactDom from 'react-dom';
import {VerifyAuth, ListCoin, ListFormPayment, ConvertCurrency, listOperatonHistoric} from '../gateway';
import { Historic } from './Historic';
import { Operation } from './Operation';

class HomePage extends Component {
    constructor(props){
        super(props);
        this.state = {
                        list_coins:[],
                        list_form_payment:[],
                        historic:[],
                        processed_data:null,

                        source_coin_id:1,
                        target_coin_id:2,
                        value_for_convertion:null,
                        form_of_payment_id:1,

                        view_operation: true,
                        view_historic: false,

                        data_user: localStorage.getItem("auth") != undefined ? JSON.parse(atob(localStorage.getItem("auth"))) : null
                     };
    }

    componentDidMount(){
        VerifyAuth();
        this.listCoins();
        this.listFormPayment();
        this.listHistoric();
    }

    listCoins = async()=>{
        try {
            const response = await ListCoin.get();
            var data = response.data;

            this.setState({list_coins: data});
            
        } catch (error) {
            console.log(Object.keys(error),error.message);
        }
    } 

    listFormPayment = async()=>{
        try {
            const response = await ListFormPayment.get();
            var data = response.data;

            this.setState({list_form_payment: data});
            
        } catch (error) {
            console.log(Object.keys(error),error.message);
        }
    } 

    listHistoric = async()=>{
        try {
            const response = await listOperatonHistoric.get('/'+this.state.data_user.user_id);
            var data = response.data;

            this.setState({historic: data});
            
        } catch (error) {
            console.log(Object.keys(error),error.message);
        }
    } 

    process = async()=>{
        try {
            
            if(this.state.value_for_convertion == "" || this.state.value_for_convertion == undefined || this.state.value_for_convertion == null){
                alert("Por favor, preencha o valor que deseja converter.");
                this.setState({processed_data: null});
            }else if(this.state.value_for_convertion < 1000 || this.state.value_for_convertion > 100000){
                alert("Valor da Compra em BRL (deve ser maior que R$ 1.000,00 e menor que R$ 100.000,00)");
                this.setState({processed_data: null});
            }else{
                var param = {
                                "value_for_conversion":this.state.value_for_convertion,
                                "source_currency_id":this.state.source_coin_id,
                                "target_currency_id":this.state.target_coin_id,
                                "form_of_payment_id":this.state.form_of_payment_id,
                                "user_id":this.state.data_user.user_id
                            }
                
                const response = await ConvertCurrency.post('', param);
                var data = response.data;
                
                this.setState({processed_data: data});
                
            }
            
        } catch (error) {
            console.log(Object.keys(error),error.message);
        }
    } 

    
    changeInputValue = (e, value, type = 'input')=>{
        
        if(type == 'select'){
            var option = e.target.options[e.target.options.selectedIndex].value;
        }else{
            var option = e.target.value;
        }

        this.setState({[value]:option});
        
    }

    setViewScreen = async(screen)=>{
        this.setState({view_operation: false, view_historic: false});
        this.setState({[screen]: true});

        if(screen == 'view_historic'){
            this.listHistoric();
        }
    }

    render() {
        return (
            <>
                <div class="desafio-oliveira__header">
                    <div class="desafio-oliveira__header__content">
                        <img src="https://www.oliveiratrust.com.br/wp-content/themes/OliveiraTrust_WP/assets/img/logotipo_padrao_grey.svg" onClick={()=>window.location.href="/"}/>
                        <p>Desafio desenvolvido por Lucas Candido</p>
                    </div>
                </div>
                <div class="desafio-oliveira__menu">
                    <div class="desafio-oliveira__menu__option">
                        <button onClick={()=>this.setViewScreen('view_operation')}>Operações</button>
                    </div>
                    <div class="desafio-oliveira__menu__option">
                        <button onClick={()=>this.setViewScreen('view_historic')}>Histórico</button>
                    </div>
                </div>
                
                {this.state.view_operation ?
                    <Operation
                        list_coins={this.state.list_coins}
                        list_form_payment={this.state.list_form_payment}
                        processed_data={this.state.processed_data}
                        changeInputValue={this.changeInputValue}
                        process={this.process}/> :<></>
                }
                
                {this.state.view_historic ?
                    <Historic historic={this.state.historic}/> :<></>
                }
                
            </>
        );
    }
}

export default HomePage;

if(document.getElementById('home-page')){
    ReactDom.render(<HomePage/>, document.getElementById('home-page'));
}