(function(){
    "use strict";

    angular.module('app.controllers').controller('SpecialtyCreateController', SpecialtyCreateController);

    function SpecialtyCreateController($scope, $state, SpecialtyService){
        var vm = this;

        $scope.$on('create_specialty', function(e, specialty){

          SpecialtyService.create(specialty).then(function(){
              $state.go('app.specialties-list');
          });
        });
    }

})();
