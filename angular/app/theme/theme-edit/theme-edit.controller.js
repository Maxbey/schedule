(function(){
    "use strict";

    angular.module('app.controllers').controller('ThemeEditController', ThemeEditController);

    function ThemeEditController($scope, $state, $stateParams, ThemeService, DisciplineService){
        var vm = this;

        DisciplineService.get($stateParams.id).then(function(discipline){
          vm.discipline = discipline;
        });

        ThemeService.get($stateParams.themeId).then(function(theme){
          vm.theme = theme;
        });

        $scope.$on('update_theme', function(e, theme){
          theme.discipline_id = $stateParams.id;
          ThemeService.update(theme).then(function(){
            $state.go('app.themes-list', {id: $stateParams.id});
          });
        });

        $scope.$on('delete_theme', function(e, theme){
          theme.remove().then(function(){
            $state.go('app.themes-list', {id: $stateParams.id});
          });
        });

        vm.goBack = function(){
          $state.go('app.themes-list', {id: $stateParams.id});
        };
    }

})();
