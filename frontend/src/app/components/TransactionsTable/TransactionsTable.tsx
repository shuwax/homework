import React, { useEffect, useState } from "react";

import TableContainer from "@material-ui/core/TableContainer";
import Table from "@material-ui/core/Table";
import TableHead from "@material-ui/core/TableHead";
import TableRow from "@material-ui/core/TableRow";
import TableCell from "@material-ui/core/TableCell";
import Paper from "@material-ui/core/Paper";
import { Button, TableBody } from "@material-ui/core";

import { CustomIconButton } from "app/components/CustomIconButton/CustomIconButton";
import { CustomDialog } from "app/components/CustomDialog/CustomDialog";
import { TransactionParsedInterface } from "app/shared/interfaces/Transaction.interface";
import { AddTransactionModal } from "app/components/AddTransactionModal/AddTransactionModal";
import { TransactionService } from "app/services/transaction.service";
import { convertTimeStampToDate } from "app/shared/utils/dateHandler";

import { TransactionsTableProps } from "./TransactionsTable.interfaces";

import { useStyles } from "./TransactionsTable.styles";


export function TransactionsTable({
  transactions,
  shouldUpdateTransactions,
  addClick,
  customer,
}: TransactionsTableProps) {
  const classes = useStyles();

  const [selectedTransaction, setSelectedTransaction] = useState<number>(0);
  const [transactionData, setTransactionData] =
    useState<TransactionParsedInterface | null>(null);

  const [openDeleteDialog, setOpenDeleteDialog] = useState<boolean>(false);
  const [openAddDialog, setOpenAddDialog] = useState<boolean>(false);

  useEffect(() => {
    if (addClick) {
      handleAddTransaction();
    }
  }, [addClick]);

  const getTransactionById = (id: number) =>
    transactions.find((transaction) => transaction.id === id);

  const handleOpenEditTransaction = (id: number) => {
    const transaction = getTransactionById(id);
    if (transaction) {
      setTransactionData(transaction);
      setOpenAddDialog(true);
    }
  };

  const handleOpenDeleteTransaction = (id: number) => {
    setSelectedTransaction(id);
    setOpenDeleteDialog(true);
  };

  const handleCloseAddDialog = () => {
    setOpenAddDialog(false);
    setTransactionData(null);
  };

  const handleTransactionAdded = () => {
    shouldUpdateTransactions();
    setOpenAddDialog(false);
    setTransactionData(null);
  };

  const handleAddTransaction = () => {
    setTransactionData(null);
    setOpenAddDialog(true);
  };

  const handleCloseDeleteCustomerDialog = () => {
    setOpenDeleteDialog(false);
  };

  const handleDeleteCustomer = () => {
    TransactionService.deleteTransaction(selectedTransaction)
      .then(() => {
        setOpenDeleteDialog(false);
        shouldUpdateTransactions();
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
              <TableCell>Value</TableCell>
              <TableCell>Date</TableCell>
              <TableCell className={classes.buttonsTableCell} align={"right"} />
            </TableRow>
          </TableHead>
          <TableBody>
            {transactions.map((transaction) => (
              <TableRow key={transaction.id}>
                <TableCell>{transaction.id}</TableCell>
                <TableCell>{transaction.value}</TableCell>
                <TableCell>
                  {convertTimeStampToDate(transaction.transactionDateTimeStamp)}
                </TableCell>
                <TableCell align={"right"} className={classes.buttonsTableCell}>
                  <CustomIconButton
                    onClick={() => handleOpenEditTransaction(transaction.id)}
                    type={"edit"}
                  />
                  <CustomIconButton
                    onClick={() => handleOpenDeleteTransaction(transaction.id)}
                    type={"delete"}
                  />
                </TableCell>
              </TableRow>
            ))}
          </TableBody>
        </Table>
      </TableContainer>
      <AddTransactionModal
        customer={customer}
        isOpen={openAddDialog}
        transaction={transactionData}
        onClose={handleCloseAddDialog}
        transactionAdded={handleTransactionAdded}
      />

      <CustomDialog
        title={"Remove Transaction"}
        onCloseDialog={handleCloseDeleteCustomerDialog}
        body={<>{`Are you sure to delete: ${selectedTransaction}`}</>}
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
