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
        var {row}= this.state;

        jQuery.getJSON("/wishlist_app/public/api/listdata", function (data) {
            data.items.forEach(function(item){
                jQuery.getJSON("https://"+data.shop_url+"/products/"+item.product_handle+".js", function(product) {
                    row.push([product.title,item.customer_email,item.created_at]);
                    self.setState({
                        row: row
                    })
                  } );
            })
        });
    }
    
    render() {
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
                        rows={this.state.row}
                        // totals={['', '', '', 255, '$155,830.00']}
                        showTotalsInFooter
                    />
                </Card>
            </Page>
        );
    }
}

export default componentName;