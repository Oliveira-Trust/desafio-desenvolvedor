
import Header from '../../components/Header'
import * as C from './Styles'

const Layout = ({ children }) => {
    return (
        <main>
            <Header pageTitle="Conversor de Moedas"/>
            <C.Section className="content-main">
                {children}
            </C.Section>
        </main>
    )
}
export default Layout