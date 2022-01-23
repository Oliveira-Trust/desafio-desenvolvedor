import React, { Component } from 'react';
import ReactDom from 'react-dom';
import {accessSystem} from '../gateway';

class Login extends Component {
    constructor(props){
        super(props);
        this.state = {
                        list_coins:[],
                        login:null,
                        password:null
                     };
    }

    componentDidMount(){
        localStorage.removeItem('auth');
    }
    

    changeField = async(e, value)=>{
        this.setState({[value]:e.target.value});
    }

    access = async()=>{
        try {
            var param = {
                            "email":this.state.email,
                            "password":this.state.password
                        }
            const response = await accessSystem.post('',param);
            var data = response.data;

            if(data.token != undefined){
                localStorage.setItem('auth',btoa(JSON.stringify(data)));
                window.location.href = '/home-page';
            }else{
                alert("Login inválido");
            }

        } catch (error) {
            console.log(Object.keys(error),error.message);
        }
    }

    render() {
        return (
            <>
                <div class="desafio-oliveira__modal">
                    <div class="desafio-oliveira__modal__content">
                        <img src="https://www.oliveiratrust.com.br/wp-content/themes/OliveiraTrust_WP/assets/img/logotipo_padrao_grey.svg"/>
                        <h1>Acessar sistema</h1>
                        <div class="desafio-oliveira__modal__content__form">
                            
                            <label>Login</label>
                            <input type="text" onChange={(e)=>this.changeField(e, 'email')}/>

                            <label>Senha</label>
                            <input type="password" onChange={(e)=>this.changeField(e, 'password')}/>

                            <button onClick={()=>this.access()}>Acessar</button>
                        </div>
                    </div>
                </div>
            </>
        );
    }
}

export default Login;

if(document.getElementById('login-page')){
    ReactDom.render(<Login/>, document.getElementById('login-page'));
}