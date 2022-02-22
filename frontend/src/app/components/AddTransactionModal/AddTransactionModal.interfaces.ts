import { TransactionParsedInterface } from "app/shared/interfaces/Transaction.interface";
import { CustomerInterface } from "app/shared/interfaces/Customer.interface";

export interface AddTransactionModalProps {
  isOpen: boolean;
  onClose: () => void;
  transaction: TransactionParsedInterface | null;
  transactionAdded: () => void;
  customer: CustomerInterface;
}

export interface AddTransactionFormDataInterface {
  value: string;
  transactionDate: string;
}
