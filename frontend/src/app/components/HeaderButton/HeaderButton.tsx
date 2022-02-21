import React from 'react';
import Button from '@material-ui/core/Button';
import AddIcon from '@material-ui/icons/Add';

import { HeaderButtonProps } from './HeaderButton.interface';
import { useStyles } from './HeaderButton.styles';

export function HeaderButton({ onClick, label }: HeaderButtonProps) {
  const classes = useStyles();

  return (
    <Button variant={'contained'} color={'primary'} startIcon={<AddIcon />} className={classes.root} onClick={onClick}>
      {label}
    </Button>
  );
}
