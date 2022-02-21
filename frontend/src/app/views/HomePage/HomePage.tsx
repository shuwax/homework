import React, { useEffect, useState } from "react";
import Typography from "@material-ui/core/Typography";
import { CustomersTable } from "app/components/CustomersTable/CustomersTable";
import {
  CustomerInterface,
  CustomerWithTransactionInterface,
} from "app/shared/interfaces/Customer.interface";
import { CustomerService } from "app/services/customer.service";
import { HeaderButton } from "app/components/HeaderButton/HeaderButton";
import { getCustomerName } from "app/shared/utils/customerDataHandler";

function HomePage() {
  const [selectedCustomer, setSelectedCustomer] =
    useState<CustomerInterface | null>(null);
  const [customers, setCustomers] = useState<Array<CustomerInterface>>([]);
  const [customerTransactions, setCustomerTransactions] =
    useState<CustomerWithTransactionInterface | null>(null);
  const [addButtonClicked, setAddButtonClicked] = useState<boolean>(false);

  useEffect(() => {
    loadCustomers();
  }, []);

  useEffect(() => {
    if (selectedCustomer) {
      loadCustomersAllTransactions(selectedCustomer);
    } else {
      setCustomerTransactions(null);
    }
  }, [selectedCustomer]);

  useEffect(() => {
    if (addButtonClicked) {
      setAddButtonClicked(false);
    }
  }, [addButtonClicked]);

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

  const loadCustomersAllTransactions = (customer: CustomerInterface) => {
    CustomerService.getCustomerTransactions(customer)
      .then(({ data: { data } }) => {
        setCustomerTransactions(data);
      })
      .catch((error) => {
        console.log(error);
      });
  };

  const handleAddButton = () => {
    setAddButtonClicked(true);
    setSelectedCustomer(null);
  };

  const handleSelectedCustomer = (customer: CustomerInterface | null) =>
    setSelectedCustomer(customer);

  return (
    <div>
      <Typography variant={"h1"}>
        <span>Customers</span>
        <div>
          <HeaderButton onClick={handleAddButton} label={"Add customer"} />
        </div>
      </Typography>
      <CustomersTable
        customers={customers}
        shouldUpdateCustomers={loadCustomers}
        addClick={addButtonClicked}
        handleSelectedCustomer={handleSelectedCustomer}
      />

      {selectedCustomer ? (
        <div>
          <Typography variant={"h1"}>
            <span>
              Last three month transactions for user:{" "}
              {getCustomerName(selectedCustomer)}
            </span>
          </Typography>
          {/*<CustomersTable customers={[]} shouldUpdateCustomers={loadCustomers} />*/}
        </div>
      ) : null}
    </div>
  );
}

export default HomePage;
