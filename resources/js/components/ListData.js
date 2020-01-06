import React, { Component } from 'react';
import { Card, Page, DataTable } from '@shopify/polaris';
class componentName extends Component {
    constructor(props){
        super(props);
        this.state = {
            row: []
        }
    }

    
    componentWillMount() {
        let self = this;
        jQuery.getJSON("/wishlist_app/public/api/listdata", function (data) {
            self.setState({
                row: data.items
            })
        });
    }

    handleData(){
        var c = [];
        this.state.row.forEach(function(item){
            jQuery.getJSON("/products/"+item.product_handle+".js", function (product) {
                listdata.push([
                    product.title,
                    item.created_at,
                    item.customer_email
                ]);
            });
        })
        console.log(listdata);
    }
    
    render() {
        this.handleData;
        return (
            <Page title="Sales by product">
                <Card>
                    <DataTable
                        columnContentTypes={[
                            'text',
                            'text',
                            'text',
                        ]}
                        headings={[
                            'Product',
                            'Customer Email',
                            'Action at',
                        ]}
                        rows={[2,3,4]}
                        // totals={['', '', '', 255, '$155,830.00']}
                        showTotalsInFooter
                    />
                </Card>
            </Page>
        );
    }
}

export default componentName;