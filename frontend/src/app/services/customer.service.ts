import { AxiosPromise } from "axios";

import { ApiService } from "./api.service";
import {
  CustomerResponse,
  CustomerInterface,
  CustomerWithTransactionResponse,
} from "app/shared/interfaces/Customer.interface";

export const CustomerService = {
  getCustomers(): AxiosPromise<CustomerResponse> {
    return ApiService.get("customers");
  },
  getCustomerTransactions(
    customer: CustomerInterface
  ): AxiosPromise<CustomerWithTransactionResponse> {
    return ApiService.get(`customers/${customer.id}/transactions`);
  },
  addCustomer(
    data: Omit<CustomerInterface, "id" | "rewardPointsOverall">
  ): AxiosPromise {
    return ApiService.post("customers", data);
  },
  replaceCustomer(
    id: number,
    data: Omit<CustomerInterface, "id" | "rewardPointsOverall">
  ): AxiosPromise {
    return ApiService.put(`customers/${id}`, data);
  },
  deleteCustomer(id: number): AxiosPromise {
    return ApiService.delete(`customers/${id}`);
  },
};
