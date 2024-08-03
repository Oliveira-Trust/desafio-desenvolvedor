import { Grid } from "@mui/material";
import styles from "./styles/Register.module.css";
import Input from "../components/FormInput";
import Form from "../components/Form";
import Button from "../components/Button";
import { useSnackbar } from 'notistack'

import { HttpClient } from "../library/HttpClient";
import { useNavigate } from 'react-router-dom';

import { useState } from "react";

const Register = () => {
	const [userFirstName, setUserFirstName] = useState(null);
	const [userLastName, setUserLastName] = useState(null);
	const [userEmail, setUserEmail] = useState(null);
	const [userPassword, setUserPassword] = useState(null);
	const [userConfirmPassword, setUserConfirmPassword] = useState(null);

	const { enqueueSnackbar } = useSnackbar();

	const navigate = useNavigate();

	const registerUser = () => {		
		HttpClient(
			"/user/create",
			{
				body: {
					firstName: userFirstName.trim(),
					lastName: userLastName.trim(),
					email: userEmail.trim(),
					password: userPassword,
					confirmPassword: userConfirmPassword,
				}
			}
		).then(() => {
			enqueueSnackbar('Usuário criado com sucesso!', { variant: 'success' });
			navigate('/login');
		});
	}

	return (
		<div className={styles.main}>
			<h1>Registre-se</h1>
			<div className={styles.register_form}>
				<Form callbackSubmit={() => registerUser()}>
					<Grid	container spacing={1}>
						<Grid item xs={6}>
							<Input
								label="Primeiro nome"
								name="firstName"
								variant="outlined"
								required
								cbValueChanged={(data) => setUserFirstName(data)}
							/>
						</Grid>
						<Grid item xs={6}>
							<Input
								label="Ultimo nome"
								name="lastName"
								variant="outlined"
								required
								cbValueChanged={(data) => setUserLastName(data)}
							/>
						</Grid>
						<Grid item xs={12}>
							<Input
								label="Email"
								name="email"
								variant="outlined"
								required
								cbValueChanged={(data) => setUserEmail(data)}
							/>
						</Grid>
						<Grid item xs={12}>
							<Input
								label="Senha"
								name="password"
								variant="outlined"
								required
								cbValueChanged={(data) => setUserPassword(data)}
								type="password"
							/>
						</Grid>
						<Grid item xs={12}>
							<Input
								label="Confirmar senha"
								name="confirm_password"
								variant="outlined"
								required
								cbValueChanged={(data) => setUserConfirmPassword(data)}
								type="password"
							/>
						</Grid>
					</Grid>
					<div className={styles.register_button}>
						<Button
							variant="contained"
							type="submit"
							color="success"
						>
							Registrar-se
						</Button>
					</div>
				</Form>
			</div>
		</div>
	);
}

export default Register;