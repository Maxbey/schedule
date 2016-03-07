(function(){
    "use strict";

    angular.module('app.controllers').controller('TeacherCreateController', TeacherCreateController);

    function TeacherCreateController($scope, $state, TeacherService){
      $scope.$on('create_teacher', function(e, teacher){
          TeacherService.create(teacher).then(function(){
              $state.go('app.teachers-list');
          });
      });
    }

})();
