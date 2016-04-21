(function(){
    "use strict";

    angular.module('app.controllers').controller('ThemeFromController', ThemeFromController);

    function ThemeFromController($scope, $state, $stateParams, CollectionHelpersService, TeacherService, AudienceService, ThemeService, ToastService, DialogService){
        var vm = this;

        vm.theme = $scope.theme;
        if(!vm.theme){
          vm.theme = {
            audiences:{
              data:[]
            },
            teachers:{
              data:[]
            },
            prevThemes:{
              data:[]
            }
          };
        }

        vm.theme.discipline_id = $stateParams.id;
        $scope.prevThemes = vm.theme.prevThemes.data;

        vm.buttonLocked = false;

        TeacherService.all().then(function(teachers){
          vm.teachers = teachers;
        });

        AudienceService.all().then(function(audiences){
          vm.audiences = audiences;
        });

        vm.teachersSearch = function(criteria){
          if(!criteria)
            return vm.teachers.filter(notAlreadySelectedFilter(vm.theme.teachers.data));
          return querySearch(criteria, 0);
        };

        vm.audiencesSearch = function(criteria){
          if(!criteria)
            return vm.audiences.filter(notAlreadySelectedFilter(vm.theme.audiences.data));
          return querySearch(criteria, 1);
        };

        function notAlreadySelectedFilter(collection){
          return function filterFn(item) {
            var notAlreadySelected = CollectionHelpersService.exists(collection, item.id) === false;
            return notAlreadySelected;
          };
        }

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

        function checkTeachersAdequacy(){
          return vm.theme.teachers_count <= vm.theme.teachers.data.length;
        }

        function checkAudiencesAdequacy(){
          return vm.theme.audiences_count <= vm.theme.audiences.data.length;
        }

        function showNotEnoughTeachersAlert(){
          DialogService.alert('Ошибка!', 'Для занятия по теме требуется больше преподавателей, чем было прикреплено');
        }

        function showNotEnoughAudiencesAlert(){
          DialogService.alert('Ошибка!', 'Для занятия по теме требуется больше аудиторий, чем было прикреплено');
        }

        vm.create = function(){
          if(!checkTeachersAdequacy()){
            showNotEnoughTeachersAlert();
            return;
          }

          if(!checkAudiencesAdequacy()){
            showNotEnoughAudiencesAlert();
            return;
          }

          vm.buttonLocked = true;
          ThemeService.create(vm.theme).then(function(){
            ToastService.show('Тема создана');
            $state.go('management.themes-list', {id: $stateParams.id});
          }, function(){
            vm.buttonLocked = false;
          });
        };

        vm.update = function(){
          if(!checkTeachersAdequacy()){
            showNotEnoughTeachersAlert();
            return;
          }

          if(!checkAudiencesAdequacy()){
            showNotEnoughAudiencesAlert();
            return;
          }

          vm.buttonLocked = true;
          ThemeService.update(vm.theme).then(function(){
            ToastService.show('Тема обновлена');
            $state.go('management.themes-list', {id: $stateParams.id});
          }, function(){
            vm.buttonLocked = false;
          });
        };

        vm.delete = function(){
          DialogService.delete('Вы действительно хотите удалить тему ?').then(function(){
            vm.buttonLocked = true;
            vm.theme.remove().then(function(){
              ToastService.show('Тема удалена');
              $state.go('management.themes-list', {id: $stateParams.id});
            });
          });
        };

        vm.getSetPrevThemesModal = function(){
          DialogService.fromTemplate('set-prev-themes', $scope);
        };
    }

})();
