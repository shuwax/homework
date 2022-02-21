import React from "react";
import { getIn } from "formik";
import MuiTextField, { TextFieldProps } from "@material-ui/core/TextField";

import { TextFieldComponentProps } from "./TextFieldComponent.interfaces";

function properties({
  field,
  form: { isSubmitting, touched, errors },
  onChange,
  ...props
}: TextFieldComponentProps): TextFieldProps {
  const fieldError = getIn(errors, field.name);
  const showError = getIn(touched, field.name) && !!fieldError;

  const propertiesToReturn = {
    ...props,
    ...field,
    error: showError,
    helperText: showError ? fieldError : props.helperText,
    variant: props.variant,
  };

  return  { ...propertiesToReturn };
}

export function TextFieldComponent({
  children,
  ...props
}: TextFieldComponentProps) {
  return <MuiTextField {...properties(props)}>{children}</MuiTextField>;
}
