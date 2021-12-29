import  { lightTheme } from './lightTheme'

export const darkTheme = {...lightTheme,
    colors: {
        background: {
            primary: '#2A2F33',
            secondary: '#2A2F33',
            loader: '#f2f2f2',
            header: '#2A2F33',
            card: "#636262",
        },
        text: {
            primary: '#c7c5c9',
            secondary: '#D2D9D6',
            black: '#dedcdc',
            white: '#ababab',
        },
        shadow: {
            text: '5px 5px 5px rgba(255,255,255, 0.5);',
            primary:'3px 3px 20px 1px rgba(255,255,255, 0.5);',
            soft:'3px 3px 10px 1px rgba(255,255,255, 0.5);',
            white:'0px 0px 5px 2px #000;',
            footer: {
                primary: '0px 0px 20px white;',
            },
            header: {
                primary: '0px 0px 20px white;',
            },
        }
    },
    borders: {
        default: '1px solid #FFF',
        plataform: '2px solid #014479',
        radius: '5px;'
    }
}