(function(){
    "use strict";

    angular.module('app.controllers').controller('UsersListController', UsersListController);

    function UsersListController(UserService, $rootScope, ToastService, DialogService){
        var vm = this;

        var renderList = function(){
          UserService.all().then(function(users){
            vm.users = users;
          });
        };

        vm.remove = function(user){
          if(user.id !== $rootScope.user.id)
          {
            DialogService.delete('Вы действительно хотите удалить пользователя ' + user.name + '?').then(function(){
              user.remove().then(function(){
                ToastService.show('Пользователь удален');
                vm.users.splice(vm.users.indexOf(user), 1);
              });
            });
          }
          else
            ToastService.show('Вы не можете удалить свой профиль');
        };

        renderList();
    }

})();
