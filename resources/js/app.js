import React from "react";
import ReactDOM from "react-dom";
import {BrowserRouter as Router,Route} from 'react-router-dom';
import {AppProvider} from "@shopify/polaris";

import App from "./components/App";
import "@shopify/polaris/styles.css";
import Statistical from "./components/Statistical";

ReactDOM.render(
    <AppProvider>
        <Router basename="/wishlist_app/public">

            <Route path="/index" component={App}/>
            <Route path="/statistical" component={Statistical}/>
        </Router>
    </AppProvider>, document.getElementById("app")
);


