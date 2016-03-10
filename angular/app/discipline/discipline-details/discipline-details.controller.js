(function(){
    "use strict";

    angular.module('app.controllers').controller('DisciplineDetailsController', DisciplineDetailsController);

    function DisciplineDetailsController($state, $stateParams, DisciplineService){
        var vm = this;

        vm.goToThemes = function(){
          $state.go('app.themes-list', {id: $stateParams.id});
        };

        DisciplineService.get($stateParams.id).then(function(discipline){
          vm.discipline = discipline;
        });
    }

})();
