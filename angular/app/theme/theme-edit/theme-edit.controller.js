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

        vm.goBack = function(){
          $state.go('app.themes-list', {id: $stateParams.id});
        };
    }

})();
