(function(){
    "use strict";

    angular.module('app.controllers').controller('ThemeCreateController', ThemeCreateController);

    function ThemeCreateController($scope, $state, $stateParams, ThemeService, DisciplineService){
      var vm = this;

      DisciplineService.get($stateParams.id).then(function(discipline){
        vm.discipline = discipline;
      });

      $scope.$on('create_theme', function(e, theme){
        theme.discipline_id = $stateParams.id;
        ThemeService.create(theme).then(function(){
            $state.go('app.themes-list', {id: $stateParams.id});
        });
      });

      vm.goBack = function(){
        $state.go('app.themes-list', {id: $stateParams.id});
      };
    }

})();
