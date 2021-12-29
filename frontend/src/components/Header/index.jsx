import { Link } from 'react-router-dom'
import { useHistory } from 'react-router';

import { isAuthenticated, logout } from '../../auth/authReducer'
import ToggleTheme from '../ToggleTheme'
import * as C from './Styles'

const Header = (props) => {
    const history = useHistory()

    const handleLogout = ()=>{
        logout()
        history.push('/login')
    }
    return (
        <C.Header>
            <C.Logo>
                <Link to="/">{props.pageTitle}</Link>
            </C.Logo>
            <C.Nav>
                {isAuthenticated() && (
                    <>
                    <Link to="/conversoes">Historico</Link>
                    <Link to="/" onClick={handleLogout}>Sair</Link>
                    </>
                )}
                {!isAuthenticated() && <Link to="/login" onClick={handleLogout}>Login</Link>}
                <ToggleTheme/>
            </C.Nav>
        </C.Header>
    )
}
export default Header