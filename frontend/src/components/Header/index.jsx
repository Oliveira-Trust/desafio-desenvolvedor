import { Link } from 'react-router-dom'
import { getLocalStorage, removeLocalStorage } from '../../services/functions'
import ToggleTheme from '../ToggleTheme'
import * as C from './Styles'

const Header = (props) => {
    const handleLogout = ()=>{
        removeLocalStorage()
    }
    return (
        <C.Header>
            <C.Logo>
                <Link to="/">{props.pageTitle}</Link>
            </C.Logo>
            <C.Nav>
                {getLocalStorage() && (
                    <>
                    {props.historico ? <Link to="/">Converter</Link>: <Link to="/conversoes">Historico</Link>}
                    <Link to="/login" onClick={handleLogout}>Sair</Link>
                    </>
                )}
                <ToggleTheme/>
            </C.Nav>
        </C.Header>
    )
}
export default Header