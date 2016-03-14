(function(){
    "use strict";

    angular.module('app.controllers').controller('TeacherEditController', TeacherEditController);

    function TeacherEditController($stateParams, TeacherService){
        var vm = this;

        TeacherService.get($stateParams.id).then(function(teacher){
          vm.teacher = teacher;
        });
    }

})();
