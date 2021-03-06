import React from "react";
import { Field, Form, Formik } from "formik";
import * as Yup from "yup";
import Button from "@material-ui/core/Button";

import { TextFieldComponent } from "app/components/TextFieldComponent/TextFieldComponent";
import { CustomDialog } from "app/components/CustomDialog/CustomDialog";
import { TransactionSetInterface } from "app/shared/interfaces/Transaction.interface";
import { TransactionService } from "app/services/transaction.service";
import { getCurrentDate, getFormatDate } from "app/shared/utils/dateHandler";

import {
  AddTransactionFormDataInterface,
  AddTransactionModalProps,
} from "./AddTransactionModal.interfaces";
import { useStyles } from "./AddTransactionModal.styles";

export function AddTransactionModal(props: AddTransactionModalProps) {
  const { isOpen, onClose, transaction, transactionAdded, customer } = props;
  const classes = useStyles();

  const formData: AddTransactionFormDataInterface = {
    value: transaction ? transaction.value.toString() : "",
    transactionDate: transaction
      ? getFormatDate(transaction.transactionDate)
      : getCurrentDate(),
  };

  const validationSchema = Yup.object().shape({
    value: Yup.number().required("Set value"),
    transactionDate: Yup.date().required("Set value"),
  });

  return (
    <CustomDialog
      title={transaction ? "Transaction edit" : "Add transaction"}
      isOpen={isOpen}
      onCloseDialog={onClose}
      body={
        <Formik
          initialValues={formData}
          validationSchema={validationSchema}
          onSubmit={(values, actions) => {
            const transactionData: TransactionSetInterface = {
              value: parseFloat(values.value) || 0,
              customer: customer,
              transactionDate: values.transactionDate,
            };
            if (transaction && transaction.id) {
              TransactionService.replaceTransaction(
                transaction.id,
                transactionData
              )
                .then(() => {
                  transactionAdded();
                })
                .catch((error) => {
                  console.log(error);
                });
            } else {
              TransactionService.addTransaction(transactionData)
                .then(() => {
                  transactionAdded();
                })
                .catch((error) => {
                  console.log(error);
                });
            }
          }}
        >
          {({ submitForm }) => (
            <Form>
              <Field
                component={TextFieldComponent}
                name={"value"}
                label={"Value"}
                fullWidth
              />
              <Field
                InputLabelProps={{ shrink: true }}
                type={"date"}
                component={TextFieldComponent}
                name={"transactionDate"}
                label={"Transaction Date"}
                fullWidth
              />
              <div className={classes.actionButtons}>
                <Button color={"primary"} onClick={submitForm}>
                  {transaction ? "Save" : "Add"}
                </Button>
                <Button color={"primary"} autoFocus onClick={onClose}>
                  Cancel
                </Button>
              </div>
            </Form>
          )}
        </Formik>
      }
    />
  );
}
