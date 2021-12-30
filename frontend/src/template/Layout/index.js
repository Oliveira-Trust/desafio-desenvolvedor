
import Header from '../../components/Header'
import * as C from './Styles'

const Layout = ({ children, historico }) => {
    return (
        <main>
            <Header historico={historico} pageTitle="Conversor de Moedas"/>
            <C.Section className="content-main">
                {children}
            </C.Section>
        </main>
    )
}
export default Layout