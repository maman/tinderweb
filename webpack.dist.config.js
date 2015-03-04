'use strict';

var webpack = require('webpack');

module.exports = {
  output: {
    filename: 'main.js',
    path: 'public/dist/assets',
    publicPath: '/assets/'
  },
  cache: true,
  debug: false,
  devtool: false,
  entry: [
    './public/scripts/main.js'
  ],
  stats: {
    colors: true,
    reasons: true
  },
  plugins: [
    new webpack.optimize.DedupePlugin(),
    new webpack.optimize.UglifyJsPlugin(),
    new webpack.optimize.OccurenceOrderPlugin(),
    new webpack.optimize.AggressiveMergingPlugin(),
  ],
  resolve: {
    extensions: ['', '.js'],
    alias: {
      'styles': './public/styles',
      'components': './public/scripts/components/'
    }
  },
  module: {
    preLoaders: [{
      test: /\.js$/,
      exclude: /node_modules/,
      loader: 'jsxhint'
    }],
    loaders: [{
      test: /\.js$/,
      exclude: /node_modules/,
      loader: 'react-hot!babel!jsxloader?harmony'
    }, {
      test: /\.css$/,
      loader: 'style-loader!css-loader'
    }, {
      test: /\.(png|jpg)$/,
      loader: 'url-loader?limit=8192'
    }]
  }
};
