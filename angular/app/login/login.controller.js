(function(){
    "use strict";

    angular.module('app.controllers').controller('LoginController', LoginController);

    function LoginController(AuthService, locker, $state, ToastService){
        var vm = this;

        vm.login = function(email, password){
          AuthService.login(email, password).then(function(r){
            locker.put('jwt', r.token);
            $state.go('management.dashboard');
          }, function(){
            ToastService.show('Неправильный e-mail или пароль!');
          });
        };
    }

})();
