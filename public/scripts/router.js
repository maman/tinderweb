'use strict';

var React = require('react'),
    { Route, DefaultRoute } = require('react-router'),
    App = require('./bootstrap');

module.exports = (
  <Route handler={App}>
  </Route>
);
