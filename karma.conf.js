'use strict';

module.exports = function (config) {
  config.set({
    basePath: '',
    frameworks: ['jasmine'],
    files: [
      'tests/helpers/**/*.js',
      'tests/spec/components/**/*.js'
    ],
    preprocessors: {
      'tests/spec/components/**/*.js': ['webpack']
    },
    webpack: {
      cache: true,
      module: {
        loaders: [{
          test: /\.gif/,
          loader: 'url-loader?limit=10000&mimetype=image/gif'
        }, {
          test: /\.jpg/,
          loader: 'url-loader?limit=10000&mimetype=image/jpg'
        }, {
          test: /\.png/,
          loader: 'url-loader?limit=10000&mimetype=image/png'
        }, {
          test: /\.js/,
          loader: 'babel!jsx-loader?harmony'
        }, {
          test: /\.scss/,
          loader: 'style-loader!css-loader!sass-loader?outputStyle=expanded'
        }]
      },
      resolve: {
        alias: {
          'styles': './src/styles',
          'components': './src/scripts/components'
        }
      }
    },
    webpackServer: {
      stats: {
        colors: true
      }
    },
    exclude: [],
    port: 8080,
    logLevel: config.LOG_INFO,
    colors: true,
    autoWatch: false,
    browsers: ['PhantomJS'],
    reporters: ['progress'],
    captureTimeout: 60000,
    singleRun: true
  });
};
