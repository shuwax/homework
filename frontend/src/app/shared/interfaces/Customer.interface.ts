import { TransactionParsedInterface } from "./Transaction.interface";

export interface CustomerResponse {
  data: Array<CustomerInterface>;
}

export interface CustomerWithTransactionResponse {
  data: CustomerWithTransactionInterface;
}

export interface CustomerInterface {
  id: number;
  name: string;
  rewardPointsOverall: number;
}

export interface CustomerWithTransactionInterface extends CustomerInterface{
    transactions: Array<TransactionParsedInterface>;
}
