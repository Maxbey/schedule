(function(){
    "use strict";

    angular.module('app.controllers').controller('SpecialtyEditController', SpecialtyEditController);

    function SpecialtyEditController($stateParams, $state, $scope, SpecialtyService){
        var vm = this;

        SpecialtyService.get($stateParams.id).then(function(specialty){
          vm.specialty = specialty;
        });

        $scope.$on('update_specialty', function(e, specialty){
          SpecialtyService.update(specialty).then(function(){
            $state.go('app.specialties-list');
          });
        });

        $scope.$on('delete_specialty', function(e, specialty){
          specialty.remove().then(function(){
            $state.go('app.specialties-list');
          });
        });
    }

})();
