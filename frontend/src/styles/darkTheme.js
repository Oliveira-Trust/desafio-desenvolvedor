import  { lightTheme } from './lightTheme'

export const darkTheme = {...lightTheme,
    colors: {
        background: {
            secondary: '#2A2F33',
            card: "#636262",
        },
        text: {
            primary: '#c7c5c9',
            secondary: '#D2D9D6',
            error: 'red',
            sucess: 'green',
            white: '#fff',
        },
        shadow: {
            text: '5px 5px 5px rgba(255,255,255, 0.5);',
            primary:'3px 3px 20px 1px rgba(255,255,255, 0.5);',
            white:'0px 0px 5px 2px #000;',
            value:'0px 0px 5px 1px #e1e1e;',
            header: {
                primary: '0px 0px 20px white;',
            },
        }
    },
    borders: {
        default: '1px solid #FFF',
        radius: '5px;'
    }
}