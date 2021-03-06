// Generated by CoffeeScript 1.7.1
(function() {
  var path;

  path = require('path');

  module.exports = function(grunt) {
    grunt.initConfig({
      pkg: grunt.file.readJSON('package.json'),
      banner: '/*\n' + ' <%= pkg.name %> v<%= pkg.version %>\n' + ' <%= pkg.homepage %>\n' + '*/\n',
      clean: {
        working: {
          src: ['angular-file-upload.*']
        }
      },
      uglify: {
        js: {
          src: ['angular-file-upload.js'],
          dest: 'angular-file-upload.min.js',
          options: {
            banner: '<%= banner %>',
            sourceMap: function(fileName) {
              return fileName.replace(/\.js$/, '.map');
            }
          }
        }
      },
      concat: {
        js: {
          options: {
            banner: '<%= banner %>',
            stripBanners: true
          },
          src: ['src/intro.js', 'src/module.js', 'src/outro.js'],
          dest: 'angular-file-upload.js'
        }
      }
    });
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-concat');
    return grunt.registerTask('default', ['clean', 'concat', 'uglify']);
  };

}).call(this);

//# sourceMappingURL=Gruntfile.map
