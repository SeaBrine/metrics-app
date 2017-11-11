/**
 * Created by DanielSilva on 11/11/17.
 */

var gulp = require('gulp');
var shell = require('shelljs');

gulp.task('version', function () {
  shell.exec("npm version prerelease -f");
});

gulp.watch(['api/**/*.js', 'config/**/*.js', 'views/**/*.ejs'], ['version']);
