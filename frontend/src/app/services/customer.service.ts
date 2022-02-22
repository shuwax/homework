import { AxiosPromise } from "axios";

import { ApiService } from "./api.service";
import {
  CustomerResponse,
  CustomerInterface,
  CustomerRewardPointsResponse,
} from "app/shared/interfaces/Customer.interface";

export const CustomerService = {
  getCustomers(): AxiosPromise<CustomerResponse> {
    return ApiService.get("customers");
  },
  getCustomerRewardPoints(
    customer: CustomerInterface
  ): AxiosPromise<CustomerRewardPointsResponse> {
    return ApiService.get(`customers/${customer.id}/reward-points`);
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
