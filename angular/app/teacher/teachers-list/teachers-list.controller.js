(function(){
    "use strict";

    angular.module('app.controllers').controller('TeachersListController', TeachersListController);

    function TeachersListController($state, TeacherService){
        var vm = this;

        var renderList = function(){
          TeacherService.all().then(function(teachers){
            vm.teachers = teachers;
          });
        };

        vm.edit = function(teacher){
          $state.go('app.teacher-edit', {'id': teacher.id});
        };

        renderList();
    }

})();
