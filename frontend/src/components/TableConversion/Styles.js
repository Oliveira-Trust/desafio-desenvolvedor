import styled from 'styled-components'

export const Container = styled.div`
    max-width: 90%;
`
export const TableConversion = styled.table`
    display: flex;
    flex-direction: column;
    margin-top: 20px;
    color: ${({theme}) => theme.colors.text.primary};
    box-shadow: ${({theme}) => theme.colors.shadow.primary};
`
export const TableHead = styled.thead`
    margin-bottom: 3px;
    font-size: 1.2rem;
    width: 100%;
    & tr {
        display: flex;
        justify-content: space-between;
        width: 100%;
        transition: 0.1s all;
        &:hover {
            cursor: pointer;
            background: ${({theme}) => theme.colors.background.card};
            border-radius: ${({theme}) => theme.borders.radius};
            transform: ${({theme})=> theme.zoom.card};
        }
        & th {
            border-right: ${({theme}) => theme.borders.default};
            flex: 1;
            font-size: 0.8rem;
            padding: 5px;
        }
    }
`
export const TableBody = styled(TableHead)`
    & tr {
        display: flex;
        justify-content: space-between;
        width: 100%;
        transition: 0.1s all;
        border: ${({theme}) => theme.borders.default};
        & td {
            border-right: ${({theme}) => theme.borders.default};
            flex: 1;
            font-size: 0.7rem;
            padding: 5px;
        }
    }
`
export const TitleTable = styled.h1`
    color: ${({theme}) => theme.colors.text.primary};
    text-shadow: ${({theme})=> theme.colors.shadow.text};
`