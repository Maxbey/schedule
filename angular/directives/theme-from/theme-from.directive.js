(function(){
    "use strict";

    angular.module('app.controllers').controller('ThemeFromController', ThemeFromController);

    function ThemeFromController($scope, $state, $stateParams, SelectHelpersService, TeacherService, AudienceService, ThemeService, ToastService, DialogService){
        var vm = this;

        vm.theme = $scope.theme;
        if(!vm.theme){
          vm.theme = ThemeService.getEmptyInstance();
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
            return vm.teachers.filter(SelectHelpersService.notAlreadySelectedFilter(vm.theme.teachers.data));
          return teachersQuerySearch(criteria);
        };

        vm.audiencesSearch = function(criteria){
          if(!criteria)
            return vm.audiences.filter(SelectHelpersService.notAlreadySelectedFilter(vm.theme.audiences.data));
          return audiencesQuerySearch(criteria);
        };

        function createFilterForTeachers(query){
          SelectHelpersService.createFilter(query, 'name', vm.theme.teachers.data);
        }

        function createFilterForAudiences(query){
          SelectHelpersService.createFilter(query, 'location', vm.theme.audiences.data);
        }

        function audiencesQuerySearch(criteria){
          return SelectHelpersService.querySearch(vm.audiences, createFilterForAudiences, criteria);
        }

        function teachersQuerySearch(criteria){
          return SelectHelpersService.querySearch(vm.teachers, createFilterForTeachers, criteria);
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
