import React, { useEffect, useState } from "react";
import Typography from "@material-ui/core/Typography";
import { CustomersTable } from "../../components/CustomersTable/CustomersTable";
import { CustomerInterface } from "../../shared/interfaces/Customer.interface";
import { CustomerService } from "../../services/customer.service";

function HomePage() {
  const [customers, setCustomers] = useState<Array<CustomerInterface>>([]);

  useEffect(() => {
    loadCustomers();
  }, []);

  const loadCustomers = () => {
    CustomerService.getCustomers()
      .then(({ data: { data } }) => {
        setCustomers(data);
      })
      .catch((error) => {
        console.log(error);
      });
  };
  return (
    <div>
      <Typography variant={"h1"}>
        <span>Customers</span>
      </Typography>
      <CustomersTable
        customers={customers}
        shouldUpdateCustomers={loadCustomers}
      />

      <Typography variant={"h1"}>
        <span>Transactions</span>
      </Typography>
      <CustomersTable customers={[]} shouldUpdateCustomers={loadCustomers} />
    </div>
  );
}

export default HomePage;
