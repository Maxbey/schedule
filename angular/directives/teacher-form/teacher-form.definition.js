(function(){
    "use strict";

    angular.module('app.directives').directive('teacherForm', teacherFormDefinition);

    function teacherFormDefinition() {

        var directive = {
          restrict: 'EA',
          templateUrl: './views/directives/teacher-form/teacher-form.html',
          controller: 'TeacherFormController',
          controllerAs: 'vm',
          scope: {
            teacher: '='
          }
        };

    return directive;
    }
})();
