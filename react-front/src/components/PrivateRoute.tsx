import * as React from 'react';
import {Redirect, Route, RouteProps} from 'react-router-dom';
import { keycloak } from '../utils/auth';
interface PrivateRouteProps extends RouteProps{
    
};
export const PrivateRoute: React.FC<PrivateRouteProps> = (props) => {
    const {component, ...rest} = props;
    const Component: any = component;
    return (
        <Route 
            {...rest}
            render={(props) => {
                return keycloak.authenticated ? (
                    <Component {...props} />
                ) : (
                    <Redirect
                    to={{
                        pathname: "/login",
                        state: {from: props.location}
                    }}/>
                )
            }}
        />
    );
};