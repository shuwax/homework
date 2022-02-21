import { CustomerInterface } from "../interfaces/Customer.interface";

export const getCustomerName = (customer: CustomerInterface) => {
  return customer.name;
};
