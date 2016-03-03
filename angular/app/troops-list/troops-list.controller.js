(function(){
    "use strict";

    angular.module('app.controllers').controller('TroopsListController', TroopsListController);

    function TroopsListController($state, TroopService){
        var vm = this;

        var renderList = function(){
          TroopService.all().then(function(troops){
            vm.troops = troops;
          });
        };

        vm.edit = function(troop){
          $state.go('app.troop-edit', {'id': troop.id});
        };

        renderList();
    }

})();
