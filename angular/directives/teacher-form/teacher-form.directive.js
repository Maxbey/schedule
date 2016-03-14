(function(){
    "use strict";

    angular.module('app.controllers').controller('TeacherFormController', TeacherFormController);

    function TeacherFormController($state, $scope, TeacherService, ToastService, DialogService){
      var vm = this;

      vm.teacher = $scope.teacher;

      vm.ranks = [
        'Майор',
        'Подполковник',
        'Полковник'
      ];

      vm.buttonLocked = false;

      vm.create = function(){
        vm.buttonLocked = true;
        TeacherService.create(vm.teacher).then(function(){
          ToastService.show('Преподаватель создан');
          $state.go('app.teachers-list');
        }, function(){
          vm.buttonLocked = false;
        });
      };

      vm.update = function(){
        vm.buttonLocked = true;
        vm.teacher.save().then(function(){
          ToastService.show('Преподаватель обновлен');
          $state.go('app.teachers-list');
        }), function(){
          vm.buttonLocked = false;
        };
      };

      vm.delete = function(){
        DialogService.delete('Вы действительно хотите удалить преподавателя ?').then(function(){
          vm.buttonLocked = true;
          vm.teacher.remove().then(function(){
            ToastService.show('Преподаватель удален');
            $state.go('app.teachers-list');
          });
        });
      };
    }

})();
