import styled from 'styled-components'

export const Container = styled.div`
    max-width: 90%;
`
export const TitleTable = styled.h1`
    color: ${({ theme }) => theme.colors.text.primary};
    text-shadow: ${({ theme }) => theme.colors.shadow.text};
`
export const TableConversion = styled.table`
    display: table;
    width: 100%;
    margin-top: 20px;
    font-size: 0.8rem ;
    color: ${({ theme }) => theme.colors.text.primary};
    box-shadow: ${({ theme }) => theme.colors.shadow.primary};
`
export const TableHead = styled.thead`
`
export const TableRow = styled.tr`
        transition: 0.1s all;
        &:hover {
            cursor: pointer;
            background: ${({ theme }) => theme.colors.background.card};
            border-radius: ${({ theme }) => theme.borders.radius};
            transform: ${({ theme }) => theme.zoom.card};
        }
`
export const TableTh = styled.th`
    padding: 15px;
`
export const TableTd = styled.td`
    padding: 5px;
`
export const TableBody = styled.tbody`
`
