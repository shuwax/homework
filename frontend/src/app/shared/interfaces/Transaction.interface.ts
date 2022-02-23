import { CustomerInterface } from "app/shared/interfaces/Customer.interface";

export interface TransactionResponse {
  data: Array<TransactionInterface>;
}

export interface TransactionParsedResponse {
  data: Array<TransactionParsedInterface>;
}

export interface TransactionInterface {
  id: number;
  customer: CustomerInterface;
  value: number;
  rawValue: number;
  transactionDate: string;
}

export interface TransactionParsedInterface {
  id: number;
  value: number;
  transactionDate: string;
  transactionDateTimeStamp: number;
}

export interface TransactionSetInterface {
  value: number;
  customer: CustomerInterface;
  transactionDate: string;
}
