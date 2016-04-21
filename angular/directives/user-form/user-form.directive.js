(function(){
    "use strict";

    angular.module('app.controllers').controller('UserFormController', UserFormController);

    function UserFormController(UserService, ToastService, $state){
        var vm = this;

        vm.user = {};
        vm.buttonLocked = false;

        vm.create = function(){
          vm.buttonLocked = true;
          UserService.create(vm.user).then(function(){
              ToastService.show('Пользователь создан');
              $state.go('management.users-list');

          }, function(){
              vm.buttonLocked = false;
          });
        };
    }

})();
