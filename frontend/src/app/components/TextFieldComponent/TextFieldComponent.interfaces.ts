import { FieldProps } from 'formik';
import { TextFieldProps } from '@material-ui/core';

export interface TextFieldComponentProps extends FieldProps, Omit<TextFieldProps, 'name' | 'value' | 'error'> {
  onChange: () => void;
}
