(function(){
    "use strict";

    angular.module('app.directives').directive('disciplineForm', disciplineFormDefinition);

    function disciplineFormDefinition() {

        var directive = {
          restrict: 'EA',
          templateUrl: './views/directives/discipline-form/discipline-form.html',
          controller: 'DisciplineFormController',
          controllerAs: 'vm',
          scope: {
            discipline: '='
          }
        };

    return directive;
    }
})();
