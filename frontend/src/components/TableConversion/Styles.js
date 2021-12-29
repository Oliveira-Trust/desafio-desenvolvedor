import styled from 'styled-components'

export const Container = styled.div`
    max-width: 90%;
`

export const TableConversion = styled.table`
    display: flex;
    flex-direction: column;
`
export const TableHead = styled.thead`
    border: ${({theme}) => theme.borders.default};
    margin-bottom: 3px;
    font-size: 1.2rem;
    width: 100%;
    & tr {
        display: flex;
        justify-content: space-between;
        width: 100%;
        transition: 0.1s all;
        &:hover {
            background: ${({theme}) => theme.colors.background.card};
        }
        & th {
            padding: 5px;
        }
    }
`
export const TableBody = styled.thead`
    display: flex;
    flex-direction: column;
    border: ${({theme}) => theme.borders.default};
    & tr {
        display: flex;
        justify-content: space-between;
        width: 100%;
        transition: 0.1s all;
        &:hover {
            background: ${({theme}) => theme.colors.background.card};
        }
        & td {
            font-size: 1.2rem;
            padding: 5px;
        }
    }
`