'use strict';

/* App Module */

var app = angular.module('effectiveKitchen', [
  'ngRoute',
  'controllers',
  'tasks'
]);

app.config(function($resourceProvider) {
  $resourceProvider.defaults.stripTrailingSlashes = false;
});

app.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
      when('/tasks', {
        templateUrl: '/app/views/task/list.html',
        controller: 'TaskListCtrl'
      }).
      /*when('/tasks/new', {
        templateUrl: '/app/views/task/detail.html',
        controller: 'TaskNewCtrl'
      }).*/
      when('/tasks/:id', {
        templateUrl: '/app/views/task/detail.html',
        controller: 'TaskDetailCtrl'
      }).
      otherwise({
        redirectTo: 'tasks'
      });
  }
]);
