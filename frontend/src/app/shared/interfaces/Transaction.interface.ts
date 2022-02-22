import { CustomerInterface } from "app/shared/interfaces/Customer.interface";

export interface TransactionResponse {
  data: Array<TransactionInterface>;
}

export interface TransactionInterface {
  id: number;
  customer: CustomerInterface;
  value: number;
}

export interface TransactionParsedInterface {
    id: number;
    value: number;
    transactionDate: string;
    transactionDateTimeStamp: string;
}

export interface TransactionSetInterface {
    value: number;
    customerId: number;
    transactionDate: string;
}
