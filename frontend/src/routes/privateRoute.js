
import React from 'react'
import { Redirect, Route } from 'react-router-dom'
import { isAuthenticated } from '../auth/authReducer';

const PrivateRoute = ({ component: Component, ...rest }) => { 
  return(
    <Route
      {...rest}
      render={props =>
        isAuthenticated() ? (
          <Component {...props} />
        ) : (
          <Redirect to={{ pathname: "/login", state: { from: props.location } }} />
        )
      }
    />
  )
};


export default PrivateRoute;