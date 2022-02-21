import { TransactionParsedInterface } from "../../shared/interfaces/Transaction.interface";
import {CustomerInterface} from "../../shared/interfaces/Customer.interface";

export interface AddTransactionModalProps {
  isOpen: boolean;
  onClose: () => void;
  transaction: TransactionParsedInterface | null;
  transactionAdded: () => void;
  customer: CustomerInterface
}

export interface AddTransactionFormDataInterface {
  value: number;
}
