import React from "react";
import { Routes, Route, BrowserRouter } from "react-router-dom";

import { createTheme, ThemeProvider } from "@material-ui/core/styles";
import { plPL } from "@material-ui/core/locale";

import { routes } from "app/shared/constants";
import { Layout } from "app/components/Layout/Layout";
import { theme } from "app/styles/theme";

import HomePage from "app/views/HomePage/HomePage";

import "./App.css";


function App() {
  return (
    <div className={"App"}>
      <ThemeProvider theme={createTheme(theme, plPL)}>
        <BrowserRouter>
          <Layout />
          <div className={"App-body"}>
            <Routes>
              <Route path={routes.HOME.route} element={<HomePage/>} />
            </Routes>
          </div>
        </BrowserRouter>
      </ThemeProvider>
    </div>
  );
}

export default App;
