module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    // uglify: {
    //   options: {
    //     banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
    //   },
    //   build: {
    //     src: 'src/<%= pkg.name %>.js',
    //     dest: 'build/<%= pkg.name %>.min.js'
    //   }
    // },
	autoprefixer: {
    	options: {
      		// Task-specific options go here.
    		// browsers: ['last 2 versions', 'ie 8', 'ie 9'],
    		browsers: ['Explorer >= 8'],
    		map: true
    	},
    	your_target: {
      		// Target-specific file lists and/or options go here.
    	},
		dist: {
	        files: {
	            'css/build/style.css': 'css/style.css'
	        }
	    }
  	},
  	watch: {
        styles: {
            files: ['css/style.css'],
            tasks: ['autoprefixer']
        }
    }
  });

  // Load the plugin that provides the "uglify" task.
  // grunt.loadNpmTasks('grunt-contrib-uglify');

  // Load autoprefixr
  grunt.loadNpmTasks('grunt-autoprefixer');
  
  // Default task(s).
  // grunt.registerTask('default', ['uglify']);
  grunt.registerTask('default', ['autoprefixer']);

  // Load watch task
  grunt.loadNpmTasks('grunt-contrib-watch');

};



