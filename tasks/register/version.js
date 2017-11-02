/**
 * Created by DanielSilva on 02/11/17.
 */

var shell = require('shelljs');

module.exports = function (grunt) {
  grunt.registerTask('incrementar',"Incrementa a versão", function () {
    shell.exec("npm version prerelease");
  });
};
