import styled from "styled-components";

export const StyledFormGroup = styled.div`
  width: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: flex-start;
  margin: 0.75em;
`
export const StyledInput = styled.input`
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
    &:focus {
        padding: 15px;
    }
`
export const StyledLabel = styled.label`
  font-size: 0.85rem;
  line-height: 1.5rem;
`