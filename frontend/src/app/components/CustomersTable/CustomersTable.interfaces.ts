import { CustomerInterface } from "../../shared/interfaces/Customer.interface";

export interface CustomersTableProps {
  customers: Array<CustomerInterface>;
  shouldUpdateCustomers: () => void;
  addClick: boolean;
  handleSelectedCustomer: (customer: CustomerInterface | null) => void;
}
