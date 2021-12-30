
import React from 'react'
import { Redirect, Route } from 'react-router-dom'
import { getLocalStorage } from '../services/functions';

const PrivateRoute = ({ component: Component, ...rest }) => {
  
  return(
    <Route
      {...rest}
      render={props =>
        getLocalStorage() ? (
          <Component {...props} />
        ) : (
          <Redirect to={{ pathname: "/login", state: { from: props.location } }} />
        )
      }
    />
  )
};


export default PrivateRoute;