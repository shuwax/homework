import React, { useEffect, useState } from "react";
import Typography from "@material-ui/core/Typography";
import { CustomersTable } from "app/components/CustomersTable/CustomersTable";
import { CustomerInterface } from "app/shared/interfaces/Customer.interface";
import { CustomerService } from "app/services/customer.service";
import { HeaderButton } from "app/components/HeaderButton/HeaderButton";

function HomePage() {
  const [customers, setCustomers] = useState<Array<CustomerInterface>>([]);
  const [addButtonClicked, setAddButtonClicked] = useState<boolean>(false);

  useEffect(() => {
    loadCustomers();
  }, []);

  useEffect(() => {
    if (addButtonClicked) {
      setAddButtonClicked(false);
    }
  }, [addButtonClicked]);

  const loadCustomers = () => {
    CustomerService.getCustomers()
      .then(({ data: { data } }) => {
        setCustomers(data);
      })
      .catch((error) => {
        console.log(error);
      });
  };

  const handleAddButton = () => setAddButtonClicked(true);

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
      />

      <Typography variant={"h1"}>
        <span>Transactions</span>
      </Typography>
      {/*<CustomersTable customers={[]} shouldUpdateCustomers={loadCustomers} />*/}
    </div>
  );
}

export default HomePage;
