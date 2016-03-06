(function(){
    "use strict";

    angular.module('app.directives').directive('audienceForm', audienceFormDefinition);

    function audienceFormDefinition() {

        var directive = {
          restrict: 'EA',
          templateUrl: './views/directives/audience-form/audience-form.html',
          controller: 'AudienceFormController',
          controllerAs: 'vm',
          scope: {
            audience: '='
          }
        };

    return directive;
    }
})();
