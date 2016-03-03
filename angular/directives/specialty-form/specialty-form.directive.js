(function(){
    "use strict";

    angular.module('app.controllers').controller('SpecialtyFormController', SpecialtyFormController);

    function SpecialtyFormController($scope){
        var vm = this;

        vm.specialty = $scope.specialty;

        vm.create = function(){
          $scope.$emit('create_specialty', vm.specialty);
        };

        vm.update = function(){
          $scope.$emit('update_specialty', vm.specialty);
        };

        vm.delete = function(){
          $scope.$emit('delete_specialty', vm.specialty);
        };
    }

})();
