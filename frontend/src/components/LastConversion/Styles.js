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
    text-shadow: ${({theme}) => theme.colors.shadow.text};
    margin: 5px;
`
export const Item = styled.p`
    font-size: 0.7em;
    color: ${({theme}) => theme.colors.text.white};
    text-shadow: ${({theme}) => theme.colors.shadow.text};
    margin: 5px;
`
export const ItemValue = styled.span`
    font-size: 0.7em;
    font-weight: border;
    text-shadow: ${({theme}) => theme.colors.shadow.white};

`