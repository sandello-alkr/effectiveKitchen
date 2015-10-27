module.exports = function (grunt) {
  'use strict';

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    bower: {
      install: {
        options: {
          install: true,
          copy: true,
          targetDir: './web/libs',
          cleanTargetDir: true,
          layout: "byComponent"
        }
      }
    },

    clean: {
      temp: {
        src: ['tmp']
      }
    },

    jshint: {
      all: ['Gruntfile.js', 'web/app/*.js', 'web/app/**/*.js']
    }

  });

  grunt.loadNpmTasks('grunt-bower-task');
  grunt.loadNpmTasks('grunt-contrib-concat');

  //grunt.registerTask('test', ['bower', 'jshint']);
  //grunt.registerTask('minified', ['bower', 'connect:server', 'watch:min']);
  //grunt.registerTask('package', ['bower', 'jshint', 'html2js:dist', 'bower_concat', 'concat:dist', 'uglify:dist', 'clean:temp', 'compress:dist']);
};
