(function(){
    "use strict";

    angular.module('app.controllers').controller('TroopEditController', TroopEditController);

    function TroopEditController($stateParams, $state, $scope, TroopService){
        var vm = this;

        TroopService.get($stateParams.id).then(function(troop){
          vm.troop = troop;
        });

        $scope.$on('update_troop', function(e, troop){
          troop.save().then(function(){
            $state.go('app.troops-list');
          });
        });

        $scope.$on('delete_troop', function(e, troop){
          troop.remove().then(function(){
            $state.go('app.troops-list');
          });
        });
    }

})();
