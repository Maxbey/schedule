(function(){
    "use strict";

    angular.module('app.controllers').controller('AudienceEditController', AudienceEditController);

    function AudienceEditController($stateParams, $state, $scope, AudienceService){
        var vm = this;

        AudienceService.get($stateParams.id).then(function(audience){
          vm.audience = audience;
        });
    }

})();
