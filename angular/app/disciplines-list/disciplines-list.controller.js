(function(){
    "use strict";

    angular.module('app.controllers').controller('DisciplinesListController', DisciplinesListController);

    function DisciplinesListController(DisciplineService, $state){
        var vm = this;

        var renderList = function(){
            DisciplineService.all().then(function(disciplines){
                vm.disciplines = disciplines;
            });
        };

        vm.edit = function(discipline){
          $state.go('app.discipline-edit', {'id': discipline.id});
        };

        renderList();
    }

})();
