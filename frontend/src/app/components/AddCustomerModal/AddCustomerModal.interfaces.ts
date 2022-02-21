import { CustomerInterface } from "../../shared/interfaces/Customer.interface";

export interface AddCustomerModalProps {
  isOpen: boolean;
  onClose: () => void;
  customer: CustomerInterface | null;
  customerAdded: () => void;
}

export interface AddCustomerFormDataInterface {
  name: string;
}
