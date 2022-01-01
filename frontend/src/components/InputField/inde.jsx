import { StyledFormGroup, StyledLabel, StyledInput } from "./Styles";

export const TextInput = (props) => {
  const { type, id, name, label = "Título do campo", placeholder = null, value, onChange, ...outros } = props;
  return (
    <StyledFormGroup>
      <StyledLabel htmlFor={id || name}>{label}</StyledLabel>
      <StyledInput
          id={id ?? name}
          name={name}
          type={type}
          placeholder={placeholder}
          onChange={onChange}
          value={value}
          {...outros.field}
        />
    </StyledFormGroup>
  );
}