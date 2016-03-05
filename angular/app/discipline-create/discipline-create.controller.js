(function(){
    "use strict";

    angular.module('app.controllers').controller('DisciplineCreateController', DisciplineCreateController);

    function DisciplineCreateController($scope, $state, DisciplineService){
        var vm = this;

        $scope.$on('create_discipline', function(e, discipline){

          DisciplineService.create(discipline).then(function(){
              $state.go('app.disciplines-list');
          });
        });
    }

})();
