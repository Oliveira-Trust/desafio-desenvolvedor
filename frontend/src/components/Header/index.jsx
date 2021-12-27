import { Link } from 'react-router-dom'
import ToggleTheme from '../ToggleTheme'
import * as C from './Styles'

const Header = (props) => {
    return (
        <C.Header>
            <C.Logo>
                <Link to="/">{props.pageTitle}</Link>
            </C.Logo>
            <C.Nav>
                <Link to="/login">Login</Link>
                <Link to="/conversoes">Historico</Link>
                <ToggleTheme/>
            </C.Nav>
        </C.Header>
    )
}
export default Header