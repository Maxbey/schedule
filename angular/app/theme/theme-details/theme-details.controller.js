(function(){
    "use strict";

    angular.module('app.controllers').controller('ThemeDetailsController', ThemeDetailsController);

    function ThemeDetailsController($state, $stateParams, ThemeService){
        var vm = this;

        ThemeService.get($stateParams.themeId).then(function(theme){
          vm.theme = theme;
        });

        vm.goBack = function(){
          $state.go('app.themes-list', {id: $stateParams.id});
        };

    }

})();
