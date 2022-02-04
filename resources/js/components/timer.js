import React from 'react';
import ReactDOM from 'react-dom';

function tick() {
    const element = (
      <div>
  
        <h1>Hello, world!</h1>
        <h2>It is {new Date().toLocaleTimeString()}.</h2>
      </div>
    );
    ReactDOM.render(
      element,
      document.getElementById('root')
    );
  }
  
  
  class Clock extends React.Component {
    constructor(props) {
      super(props);
      this.state = { date: new Date() };
    }
  
    render() {
      return (
        <div>
          <h1>Hello, world!</h1>
          <h2>Show {this.state.date.toLocaleTimeString()}.</h2>
        </div>
      );
    }
  }
  
  export default {tick,Clock};