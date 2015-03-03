'use strict';

var React = require('react');
var Router = require('react-router'),
    routes = require('./router');

Router.run(routes, Router.HistoryLocation, function (Handler) {
  React.render(<Handler/>, document.body);
});
