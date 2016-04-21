(function(){
    "use strict";

    angular.module('app.controllers').controller('TroopFormController', TroopFormController);

    function TroopFormController($scope, $state, SpecialtyService, TroopService, DialogService, ToastService){
        var vm = this;

        vm.troop = $scope.troop;

        vm.daysOfWeek = [
          {name: 'Понедельник', value: 1},
          {name: 'Вторник', value: 2},
          {name: 'Среда', value: 3},
          {name: 'Четверг', value: 4},
          {name: 'Пятница', value: 5}
        ];

        vm.buttonLocked = false;

        SpecialtyService.all().then(function(specialties){
          if(!specialties.length){
            DialogService.action(
              'В системе не зарегистрированно ни одной специальности. Создание взвода невозможно!',
               'Добавить специальность'
             ).then(function(){
               $state.go('management.specialty-create');
             }, function(){
               $state.go('management.troops-list');
             });
          }
          else {
            vm.specialties = specialties;
          }
        });

        vm.create = function(){
          vm.buttonLocked = true;
          TroopService.create(vm.troop).then(function(){
              ToastService.show('Взвод создан');
              $state.go('management.troops-list');
          }, function(){
              vm.buttonLocked = false;
          });
        };

        vm.update = function(){
          vm.buttonLocked = true;
          vm.troop.save().then(function(){
            ToastService.show('Взвод обновлен');
            $state.go('management.troops-list');
          }, function(){
            vm.buttonLocked = false;
          });
        };

        vm.delete = function(){
          DialogService.delete('Вы действительно хотите удалить взвод ?').then(function(){
            vm.buttonLocked = true;
            vm.troop.remove().then(function(){
              ToastService.show('Взвод удален');
              $state.go('management.troops-list');
            });
          });

        };

    }

})();
