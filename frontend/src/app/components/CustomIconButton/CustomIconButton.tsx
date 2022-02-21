import React from 'react';
import clsx from 'clsx';
import IconButton from '@material-ui/core/IconButton';
import DeleteIcon from '@material-ui/icons/Delete';
import EditIcon from '@material-ui/icons/Edit';
import VisibilityIcon from '@material-ui/icons/Visibility';
import LockIcon from '@material-ui/icons/Lock';

import { CustomIconButtonProps } from './CustomIconButton.interface';
import { useStyles } from './CustomIconButton.styles';

export function CustomIconButton({ type, onClick, title }: CustomIconButtonProps) {
  const classes = useStyles();

  return (
    <IconButton
      onClick={onClick}
      className={clsx({ [classes.deleteIcon]: type === 'delete', [classes.editIcon]: type === 'edit' })}
      title={title}
    >
      {type === 'delete' && <DeleteIcon fontSize={'small'} />}
      {type === 'edit' && <EditIcon fontSize={'small'} />}
      {type === 'preview' && <VisibilityIcon fontSize={'small'} />}
      {type === 'change' && <LockIcon fontSize={'small'} />}
    </IconButton>
  );
}
