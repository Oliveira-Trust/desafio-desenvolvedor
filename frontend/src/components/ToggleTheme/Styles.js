import styled from "styled-components";

export const Container = styled.div`
    width: 100%;
    display: flex;
    justify-content: center;
    margin-bottom:10px;
    font-size: 25pt;
    @media (min-width: 425px) {
        align-items: center;
        justify-content: flex-end;
        max-width: 120px;
    }
    @media (min-width: 768px) {
        margin: auto;
        max-width: unset;
    }
    & svg {
        cursor: pointer;
    }
`