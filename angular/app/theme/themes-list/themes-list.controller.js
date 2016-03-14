(function(){
    "use strict";

    angular.module('app.controllers').controller('ThemesListController', ThemesListController);

    function ThemesListController($state, $stateParams, DisciplineService, DialogService){
        var vm = this;

        vm.goBack = function(){
          $state.go('app.discipline-details', {id: $stateParams.id});
        };

        vm.goToCreate = function(){
          $state.go('app.theme-create', {id: $stateParams.id});
        };

        vm.edit = function(theme){
          $state.go('app.theme-edit', {
            id: $stateParams.id,
            themeId: theme.id
          });
        };

        vm.details = function(theme){
          $state.go('app.theme-details', {
            id: $stateParams.id,
            themeId: theme.id
          });
        };

        DisciplineService.get($stateParams.id).then(function(discipline){
          vm.discipline = discipline;

          if(!discipline.themes.data.length){
            DialogService.action(
              'Данная дисциплина не имеет тем. Создать новую ?',
               'Перейти к созданию'
             ).then(function(){
               vm.goToCreate();
             });
          }
        });
    }

})();
