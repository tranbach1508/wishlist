import React, { Component } from 'react';
import { Card, Page, Layout, DisplayText } from '@shopify/polaris';
import Line from './Line';

class Dashboard extends Component {
    constructor(props) {
        super(props);
        this.state = {
            actions: 0,
            users: 0,
            products: 0
        }
    }

    componentWillMount() {
        let self = this;
        jQuery.getJSON("http://localhost:88/wishlist_app/public/api/dashboard", function (data) {
            var count = data;
            self.setState({
                actions: count.actions,
                users: count.users,
                products: count.products,
            })
        });
    }


    render() {
        var { actions, users, products } = this.state;
        return (
            <Page title="Total">
                <Layout>
                    <Layout.Section oneThird>
                        <Card title="Wishlist Actions" sectioned>
                            <DisplayText size="extraLarge">{actions}</DisplayText>
                        </Card>
                    </Layout.Section>
                    <Layout.Section oneThird>
                        <Card title="Users" sectioned>
                            <DisplayText size="extraLarge">{users}</DisplayText>
                        </Card>
                    </Layout.Section>
                    <Layout.Section oneThird>
                        <Card title="Products" sectioned>
                            <DisplayText size="extraLarge">{products}</DisplayText>
                        </Card>
                    </Layout.Section>
                </Layout>
                <div className="mt-50">
                    <Card title="Line Chart">
                        <div style={{ padding: "0 20px" }}>
                            <Line></Line>
                        </div>
                    </Card>
                </div>
            </Page>
        );
    }
}

export default Dashboard;
