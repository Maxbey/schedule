(function(){
    "use strict";

    angular.module('app.controllers').controller('TroopEditController', TroopEditController);

    function TroopEditController($stateParams, $state, $scope, TroopService){
        var vm = this;

        TroopService.get($stateParams.id).then(function(troop){
          vm.troop = troop;
        });
    }

})();
