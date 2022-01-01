import styled from "styled-components";

export const ContainerForm = styled.div`
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 100%;
    margin: 10px;
    
    & select {
        width: 100%;
        height: 50px;
        margin: 5px;
        font-size: 1.5rem;
        border-radius: 3px;
        background: ${({theme}) => theme.colors.background.white};        
        & option:active {
            padding: 50px;
            background: ${({theme}) => theme.colors.background.white};        
            border-bottom: 5px solid white;
        }
    }
    @media (min-width: 624px ){
        justify-content: flex-start;
    }
`
export const Error = styled.p`
    color: ${({theme}) => theme.colors.text.error};
`
export const TextInput = styled.input`
    padding: 10px;
    outline: none;
    border: none;
    border-radius: ${({theme}) => theme.borders.radius};
    background-color: ${({theme}) => theme.colors.background.inputs};
    margin: 3px;
    font-weight: bold;
    letter-spacing: 1.5px;
    width: 100%;
    flex: 1;
    flex-wrap: wrap;
    transition: 0.9s ease-in-out;

    &::placeholder {
        color: ${({theme}) => theme.colors.text.placeholder}
    }
    &.error {
        border: 1px solid red
    }
    &:focus {
        padding: 15px;
    }
`
export const InputArea = styled.input`
    margin: 3px;
    padding: 10px;
    outline: none;
    border: none;
    border-radius: ${({theme}) => theme.borders.radius};
    background-color: ${({theme}) => theme.colors.background.inputs};
    width: 100%;
    font-weight: bold;
    transition: 0.9s ease-in-out;

    &::placeholder {
        color: ${({theme}) => theme.colors.text.placeholder}
    }
    &.error {
        border: 1px solid red
    }
    &:focus {
        padding: 15px;
    }
`
export const Button = styled.button`
    padding: 10px;
    border: none;
    border-radius: 3px;
    background-color: rgba(61, 129, 22, 1);
    font-weight: 600;
    font-size: 15pt;;
    color: ${({theme})=> theme.colors.text.secondary};
    text-shadow: ${({theme})=> theme.colors.shadow.text};
    margin: 10px auto;
    cursor: pointer;

    &:hover {
        background-color: rgba(61, 129, 22, 0.5);
        color: ${({theme})=> theme.colors.text.primary};
        transform: ${({theme})=> theme.zoom.card};
    }

`
export const FieldLabel = styled.label`
    align-self: flex-start;
`