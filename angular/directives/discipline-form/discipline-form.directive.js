(function(){
    "use strict";

    angular.module('app.controllers').controller('DisciplineFormController', DisciplineFormController);

    function DisciplineFormController($scope){
        var vm = this;

        vm.discipline = $scope.discipline;

        vm.create = function(){
          $scope.$emit('create_discipline', vm.discipline);
        };

        vm.update = function(){
          $scope.$emit('update_discipline', vm.discipline);
        };

        vm.delete = function(){
          $scope.$emit('delete_discipline', vm.discipline);
        };
    }

})();
