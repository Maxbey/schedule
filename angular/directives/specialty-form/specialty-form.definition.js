(function(){
    "use strict";

    angular.module('app.directives').directive('specialtyForm', specialtyFormDefinition);

    function specialtyFormDefinition() {

        var directive = {
          restrict: 'EA',
          templateUrl: './views/directives/specialty-form/specialty-form.html',
          controller: 'SpecialtyFormController',
          controllerAs: 'vm',
          scope: {
            specialty: "="
          }
        };

    return directive;
    }
})();
