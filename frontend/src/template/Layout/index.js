
import Header from '../../components/Header'
import * as C from './Styles'

const Layout = ({ children, historico, user }) => {
    return (
        <main>
            <Header historico={historico} pageTitle="Conversor de Moedas"/>
            {user && <C.Section><h3>Ola Bem vindo! <br/> {user.name}</h3></C.Section>}
            <C.Section className="content-main">
                {children}
            </C.Section>
        </main>
    )
}
export default Layout