import { makeStyles, Theme } from "@material-ui/core";

export const useStyles = makeStyles(({ maxHeightTable }: Theme) => ({
  tableContainer: {
    margin: "0 20px",
    width: "calc(100% - 40px)",
    maxHeight: maxHeightTable,
  },
  buttonsTableCell: {
    padding: 5,
    width: 100,
    minWidth: 100,
  },
  tableRowContainer: {
    cursor: "pointer",
  },
}));
