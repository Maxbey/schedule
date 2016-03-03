(function(){
    "use strict";

    angular.module('app.controllers').controller('SpecialtyFormController', SpecialtyFormController);

    function SpecialtyFormController($scope){
        var vm = this;

        vm.specialty = {};

        vm.create = function(){
          $scope.$emit('create_specialty', vm.specialty);
        };
    }

})();
