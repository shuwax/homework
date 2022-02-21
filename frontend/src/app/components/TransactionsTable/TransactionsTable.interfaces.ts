import { TransactionParsedInterface } from "app/shared/interfaces/Transaction.interface";
import { CustomerInterface } from "app/shared/interfaces/Customer.interface";

export interface TransactionsTableProps {
  transactions: Array<TransactionParsedInterface>;
  shouldUpdateTransactions: () => void;
  addClick: boolean;
  customer: CustomerInterface;
}
