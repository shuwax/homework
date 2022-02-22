import { TransactionParsedInterface } from "./Transaction.interface";

export interface CustomerResponse {
  data: Array<CustomerInterface>;
}

export interface CustomerRewardPointsResponse {
  data: {
    rewardPoints: number;
  };
}

export interface CustomerWithTransactionResponse {
  data: CustomerWithTransactionInterface;
}

export interface CustomerInterface {
  id: number;
  name: string;
}

export interface CustomerWithTransactionInterface extends CustomerInterface {
  transactions: Array<TransactionParsedInterface>;
}
