import React, { Component } from 'react';
import { Card, Page, DataTable, ActionList, Button, Popover } from '@shopify/polaris';

class TopTrending extends Component {
    constructor(props) {
        super(props);
        this.state = {
            row: [],
            active: false,
            time: "all"
        }
    }

    toggleActive = () => {
        this.setState({
            active: !this.state.active
        })
    }

    activator = (
        <Button onClick={this.toggleActive} disclosure>
            More actions
        </Button>
    );

    handleAllTime = () => {
        this.setState({
            time: "all"
        })
    }

    handleNearestMonth = () => {
        this.setState({
            time: "nearest month"
        })
    }

    componentWillMount() {
        let self = this;
        var { row, time } = this.state;
        jQuery.getJSON("/wishlist_app/public/api/toptrending/" + time, function (data) {
            data.items.forEach(function (item) {
                jQuery.getJSON("https://" + data.shop_url + "/products/" + item.product_handle + ".js", function (product) {
                    row.push([product.title, item.count]);
                    self.setState({
                        row: row
                    })
                });
            })
        });
    }

    render() {
        var { active } = this.state;
        return (
            <Page title="Sales by product">
                <div className="buttonLimitTopTrending">
                    <Popover active={active} activator={this.activator} onClose={this.toggleActive}>
                        <ActionList
                            items={[
                                {
                                    content: 'All',
                                    onAction: this.handleAllTime,
                                },
                                {
                                    content: 'Nearest month',
                                    onAction: this.handleNearestMonth,
                                },
                            ]}
                        />
                    </Popover>
                </div>

                <Card>
                    <DataTable
                        columnContentTypes={[
                            'text',
                            'text',
                        ]}
                        headings={[
                            'Product',
                            'Actions',
                        ]}
                        rows={this.state.row}
                        showTotalsInFooter
                    />
                </Card>
            </Page>
        );
    }
}

export default TopTrending;