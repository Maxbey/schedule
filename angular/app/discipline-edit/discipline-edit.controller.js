(function(){
    "use strict";

    angular.module('app.controllers').controller('DisciplineEditController', DisciplineEditController);

    function DisciplineEditController($stateParams, $state, $scope, DisciplineService){
        var vm = this;

        DisciplineService.get($stateParams.id).then(function(discipline){
          vm.discipline = discipline;
        });

        $scope.$on('update_discipline', function(e, discipline){
          console.log(discipline);
          discipline.save().then(function(){
            $state.go('app.disciplines-list');
          });
        });

        $scope.$on('delete_discipline', function(e, discipline){
          discipline.remove().then(function(){
            $state.go('app.disciplines-list');
          });
        });
    }

})();
