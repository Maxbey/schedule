(function(){
    "use strict";

    angular.module('app.controllers').controller('AudienceCreateController', AudienceCreateController);

    function AudienceCreateController($scope, $state, AudienceService){
        $scope.$on('create_audience', function(e, audience){
            AudienceService.create(audience).then(function(){
                $state.go('app.audiences-list');
            });
        });
    }

})();
