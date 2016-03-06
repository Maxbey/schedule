(function(){
    "use strict";

    angular.module('app.controllers').controller('AudienceEditController', AudienceEditController);

    function AudienceEditController($stateParams, $state, $scope, AudienceService){
        var vm = this;

        AudienceService.get($stateParams.id).then(function(audience){
          vm.audience = audience;
        });

        $scope.$on('update_audience', function(e, audience){
          delete audience.themes;
          audience.save().then(function(){
            $state.go('app.audiences-list');
          });
        });

        $scope.$on('delete_audience', function(e, audience){
          audience.remove().then(function(){
            $state.go('app.audiences-list');
          });
        });
    }

})();
