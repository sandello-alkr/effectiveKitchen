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

controllers.controller('RecipeBuilderCtrl', ['$scope', '$routeParams', 'Recipe', 'Task',
  function($scope, $routeParams, Recipe, Task) {
    $scope.tasks = Task.query();
    Recipe.get({id: $routeParams.id})
      .$promise.then(function(recipe) {
        console.log(recipe);
        $scope.recipe = recipe;
        $scope.update = function() {
          Recipe.update({id: $scope.recipe.id}, $scope.recipe);
        };
      }).catch(function(e){
        $scope.recipe = {};
        $scope.recipe['flows'] = [];
        $scope.recipe['flows'][0] = [];
        console.log(e);
        $scope.update = function() {
          Recipe.save($scope.recipe);
        };
      })

    $scope.dropCallback = function(event, ui) {
      $scope.recipe.flows[0]
      // $(ui.draggable).detach().css({top: 0,left: 0}).appendTo(event.target);
      console.log('hey, you dumped me :-(' , $scope.draggedTitle);
    };

    $scope.overCallback = function(event, ui) {
      console.log('Look, I`m over you');
    };

    $scope.outCallback = function(event, ui) {
      console.log('I`m not, hehe');
    };
  }
]);