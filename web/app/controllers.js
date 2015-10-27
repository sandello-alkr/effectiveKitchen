'use strict';

/* Controllers */

var controllers = angular.module('controllers', []);

controllers.controller('TaskListCtrl', ['$scope', 'Task',
  function($scope, Task) {
    $scope.tasks = Task.query();
  }
]);

controllers.controller('TaskDetailCtrl', ['$scope', '$routeParams', 'Task',
  function($scope, $routeParams, Task) {
    Task.get({id: $routeParams.id})
      .$promise.then(function(task) {
        console.log(task);
        $scope.task = task;
        $scope.update = function() {
          Task.update({id: $scope.task.id}, $scope.task);
        };
      }).catch(function(e){
        console.log(e);
        $scope.update = function() {
          Task.save($scope.task);
        };
      })
  }
]);