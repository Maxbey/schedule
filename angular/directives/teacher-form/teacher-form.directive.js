(function(){
    "use strict";

    angular.module('app.controllers').controller('TeacherFormController', TeacherFormController);

    function TeacherFormController($scope){
      var vm = this;

      vm.teacher = $scope.teacher;

      vm.ranks = [
        'Майор',
        'Подполковник',
        'Полковник'
      ];

      vm.create = function(){
        $scope.$emit('create_teacher', vm.teacher);
      };

      vm.update = function(){
        $scope.$emit('update_teacher', vm.teacher);
      };

      vm.delete = function(){
        $scope.$emit('delete_teacher', vm.teacher);
      };
    }

})();
