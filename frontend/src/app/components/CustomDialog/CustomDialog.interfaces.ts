import React from 'react';

export interface CustomDialogProps {
  title: string;
  body: React.ReactNode;
  isOpen: boolean;
  dialogActions?: React.ReactNode;
  maxWidth?: false | 'sm' | 'xs' | 'md' | 'lg' | 'xl';
  hideCloseButton?: boolean;
  onCloseDialog?: () => void;
}
