import React, { useEffect, useState } from "react";

import TableContainer from "@material-ui/core/TableContainer";
import Table from "@material-ui/core/Table";
import TableHead from "@material-ui/core/TableHead";
import TableRow from "@material-ui/core/TableRow";
import TableCell from "@material-ui/core/TableCell";
import Paper from "@material-ui/core/Paper";
import { Button, TableBody } from "@material-ui/core";

import { CustomIconButton } from "app/components/CustomIconButton/CustomIconButton";
import { CustomerInterface } from "app/shared/interfaces/Customer.interface";
import { AddCustomerModal } from "app/components/AddCustomerModal/AddCustomerModal";
import { CustomDialog } from "app/components/CustomDialog/CustomDialog";
import { CustomerService } from "app/services/customer.service";

import { CustomersTableProps } from "./CustomersTable.interfaces";

import { useStyles } from "./CustomersTable.styles";

export function CustomersTable({
  customers,
  shouldUpdateCustomers,
  addClick,
}: CustomersTableProps) {
  const classes = useStyles();

  const [selectedCustomer, setSelectedCustomer] = useState<number>(0);
  const [customerData, setCustomerData] = useState<CustomerInterface | null>(
    null
  );

  const [openDeleteDialog, setOpenDeleteDialog] = useState<boolean>(false);
  const [openAddDialog, setOpenAddDialog] = useState<boolean>(false);

  useEffect(() => {
    if (addClick) {
      handleAddCustomer();
    }
  }, [addClick]);

  const getCustomerById = (id: number) =>
    customers.find((customer) => customer.id === id);

  const handleOpenEditCustomer = (id: number) => {
    const customer = getCustomerById(id);
    if (customer) {
      setCustomerData(customer);
      setOpenAddDialog(true);
    }
  };

  const handleOpenDeleteCustomer = (id: number) => {
    setSelectedCustomer(id);
    setOpenDeleteDialog(true);
  };

  const handleCloseAddDialog = () => {
    setOpenAddDialog(false);
    setCustomerData(null);
  };

  const handleCustomerAdded = () => {
    shouldUpdateCustomers();
    setOpenAddDialog(false);
    setCustomerData(null);
  };

  const handleAddCustomer = () => {
    setCustomerData(null);
    setOpenAddDialog(true);
  };

  const handleCloseDeleteCustomerDialog = () => {
    setOpenDeleteDialog(false);
  };

  const getCustomerName = (id: number) => {
    const customer = getCustomerById(id);
    return customer ? customer.name : "";
  };

  const handleDeleteCustomer = () => {
    CustomerService.deleteCustomer(selectedCustomer)
      .then(() => {
        setOpenDeleteDialog(false);
        shouldUpdateCustomers();
      })
      .catch((error) => {
        console.log(error);
      });
  };

  return (
    <div>
      <TableContainer component={Paper} className={classes.tableContainer}>
        <Table stickyHeader>
          <TableHead>
            <TableRow>
              <TableCell>ID</TableCell>
              <TableCell>Name</TableCell>
              <TableCell>Reward Points Overall</TableCell>
              <TableCell className={classes.buttonsTableCell} align={"right"} />
            </TableRow>
          </TableHead>
          <TableBody>
            {customers.map((customer) => (
              <TableRow key={customer.id}>
                <TableCell>{customer.id}</TableCell>
                <TableCell>{customer.name}</TableCell>
                <TableCell>{customer.rewardPointsOverall}</TableCell>
                <TableCell align={"right"} className={classes.buttonsTableCell}>
                  <CustomIconButton
                    onClick={() => handleOpenEditCustomer(customer.id)}
                    type={"edit"}
                  />
                  <CustomIconButton
                    onClick={() => handleOpenDeleteCustomer(customer.id)}
                    type={"delete"}
                  />
                </TableCell>
              </TableRow>
            ))}
          </TableBody>
        </Table>
      </TableContainer>
      <AddCustomerModal
        isOpen={openAddDialog}
        customer={customerData}
        onClose={handleCloseAddDialog}
        customerAdded={handleCustomerAdded}
      />

      <CustomDialog
        title={"Remove customer"}
        onCloseDialog={handleCloseDeleteCustomerDialog}
        body={
          <>
            {"Are you sure to delete: "}

            {getCustomerName(selectedCustomer)}
          </>
        }
        isOpen={openDeleteDialog}
        dialogActions={
          <>
            <Button color={"primary"} onClick={handleDeleteCustomer}>
              Yes
            </Button>
            <Button
              color={"primary"}
              autoFocus
              onClick={handleCloseDeleteCustomerDialog}
            >
              No
            </Button>
          </>
        }
      />
    </div>
  );
}
