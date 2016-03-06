(function(){
    "use strict";

    angular.module('app.controllers').controller('DisciplineDetailsController', DisciplineDetailsController);

    function DisciplineDetailsController($stateParams, DisciplineService){
        var vm = this;

        DisciplineService.get($stateParams.id).then(function(discipline){
          vm.discipline = discipline;
        });
    }

})();
