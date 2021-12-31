import styled from "styled-components";

export const Section = styled.section`
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 2%;
    color: ${({theme}) => theme.colors.text.primary};
`