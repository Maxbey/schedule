(function(){
    "use strict";

    angular.module('app.controllers').controller('TeacherEditController', TeacherEditController);

    function TeacherEditController($stateParams, $state, $scope, TeacherService){
        var vm = this;

        TeacherService.get($stateParams.id).then(function(teacher){
          vm.teacher = teacher;
        });

        $scope.$on('update_teacher', function(e, teacher){
          teacher.save().then(function(){
            $state.go('app.teachers-list');
          });
        });

        $scope.$on('delete_teacher', function(e, teacher){
          teacher.remove().then(function(){
            $state.go('app.teachers-list');
          });
        });
    }

})();
