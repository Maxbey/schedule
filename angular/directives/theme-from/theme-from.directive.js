(function(){
    "use strict";

    angular.module('app.controllers').controller('ThemeFromController', ThemeFromController);

    function ThemeFromController($scope, CollectionHelpersService, TeacherService, AudienceService){
        var vm = this;

        vm.theme = $scope.theme;
        if(!vm.theme){
          vm.theme = {
            audiences:{
              data:[]
            },
            teachers:{
              data:[]
            }
          };
        }

        TeacherService.all().then(function(teachers){
          vm.teachers = teachers;
        });

        AudienceService.all().then(function(audiences){
          vm.audiences = audiences;
        });

        vm.teachersSearch = function(criteria){
          return querySearch(criteria, 0);
        };

        vm.audiencesSearch = function(criteria){
          return querySearch(criteria, 1);
        };

        function createFilterForTeachers(query){
          return function filterFn(teacher){
            var matchTheName = teacher.name.indexOf(query) != -1;
            var notAlreadySelected = CollectionHelpersService.exists(vm.theme.teachers.data, teacher.id) === false;
            return (matchTheName && notAlreadySelected);
          };
        }

        function createFilterForAudiences(query){
          return function filterFn(audience){
            var matchTheLocation = audience.location.indexOf(query) != -1;
            var notAlreadySelected = CollectionHelpersService.exists(vm.theme.audiences.data, audience.id) === false;
            return (matchTheLocation && notAlreadySelected);
          };
        }

        function querySearch(criteria, type){
          var cachedQuery = cachedQuery || criteria;

          if(type === 0)
            return cachedQuery ? vm.teachers.filter(createFilterForTeachers(cachedQuery)) : [];
          else
            return cachedQuery ? vm.audiences.filter(createFilterForAudiences(cachedQuery)) : [];
        }

        vm.create = function(){
          $scope.$emit('create_theme', vm.theme);
        };

        vm.update = function(){
          $scope.$emit('update_theme', vm.theme);
        };

        vm.delete = function(){
          $scope.$emit('delete_theme', vm.theme);
        };
    }

})();
