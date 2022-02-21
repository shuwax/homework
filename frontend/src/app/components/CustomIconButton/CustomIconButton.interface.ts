export interface CustomIconButtonProps {
  onClick: () => void;
  type: 'delete' | 'edit' | 'preview' | 'change';
  title?: string;
}
