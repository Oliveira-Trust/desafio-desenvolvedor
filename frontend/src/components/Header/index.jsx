import { Link } from 'react-router-dom'
import { useAuth } from '../../contexts/authContext'
import { getLocalStorage } from '../../services/functions'
import ToggleTheme from '../ToggleTheme'
import * as C from './Styles'

const Header = (props) => {
    const { singOut } = useAuth()
    const handleLogout = ()=>{
        singOut()
    }
    return (
        <C.Header>
            <C.Logo>
                <Link to="/">{props.pageTitle}</Link>
            </C.Logo>
            <C.Nav>
                {getLocalStorage() && (
                    <>
                    <Link to="/">Converter</Link>
                    <Link to="/conversoes">Historico</Link>
                    <Link to="/painel" >Painel</Link>
                    <Link to="/login" onClick={handleLogout}>Sair</Link>
                    </>
                )}
                <ToggleTheme/>
            </C.Nav>
        </C.Header>
    )
}
export default Header