import React, { useState } from "react";

import TableContainer from "@material-ui/core/TableContainer";
import Table from "@material-ui/core/Table";
import TableHead from "@material-ui/core/TableHead";
import TableRow from "@material-ui/core/TableRow";
import TableCell from "@material-ui/core/TableCell";
import Paper from "@material-ui/core/Paper";
import { TableBody } from "@material-ui/core";

import { CustomersTableProps } from "./CustomersTable.interfaces";

import { useStyles } from "./CustomersTable.styles";
import { CustomIconButton } from "../CustomIconButton/CustomIconButton";
import { CustomerInterface } from "../../shared/interfaces/Customer.interface";
import {AddCustomerModal} from "../AddCustomerModal/AddCustomerModal";

export function CustomersTable({
  customers,
  shouldUpdateCustomers,
}: CustomersTableProps) {
  const classes = useStyles();

  const [selectedCustomer, setSelectedCustomer] = useState<number>(0);
  const [customerData, setCustomerData] = useState<CustomerInterface | null>(
    null
  );

  const [openDeleteDialog, setOpenDeleteDialog] = useState<boolean>(false);
  const [openAddDialog, setOpenAddDialog] = useState<boolean>(false);

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
    </div>
  );
}
