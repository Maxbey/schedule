(function(){
    "use strict";

    angular.module('app.controllers').controller('HeaderController', HeaderController);

    function HeaderController($scope, $mdSidenav){
      var vm = this;
      vm.sidebar_is_opened = false;

      vm.toggle = function(){
        vm.sidebar_is_opened = !vm.sidebar_is_opened;
      }
    }

})();
