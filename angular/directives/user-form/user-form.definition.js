(function(){
    "use strict";

    angular.module('app.directives').directive('userForm', userFormDefinition);

    function userFormDefinition() {

        var directive = {
          restrict: 'EA',
          templateUrl: './views/directives/user-form/user-form.html',
          controller: 'UserFormController',
          controllerAs: 'vm',
          scope: {},
          bindToController: true
        };

    return directive;
    }
})();
