import React, { Component } from "react";
import Chart from "react-apexcharts";

class LineChart extends Component {
  constructor(props) {
    super(props);

    this.state = {
      options: {
        stroke: {
          curve: 'smooth'
        },
        labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
      },
      series: [
        {
          name: 'Actions',
          type: 'line',
          data: [10,0,25,30,45,50,33,55,76,87,23,45]
        }, 
        {
          name: 'Users',
          type: 'line',
          data: [11,22,33,45,67,32,78,43,76,45,87,56]
        },
        {
          name: 'Products',
          type: 'line',
          data: [45,65,24,31,48,57,98,45,62,46,79,84]
        }
      ]
    };
  }

  componentDidMount(){
    let self = this;
    var months = this.state.options.labels;
    var {series} = this.state;
    for(var i=0;i<months.length;i++){
        jQuery.getJSON('/wishlist_app/public/api/'+months[i],function(data){
            series[0].data[i] = data.actions;
            series[1].data[i] = data.users;
            series[2].data[i] = data.products;
            
        })
    }
    self.setState({
      series: series
    })
  }

  render() {
    return (
      <div className="app">
        <div className="row">
          <div className="mixed-chart">
            <Chart
                options={this.state.options}
                series={this.state.series}
                type="line"
                width="914"
            />
          </div>
        </div>
      </div>
    );
  }
}

export default LineChart;