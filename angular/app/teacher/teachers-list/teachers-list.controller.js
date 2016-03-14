(function(){
    "use strict";

    angular.module('app.controllers').controller('TeachersListController', TeachersListController);

    function TeachersListController($state, TeacherService, DialogService){
        var vm = this;

        TeacherService.all().then(function(teachers){
          if(!teachers.length){
            DialogService.action(
              'В системе не зарегистрированно ни одного преподавателя. Создать нового ?',
               'Перейти к созданию'
             ).then(function(){
               $state.go('app.teacher-create');
             });
          }
          else{
            vm.teachers = teachers;
          }
        });

        vm.edit = function(teacher){
          $state.go('app.teacher-edit', {'id': teacher.id});
        };
    }

})();
