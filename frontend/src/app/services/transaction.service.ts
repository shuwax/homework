import { AxiosPromise } from "axios";
import {
  TransactionInterface,
  TransactionParsedResponse,
  TransactionSetInterface,
} from "app/shared/interfaces/Transaction.interface";

import { ApiService } from "./api.service";
import { CustomerInterface } from "../shared/interfaces/Customer.interface";

export const TransactionService = {
  getTransactions(): AxiosPromise<TransactionInterface> {
    return ApiService.get("transactions");
  },
  getTransactionsByCustomer(
    customer: CustomerInterface
  ): AxiosPromise<TransactionParsedResponse> {
    return ApiService.get(`transactions/customer/${customer.id}/period`);
  },
  addTransaction(data: Omit<TransactionSetInterface, "id">): AxiosPromise {
    return ApiService.post("transactions", data);
  },
  replaceTransaction(
    id: number,
    data: Omit<TransactionSetInterface, "id">
  ): AxiosPromise {
    return ApiService.put(`transactions/${id}`, data);
  },
  deleteTransaction(id: number): AxiosPromise {
    return ApiService.delete(`transactions/${id}`);
  },
};
