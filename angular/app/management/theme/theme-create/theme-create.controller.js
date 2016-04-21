(function(){
    "use strict";

    angular.module('app.controllers').controller('ThemeCreateController', ThemeCreateController);

    function ThemeCreateController($scope, $state, $stateParams, DisciplineService){
      var vm = this;

      DisciplineService.get($stateParams.id).then(function(discipline){
        vm.discipline = discipline;
      });

      vm.goBack = function(){
        $state.go('management.themes-list', {id: $stateParams.id});
      };
    }

})();
