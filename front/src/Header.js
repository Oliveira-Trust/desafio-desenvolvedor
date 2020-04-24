import React from 'react';

// import { Container } from './styles';

 function Headers({children}) {
  return (
   <header>
       <h1>{children}</h1>
   </header>
  );
}

export default Headers