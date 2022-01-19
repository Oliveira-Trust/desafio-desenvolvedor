// @flow 
import { useKeycloak } from '@react-keycloak/web';
import * as React from 'react';
import { BrowserRouter, Switch, Route } from 'react-router-dom';
import {Login} from "./components/Login";
import {PrivateRoute} from "./components/PrivateRoute";
import {ConvertValue} from "./components/ConvertValue";
type Props = {
    
};
export const AppRouter = (props: Props) => {
    const {initialized} = useKeycloak();
    
    if(!initialized){
        return <div>Carregando...</div>
    }
    return (
        <BrowserRouter>
            <Switch>
                <Route path={'/login'} component={Login} exact={true}/>
                <PrivateRoute path="/" component={ConvertValue} exact={true}/>
            </Switch>
        </BrowserRouter>
    );
};