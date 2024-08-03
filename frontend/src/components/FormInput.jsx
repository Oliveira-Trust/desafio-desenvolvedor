import { useEffect, useCallback, useState } from "react";
import { useFormContext } from "react-hook-form";

import MuiTextField from "@mui/material/TextField";
import { forwardRef } from "react";

import styles from "./styles/FormInput.module.css";

const Input = forwardRef((props, ref) => {
  const [inputValue, setInputValue] = useState(props.value ?? "");

  const {
    register,
    formState: { errors },
  } = useFormContext();

  const handleValueChanged = useCallback(
    (e) => {
      setInputValue(e.target.value);

      if (typeof props.cbValueChanged === "function") {
        props.cbValueChanged(e.target.value);
      }
    },
    [setInputValue, props]
  );

  useEffect(() => {
    if (typeof props.value !== "undefined") {
      setInputValue(props.value);
    }
  }, [props]);

  return (
    <div className={styles.container}>
      <MuiTextField
        className={errors?.name && "input-error"}
        sx={{ width: "100%" }}
        ref={ref}
        label={props.label}
        name={props.name}
        variant={props.variant}
        onChangeCapture={(e) => handleValueChanged(e)}
        value={inputValue}
        disabled={props.disabled}
        InputProps={props.InputProps}
        type={props.type}
        color="success"
        {...register(props.name, {
          required: props.required ? `${props.label} É obrigatório!` : false,
        })}
      />
      {errors?.[props.name]?.type === "required" && (
        <p className={styles.error_message}>
          <strong>*</strong>
          {errors?.[props.name]?.message}
        </p>
      )}
    </div>
  );
});

export default Input;
