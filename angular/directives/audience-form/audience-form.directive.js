(function(){
    "use strict";

    angular.module('app.controllers').controller('AudienceFormController', AudienceFormController);

    function AudienceFormController($scope, $state, AudienceService, ToastService, DialogService){
        var vm = this;

        vm.audience = $scope.audience;

        vm.buttonLocked = false;

        vm.create = function(){
          vm.buttonLocked = true;
          AudienceService.create(vm.audience).then(function(){
            ToastService.show('Аудитория создана');
            $state.go('app.audiences-list');
          }, function(){
            vm.buttonLocked = false;
          });
        };

        vm.update = function(){
          vm.buttonLocked = true;
          delete vm.audience.themes;
          vm.audience.save().then(function(){
            ToastService.show('Аудитория обновлена');
            $state.go('app.audiences-list');
          }, function(){
            vm.buttonLocked = false;
          });
        };

        vm.delete = function(){
          DialogService.delete('Вы действительно хотите удалить аудиторию ?').then(function(){
            vm.buttonLocked = true;
            vm.audience.remove().then(function(){
              ToastService.show('Аудитория удалена');
              $state.go('app.audiences-list');
            });
          });
        };
    }

})();
