import { makeStyles } from '@material-ui/core';

export const useStyles = makeStyles({
  appBar: {
    position: 'relative',
    zIndex: 1300,
    backgroundColor: '#535EDB',
  },
  toolbar: {
    minHeight: 50,
  },
  title: {
    display: 'flex',
    flexGrow: 1,
    textAlign: 'left',
    paddingLeft: 15,
    fontWeight: 'bold',
    fontSize: 18,
  }
});
