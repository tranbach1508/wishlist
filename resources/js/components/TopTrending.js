import React, { Component } from 'react';
import { Card, Page, DataTable, Popover, ActionList, Button } from '@shopify/polaris';

class componentName extends Component {
    constructor(props) {
        super(props);
        this.state = {
            row: [],
            active: true,
            time: "all"
        }
    }

    toogleActive = () => {
        this.setState({
            active: !active
        })
    }

    activator = () => {
        <Button onClick={toggleActive} disclosure>
            More actions
        </Button>
    }

    handleAllTime = () =>{
        this.setState({
            time: "all"
        })
    }

    handleNearestMonth = () =>{
        this.setState({
            time: "nearest month"
        })
    }

    componentWillMount() {
        let self = this;
        var { row } = this.state;
        jQuery.getJSON("/wishlist_app/public/api/toptrending", function (data) {
            data.items.forEach(function (item) {
                console.log(item);
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
        var {active} = this.state;
        return (
            <Page title="Sales by product">
                <Card>
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

export default componentName;