import React from "react";
import AppBar from "@material-ui/core/AppBar";
import Toolbar from "@material-ui/core/Toolbar";
import Typography from "@material-ui/core/Typography";

import { useStyles } from "./Layout.styles";

export function Layout() {
  const classes = useStyles();

  return (
    <>
      <>
        <AppBar position={"static"} className={classes.appBar}>
          <Toolbar className={classes.toolbar}>
            <Typography variant="h6" className={classes.title}>
              <div>Homework</div>
            </Typography>
          </Toolbar>
        </AppBar>
      </>
    </>
  );
}
