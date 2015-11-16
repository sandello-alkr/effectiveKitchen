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

controllers.controller('RecipeBuilderCtrl', ['$scope', '$q', '$routeParams', 'Recipe', 'Task', 'ngDialog',
  function($scope, $q, $routeParams, Recipe, Task, ngDialog) {
    $scope.tasks = Task.query();
    Recipe.get({id: $routeParams.id})
      .$promise.then(function(recipe) {
        console.log(recipe);
        $scope.recipe = recipe;
        $scope.update = function() {
          /*$scope.recipe.flows.each(function(f, i) {
            console.log('i', i);
            console.log('f', f);
            var tasks = [];
            f.forEach(function(task, i) {
              tasks.push(task);
              delete f[i];
            })
            console.log(tasks);
            f.tasks = tasks;
          })
          console.log($scope.recipe);*/
          Recipe.update({id: $scope.recipe.id}, $scope.recipe);
        };
      }).catch(function(e){
        $scope.recipe = {};
        $scope.recipe['flows'] = [];
        $scope.recipe['flows'].push([]);
        console.log(e);
        $scope.update = function() {
          ngDialog.open({
            template: '/app/views/recipe/popupTmpl.html',
            controller: ['$scope', 'Recipe', function($scope, Recipe) {
              $scope.save = function() {
                Recipe.save($scope.recipe);
              }
            }]
          });
        };
      })

    $scope.dragStart = function(event, ui) {
      $(event.target).parent().droppable('disable');
    };

    $scope.dragStop = function(event, ui) {
      $('.flow').droppable('enable');
    };

    $scope.beforeDrop = function(event, ui) {
      var deferred = $q.defer();
      if ($(event.target).scope().$parent.$id == $(event.toElement).scope().$id) {
        deferred.resolve();
      } else {
        deferred.reject();
      }
      return deferred.promise;
    }

    $scope.addFlow = function() {
      $scope.recipe['flows'].push({tasks:[]})
    }
  }
]);