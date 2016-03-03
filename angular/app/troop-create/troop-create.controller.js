(function(){
    "use strict";

    angular.module('app.controllers').controller('TroopCreateController', TroopCreateController);

    function TroopCreateController($scope, $state, TroopService){
      $scope.$on('create_troop', function(e, troop){
          TroopService.create(troop).then(function(){
              $state.go('app.troops-list');
          });
      });
    }

})();
