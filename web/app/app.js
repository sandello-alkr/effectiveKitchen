'use strict';

/* App Module */

var app = angular.module('effectiveKitchen', [
  'ngRoute',
  'ngDragDrop',
  'controllers',
  'tasks',
  'recipes',
  'ngDialog'
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
      when('/tasks/:id', {
        templateUrl: '/app/views/task/detail.html',
        controller: 'TaskDetailCtrl'
      }).
      when('/recipe/:id/builder', {
        templateUrl: '/app/views/recipe/builder.html',
        controller: 'RecipeBuilderCtrl'
      }).
      otherwise({
        redirectTo: 'tasks'
      });
  }
]);
