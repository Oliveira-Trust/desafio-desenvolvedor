import { ReactKeycloakProvider } from '@react-keycloak/web';
import React from 'react';
import { AppRouter } from './AppRouter';
import { keycloak, keycloakProviderInitConfig } from './utils/auth';

function App() {
  return (
    <ReactKeycloakProvider authClient={keycloak} initOptions={keycloakProviderInitConfig}>
        <AppRouter />
    </ReactKeycloakProvider>
  );
}

export default App;
