'use strict';

var React = require('react'),
    LinkedStateMixin = require('react/lib/LinkedStateMixin'),
    { Navigation } = require('react-router');

var Main = React.createClass({
  mixins: [LinkedStateMixin, Navigation],

  render() {
    return (
      <div className='main'>
        <p>lorem ipsum dolor</p>
      </div>
    );
  }
});

module.exports = Main;
