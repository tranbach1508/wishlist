import React, { Component } from 'react';
import {Card, DataTable, Page} from '@shopify/polaris';

class Statistical extends Component {
    constructor(props){
        super(props);
        this.state = {
            row: []
        }
    }

    componentWillMount(){
        let self = this;
        jQuery.getJSON("http://localhost:88/wishlist_app/public/api/statistical",function(data){
            var top_wishlist = data.top_wishlist;
            self.setState({
                row: top_wishlist
            })
        })
    }


    render() {
        var {row} = this.state;
        row.sort(function (a,b){
            if(a.quantity>b.quantity){
                return -1;
            }else if(a.quantity<b.quantity){
                return 1;
            }else{
                return 0;
            }
        })
        const rows = [];
        row.map(product =>{
            rows.push(
                [product.product_handle,product.quantity],
            )
        })
        return (
            <div className="container">
                <Page title="The most favorite products">
            <Card>
              <DataTable
                columnContentTypes={[
                  'text',
                  'numeric',
                ]}
                headings={[
                  'Product',
                  'Likes',
                ]}
                rows={rows}
              />
            </Card>
          </Page>
            </div>
            
        );
    }
}

export default Statistical;