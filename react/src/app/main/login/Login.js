import PropTypes from 'prop-types';
import React, { useState } from 'react';
import Table from 'react-bootstrap/Table';
import "./Login.css";
import { loginUser } from './Login.service';

export default function Login({ setToken }) {
    const [username, setUserName] = useState();
    const [password, setPassword] = useState();

    const handleSubmit = async e => {
        e.preventDefault();
        const token = await loginUser({
            username,
            password
        });
        setToken(token);
    }

    return (
        <main className="form-signin">
            <form onSubmit={handleSubmit}>
                <img className="mb-4" src="https://www.oliveiratrust.com.br/wp-content/themes/OliveiraTrust_WP/assets/img/logotipo_padrao_grey.svg" alt="" height="40" />
                <h1 className="h3 mb-3 fw-normal">Faça o Login</h1>

                <div className="form-floating">
                    <input
                        type="username"
                        className="form-control"
                        id="floatingInput"
                        placeholder="username"
                        onChange={e => setUserName(e.target.value)}
                    />
                    <label htmlFor="floatingInput">Usuário</label>
                </div>
                <div className="form-floating">
                    <input
                        type="password"
                        className="form-control"
                        id="floatingPassword"
                        placeholder="Password"
                        onChange={e => setPassword(e.target.value)}
                    />
                    <label htmlFor="floatingPassword">Senha</label>
                </div>

                {/* <div className="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me" />Lembrar-me
                    </label>
                </div> */}
                <button className="w-100 btn btn-lg btn-primary" type="submit">Login</button>
                <p className="mt-5 mb-3 text-muted">
                    Por padrão foram criados dois usuários:
                </p>
                <Table striped bordered hover>
                    <tbody>
                        <tr>
                            <th>Usuário</th>
                            <th>Senha</th>
                            <th>Perfil</th>
                        </tr>
                        <tr>
                            <td>admin</td>
                            <td>admin</td>
                            <td>Administrador</td>
                        </tr>
                        <tr>
                            <td>user</td>
                            <td>user</td>
                            <td>Usuário</td>
                        </tr>
                    </tbody>
                </Table>
                <p className="mt-5 mb-3 text-muted">&copy; 2021–2021</p>
            </form>
        </main>
    )
}

Login.propTypes = {
    setToken: PropTypes.func.isRequired
}