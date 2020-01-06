import React, { Component } from "react";
import Chart from "react-apexcharts";

class Line extends Component {
  constructor(props) {
    super(props);

    this.state = {
      options: {
        chart: {
          id: "basic-bar"
        },
        xaxis: {
          categories: []
        },
        stroke: {
          curve: 'smooth',
        },
      },
      series: [
        {
          name: "series-1",
          data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
        }
      ]
    };
  }

  componentWillMount() {
    var self = this;
    var { series, options } = this.state;
    jQuery.getJSON('/wishlist_app/public/api/linechart', function (data) {
      series = [
        {
          name: "Actions",
          data: data.actions
        },
        {
          name: "Users",
          data: data.users
        },
        {
          name: "Products",
          data: data.products
        },
      ];
      options = {
        chart: {
          id: "basic-bar"
        },
        xaxis: {
          categories: data.months
        },
        stroke: {
          curve: 'smooth',
        },
      },
      self.setState({
        options: options,
        series: series
      })
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
              width="100%"
              height="auto"
            />
          </div>
        </div>
      </div>
    );
  }
}

export default Line;