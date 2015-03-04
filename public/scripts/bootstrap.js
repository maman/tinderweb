'use strict';

var React = require('react'),
    Main = require('./components/Main'),
    DocumentTitle = require('react-document-title'),
    { RouteHandler } = require('react-router'),
    { PropTypes } = React;

var bootstrap = React.createClass({
  propTypes: {
    params: PropTypes.object.isRequired,
    query: PropTypes.object.isRequired
  },

  render(){
    return (
      <DocumentTitle title='TinderWeb'>
        <div id='wrapper'>
          <Main />
          <RouteHandler {...this.props} />
        </div>
      </DocumentTitle>
    );
  }
});

module.exports = bootstrap;
