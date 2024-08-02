const environment = import.meta.env;

export interface IConfiguration {
    environment: string;
    applicationName: string;
    applicationVersion: string;
    apiUrl: string;
}

class Configuration implements IConfiguration {
    private _environment: string = environment.VITE_ENV ?? 'development';
    private _applicationName: string = environment.VITE_APP_NAME ?? 'App';
    private _applicationVersion: string = environment.VITE_APP_VERSION;
    private _apiUrl: string = '';

    public async initialize() {
        const resp = await fetch('/config.json');
        const json = (await resp.json()) as IConfiguration;

        this._apiUrl = json.apiUrl;
    }

    get environment() {
        return this._environment;
    }

    get applicationName() {
        return this._applicationName;
    }

    get applicationVersion() {
        return this._applicationVersion;
    }

    get apiUrl() {
        return this._apiUrl;
    }
}

export const configuration = new Configuration();
