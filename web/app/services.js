'use strict';

/* Services */

var tasks = angular.module('tasks', ['ngResource']);

tasks.factory('Task', ['$resource',
  function($resource){
    return $resource('/api/task/:id', null, {
      update: {
        method: 'PUT' // this method issues a PUT request
      }
    });
  }
]);