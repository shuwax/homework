import React from 'react';
import Dialog from '@material-ui/core/Dialog';
import DialogActions from '@material-ui/core/DialogActions';
import DialogContent from '@material-ui/core/DialogContent';
import DialogTitle from '@material-ui/core/DialogTitle';
import IconButton from '@material-ui/core/IconButton';
import CloseIcon from '@material-ui/icons/Close';

import { CustomDialogProps } from './CustomDialog.interfaces';
import { useStyles } from './CustomDialog.styles';

export function CustomDialog(props: CustomDialogProps) {
  const { title, body, isOpen, dialogActions, maxWidth = 'sm', hideCloseButton, onCloseDialog } = props;
  const classes = useStyles();

  return (
    <Dialog
      maxWidth={maxWidth}
      open={isOpen}
      aria-labelledby="alert-dialog-title"
      aria-describedby="alert-dialog-description"
    >
      {!hideCloseButton && (
        <IconButton className={classes.closeButton} onClick={onCloseDialog}>
          <CloseIcon fontSize={'small'} />
        </IconButton>
      )}
      <DialogTitle>{title}</DialogTitle>
      <DialogContent>{body}</DialogContent>
      {dialogActions && <DialogActions>{dialogActions}</DialogActions>}
    </Dialog>
  );
}
