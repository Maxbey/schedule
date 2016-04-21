(function(){
    "use strict";

    angular.module('app.controllers').controller('TroopsListController', TroopsListController);

    function TroopsListController($state, TroopService, DialogService){
        var vm = this;

        var renderList = function(){
          TroopService.all().then(function(troops){
            if(!troops.length){
              DialogService.action(
                'В системе не зарегистрированно ни одного взвода. Создать новый ?',
                 'Перейти к созданию'
               ).then(function(){
                 $state.go('management.troop-create');
               });
            }
            else{
              vm.troops = troops;
            }
          });
        };

        vm.edit = function(troop){
          $state.go('management.troop-edit', {'id': troop.id});
        };

        renderList();
    }

})();
