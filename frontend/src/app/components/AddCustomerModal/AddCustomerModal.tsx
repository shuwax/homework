import React from "react";
import { Field, Form, Formik } from "formik";
import * as Yup from "yup";
import Button from "@material-ui/core/Button";

import { TextFieldComponent } from "app/components/TextFieldComponent/TextFieldComponent";
import { CustomDialog } from "app/components/CustomDialog/CustomDialog";
import { CustomerInterface } from "app/shared/interfaces/Customer.interface";
import { CustomerService } from "app/services/customer.service";

import {
  AddCustomerFormDataInterface,
  AddCustomerModalProps,
} from "./AddCustomerModal.interfaces";
import { useStyles } from "./AddCustomerModal.styles";

export function AddCustomerModal(props: AddCustomerModalProps) {
  const { isOpen, onClose, customer, customerAdded } = props;
  const classes = useStyles();

  const formData: AddCustomerFormDataInterface = {
    name: customer ? customer.name : "",
  };

  const validationSchema = Yup.object().shape({
    name: Yup.string().required("Podaj nazwę"),
  });

  return (
    <CustomDialog
      title={customer ? "Customer edit" : "Add customer"}
      isOpen={isOpen}
      onCloseDialog={onClose}
      body={
        <Formik
          initialValues={formData}
          validationSchema={validationSchema}
          onSubmit={(values, actions) => {
            const customerData: Omit<
              CustomerInterface,
              "id" | "rewardPointsOverall"
            > = {
              name: values.name.trim(),
            };
            if (customer && customer.id) {
              CustomerService.replaceCustomer(customer.id, customerData)
                .then(() => {
                  customerAdded();
                })
                .catch((error) => {
                  console.log(error);
                });
            } else {
              CustomerService.addCustomer(customerData)
                .then(() => {
                  customerAdded();
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
                name={"name"}
                label={"Nazwa"}
                fullWidth
              />
              <div className={classes.actionButtons}>
                <Button color={"primary"} onClick={submitForm}>
                  {customer ? "Save" : "Add"}
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
