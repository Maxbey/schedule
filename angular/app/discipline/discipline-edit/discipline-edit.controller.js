(function(){
    "use strict";

    angular.module('app.controllers').controller('DisciplineEditController', DisciplineEditController);

    function DisciplineEditController($stateParams, DisciplineService){
        var vm = this;

        DisciplineService.get($stateParams.id).then(function(discipline){
          vm.discipline = discipline;
        });
    }

})();
