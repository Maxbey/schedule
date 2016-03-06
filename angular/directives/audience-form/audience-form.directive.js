(function(){
    "use strict";

    angular.module('app.controllers').controller('AudienceFormController', AudienceFormController);

    function AudienceFormController($scope){
        var vm = this;

        vm.audience = $scope.audience;

        vm.create = function(){
          $scope.$emit('create_audience', vm.audience);
        };

        vm.update = function(){
          $scope.$emit('update_audience', vm.audience);
        };

        vm.delete = function(){
          $scope.$emit('delete_audience', vm.audience);
        };
    }

})();
