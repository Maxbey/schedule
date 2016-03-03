(function(){
    "use strict";

    angular.module('app.directives').directive('troopForm', troopFormDefinition);

    function troopFormDefinition() {

        var directive = {
          restrict: 'EA',
          templateUrl: './views/directives/troop-form/troop-form.html',
          controller: 'TroopFormController',
          controllerAs: 'vm',
          scope: {
            troop: "="
          }
        };

    return directive;
    }
})();
