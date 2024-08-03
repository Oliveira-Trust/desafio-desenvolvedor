import * as React from "react";
import Box from "@mui/material/Box";
import { FormProvider, useForm } from "react-hook-form";

import styles from "./styles/FormInput.module.css";

export default function Form({ children, callbackSubmit }) {
  const methods = useForm();

  const onSubmit = (data) => {
    callbackSubmit(data);
  };

  return (
    <div className={styles.main}>
      <FormProvider {...methods}>
        <Box
          component="form"
          sx={{
            "& > :not(style)": { width: "100%" },
          }}
          autoComplete="off"
          onSubmit={methods.handleSubmit(onSubmit)}
        >
          {children}
        </Box>
      </FormProvider>
    </div>
  );
}
