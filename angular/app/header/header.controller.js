(function(){
    "use strict";

    angular.module('app.controllers').controller('HeaderController', HeaderController);

    function HeaderController(){
      var vm = this;
      vm.sidebar_is_opened = false;

      vm.toggle = function(){
        vm.sidebar_is_opened = !vm.sidebar_is_opened;
      }
    }

})();
