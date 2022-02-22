import React, { useEffect, useState } from "react";
import Typography from "@material-ui/core/Typography";

import { CustomersTable } from "app/components/CustomersTable/CustomersTable";
import { CustomerInterface } from "app/shared/interfaces/Customer.interface";
import { CustomerService } from "app/services/customer.service";
import { HeaderButton } from "app/components/HeaderButton/HeaderButton";
import { getCustomerName } from "app/shared/utils/customerDataHandler";
import { TransactionsTable } from "app/components/TransactionsTable/TransactionsTable";
import { TransactionParsedInterface } from "app/shared/interfaces/Transaction.interface";
import { TransactionService } from "../../services/transaction.service";

function HomePage() {
  const [selectedCustomer, setSelectedCustomer] =
    useState<CustomerInterface | null>(null);
  const [customers, setCustomers] = useState<Array<CustomerInterface>>([]);
  const [customerTransactions, setCustomerTransactions] = useState<
    Array<TransactionParsedInterface>
  >([]);
  const [addCustomerButtonClicked, setAddCustomerButtonClicked] =
    useState<boolean>(false);
  const [addTransactionButtonClicked, setAddTransactionButtonClicked] =
    useState<boolean>(false);

  const [customerRewardPoints, setCustomerRewardPoints] = useState<number>(0);

  useEffect(() => {
    loadCustomers();
  }, []);

  useEffect(() => {
    if (selectedCustomer) {
      loadCustomersAllTransactions();
    } else {
      setCustomerTransactions([]);
    }
  }, [selectedCustomer]);

  useEffect(() => {
    if (addCustomerButtonClicked) {
      setAddCustomerButtonClicked(false);
    }
  }, [addCustomerButtonClicked]);

  useEffect(() => {
    if (addTransactionButtonClicked) {
      setAddTransactionButtonClicked(false);
    }
  }, [addTransactionButtonClicked]);

  const loadCustomers = () => {
    CustomerService.getCustomers()
      .then(({ data: { data } }) => {
        setCustomers(data);
        setSelectedCustomer(null);
      })
      .catch((error) => {
        console.log(error);
      });
  };

  const loadCustomerRewardPoints = () => {
    if (!selectedCustomer) {
      return;
    }
    CustomerService.getCustomerRewardPoints(selectedCustomer)
      .then(({ data: { data } }) => {
        setCustomerRewardPoints(data.rewardPoints);
      })
      .catch((error) => {
        console.log(error);
      });
  };
  const loadCustomersAllTransactions = () => {
    if (!selectedCustomer) {
      return;
    }
    TransactionService.getTransactionsByCustomer(selectedCustomer)
      .then(({ data: { data } }) => {
        setCustomerTransactions(data);
        loadCustomerRewardPoints();
      })
      .catch((error) => {
        console.log(error);
      });
  };

  const handleAddCustomerButton = () => {
    setAddCustomerButtonClicked(true);
    setSelectedCustomer(null);
  };

  const handleSelectedCustomer = (customer: CustomerInterface | null) =>
    setSelectedCustomer(customer);

  const handleAddTransactionButton = () => {
    setAddTransactionButtonClicked(true);
  };
  return (
    <div>
      <Typography variant={"h1"}>
        <span>Customers</span>
        <div>
          <HeaderButton
            onClick={handleAddCustomerButton}
            label={"Add customer"}
          />
        </div>
      </Typography>
      <CustomersTable
        customers={customers}
        shouldUpdateCustomers={loadCustomers}
        addClick={addCustomerButtonClicked}
        handleSelectedCustomer={handleSelectedCustomer}
      />

      {selectedCustomer ? (
        <div>
          <Typography variant={"h1"}>
            <span>
              Last three month transactions for user:{" "}
              {getCustomerName(selectedCustomer)}
            </span>
            <span>Reward points: {customerRewardPoints}</span>
            <div>
              <HeaderButton
                onClick={handleAddTransactionButton}
                label={"Add transaction"}
              />
            </div>
          </Typography>
          <TransactionsTable
            customer={selectedCustomer}
            transactions={customerTransactions}
            addClick={addTransactionButtonClicked}
            shouldUpdateTransactions={loadCustomersAllTransactions}
          />
        </div>
      ) : null}
    </div>
  );
}

export default HomePage;
