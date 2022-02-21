import { AxiosPromise } from "axios";
import {
  TransactionInterface,
  TransactionSetInterface,
} from "app/shared/interfaces/Transaction.interface";

import { ApiService } from "./api.service";

export const TransactionService = {
  getTransactions(): AxiosPromise<TransactionInterface> {
    return ApiService.get("transactions");
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
