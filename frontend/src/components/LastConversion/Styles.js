import styled from "styled-components";

export const Container = styled.div`
    margin-top: 20px;
    display: flex;
    flex-direction: column;
    max-width: 650px;
    background-color: ${({theme}) => theme.colors.background.card};

    padding: 20px;
    border-radius: ${({theme}) => theme.borders.radius};
    box-shadow: ${({theme}) => theme.colors.shadow.primary};
`
export const TitleLastConversion = styled.h3`
    text-align: center;
    text-decoration: underline;
    color: ${({theme}) => theme.colors.text.white};
    text-shadow: ${({theme}) => theme.colors.shadow.text};
    margin: 5px;
`
export const Item = styled.p`
    color: ${({theme}) => theme.colors.text.white};
    border: ${({theme}) => theme.borders.default};
    text-shadow: ${({theme}) => theme.colors.shadow.text};
    font-size: 1.3em;
    margin: 5px;
    padding: 15px;
    display: flex;
    justify-content: space-between;
`
export const ItemValue = styled.span`
    font-weight: border;
    text-shadow: ${({theme}) => theme.colors.shadow.value};

`