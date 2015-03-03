# Tinderweb Build System Configuration
# ====================================

mountFolder = (connect, dir) ->
  return connect.static(require('path').resolve(dir))

webpackDistConfig = require './webpack.dist.config.js'
webpackDevConfig = require './webpack.dev.config.js'

module.exports = (grunt) ->

  # Variables
  # =========
  pkg   = grunt.file.readJSON('./package.json')

  # Load Tasks
  # ===========
  require('load-grunt-tasks') grunt

  # Configurations
  # ==============
  grunt.initConfig

    # Package
    # =======
    pkg: pkg

    # Notify
    # ======
    notify:
      build:
        options:
          title: pkg.name + '#' + pkg.version
          message: 'Build finished succesfully'

    # Webpack
    # ==========
    webpack:
      options: webpackDistConfig,
      dist:
        cache: false

    # Webpack Dev Server
    # ==================
    'webpack-dev-server':
      options:
        hot: true,
        port: 8000
        webpack: webpackDevConfig,
        publicPath: '/assets/'
        contentBase: 'public'
      start:
        keepAlive: true

    # Karma
    # =====
    unit:
      configFile: 'karma.conf.js'

    # Connect Middleware
    # ==================
    connect:
      options:
        port: 8000
      dist:
        options:
          keepAlive: true
          middleware: (connect) ->
            return [
              mountFolder(connect, 'public/dist')
            ]

    # Clean
    # =====
    clean:
      dist:
        files: [
          dot: true
          src: [
            'public/dist'
          ]
        ]

    # Copy
    # ====
    copy:
      dist:
        files: [
          {
            flatten: true
            expand: true
            src: 'public'
            dest: 'public/dist'
            filter: 'isFile'
          }
          {
            flatten: true
            expand: true
            src: 'public/images/*'
            dest: 'public/dist/images/'
          }
        ]

    # Bumpver
    # =======
    bump:
      options:
        files: [
          'package.json'
          'bower.json'
          'composer.json'
        ]
        commit: true
        commitMessage: 'Release v%VERSION%'
        commitFiles: ['-a']
        push: false

  # Default Task
  # ============
  grunt.registerTask 'default', ['work']

  # Begin Work
  # ==========
  grunt.registerTask 'work', (target) ->
    if target == 'dist'
      return grunt.task.run([
        'build'
        'connect:dist'
      ])
    grunt.task.run [
      'webpack-dev-server'
    ]

  # Build Project
  # =============
  grunt.registerTask 'build', [
    'clean'
    'copy'
    'webpack'
    'bump:patch'
    'notify:build'
  ]
