(function(){
    "use strict";

    angular.module('app.controllers').controller('TroopFormController', TroopFormController);

    function TroopFormController($scope, SpecialtyService){
        var vm = this;

        vm.troop = $scope.troop;

        SpecialtyService.all().then(function(specialties){
            vm.specialties = specialties;
        });

        vm.create = function(){
          $scope.$emit('create_troop', vm.troop);
        };

        vm.update = function(){
          $scope.$emit('update_troop', vm.troop);
        };

        vm.delete = function(){
          $scope.$emit('delete_troop', vm.troop);
        };

    }

})();
