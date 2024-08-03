interface IConfiguration {
    appVersion: string;
    appName: string;
    apiUrl: string;
}

export const configuration: IConfiguration = {
    appVersion: import.meta.env.VITE_APP_VERSION,
    appName: import.meta.env.VITE_APP_NAME,
    apiUrl: import.meta.env.VITE_API_URL,
};