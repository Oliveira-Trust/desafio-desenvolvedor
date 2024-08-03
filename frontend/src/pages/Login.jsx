import { Grid } from "@mui/material";
import Input from "../components/FormInput";
import Form from "../components/Form";
import Button from "../components/Button";

import { useState, useContext } from "react";
import { HttpClient } from "../library/HttpClient";
import { AuthContext } from "../context/AuthContext";
import { useNavigate } from "react-router-dom";
import { useSnackbar } from 'notistack';

import styles from "./styles/Login.module.css";

const Login = () => {
	const navigate = useNavigate();
	const [userEmail, setUserEmail] = useState("");
	const [userPassword, setUserPassword] = useState("");

	const { enqueueSnackbar } = useSnackbar();

	const { setTokenValue, setUserValue } = useContext(AuthContext);

	const loginUser = () => {
		if ( ! validateData()) {
			return;
		}

		HttpClient(
			"/auth/login",
			{
				body: {
					email: userEmail,
					password: userPassword,
				}
			}
		)
			.then((resp) => resp.json())
			.then((data) => {
				setTokenValue(data.token);
				setUserValue(data.user);
				enqueueSnackbar('Bem vindo', { variant: 'success' });
				navigate('/');
			})
			.catch((e) => {
        enqueueSnackbar('Algum erro ocorreu. Contate o suporte!', { variant: 'error' })
      });
	}

	const validateData = () => {
		if (
			userEmail === '' ||
			userPassword === ' '
		) {
			enqueueSnackbar('Insira seus dados corretamente!', { variant: 'error' });
			return false;
		}

		return true;
	}

	return (
		<div className={styles.main}>
			<h1>Login</h1>
			<span>Ou <a href="/register">Registre-se</a></span>
			<div className={styles.login_form}>
				<Form callbackSubmit={() => loginUser()}>
					<Grid
						container
						spacing={1}
					>
						<Grid
							item xs={12}
							display="flex"
							flexDirection="row"
							alignItems="center"
							justifyContent="center"
						>
							<Input
								label="Email"
								name="email"
								variant="outlined"
								cbValueChanged={(data) => setUserEmail(data)}
							/>
						</Grid>
						<Grid
							item
							xs={12}
							display="flex"
							flexDirection="row"
							alignItems="center"
							justifyContent="center"
						>
							<Input
								label="Senha"
								name="password"
								variant="outlined"
								cbValueChanged={(data) => setUserPassword(data)}
								type="password"
							/>
						</Grid>
					</Grid>
					<div className={styles.login_button}>
						<Button
							variant="contained"
							type="submit"
							color="success"
						>
							Login
						</Button>
					</div>
				</Form>
			</div>
		</div>
	);
}

export default Login;