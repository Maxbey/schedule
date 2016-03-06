(function(){
    "use strict";

    angular.module('app.controllers').controller('DisciplineCreateController', DisciplineCreateController);

    function DisciplineCreateController($scope, $state, DisciplineService){
        $scope.$on('create_discipline', function(e, data){
          DisciplineService.create(data).then(function(){
              $state.go('app.disciplines-list');
          });
        });
    }

})();
