import { ThemeOptions } from '@material-ui/core/styles/createTheme';
import { CSSProperties } from 'react';

declare module '@material-ui/core/styles/createTheme' {
  interface Theme {
    maxHeightTable: CSSProperties['height'];
  }

  interface ThemeOptions {
    maxHeightTable?: CSSProperties['height'];
  }
}

const maxHeightTable = 'calc(100vh - 170px)';

export const theme: ThemeOptions = {
  maxHeightTable,
  overrides: {
    MuiTableRow: {
      root: {
        '&:nth-of-type(odd):not($head):not($footer)': {
          backgroundColor: '#edeefb',
        },
      },
    },
    MuiTableCell: {
      root: {
        borderBottom: 'none',
        '&:not($head)': {
          borderLeft: '1px solid rgba(224, 224, 224, 1)',
        },
        '&$head': {
          borderBottom: '1px solid rgba(224, 224, 224, 1)',
          color: '#bdbdbd',
          fontWeight: 'bold',
        },
        '&$footer': {
          borderTop: '1px solid rgba(224, 224, 224, 1)',
        },
      },
    },
    MuiTypography: {
      h1: {
        display: 'flex',
        alignItems: 'center',
        justifyContent: 'space-between',
        fontSize: 20,
        fontWeight: 'bold',
        padding: 25,
        textAlign: 'left',
        color: '#707070',
        backgroundColor: '#eeeeee',
      },
    },
    MuiButton: {
      containedPrimary: {
        backgroundColor: '#535edb',
      },
    },
    MuiTooltip: {
      tooltip: {
        fontSize: 13,
      },
    },
  },
};
