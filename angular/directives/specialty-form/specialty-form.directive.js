(function(){
    "use strict";

    angular.module('app.controllers').controller('SpecialtyFormController', SpecialtyFormController);

    function SpecialtyFormController($scope, $state, DisciplineService, DialogService, SelectHelpersService, ToastService, SpecialtyService){
        var vm = this;

        vm.specialty = $scope.specialty;
        if(!vm.specialty){
          vm.specialty = {
            disciplines:{
              data:[]
            }
          };
        }

        vm.buttonLocked = false;

        DisciplineService.all().then(function(disciplines){
          vm.disciplines = disciplines;
        });

        vm.create = function(){
          vm.buttonLocked = true;
          SpecialtyService.create(vm.specialty).then(function(){
              ToastService.show('Специальность создана');
              $state.go('management.specialties-list');
          }, function(){
              vm.buttonLocked = false;
          });
        };

        vm.update = function(){
          vm.buttonLocked = true;
          SpecialtyService.update(vm.specialty).then(function(){
            ToastService.show('Специальность обновлена');
            $state.go('management.specialties-list');
          }, function(){
             vm.buttonLocked = false;
          });
        };

        vm.delete = function(){
          DialogService.delete('Вы действительно хотите удалить специальность ?').then(function(){
            vm.buttonLocked = true;
            vm.specialty.remove().then(function(){
              $state.go('management.specialties-list');
              ToastService.show('Специальность удалена');
            });
          });
        };

        function createFilterFor(query) {
          return SelectHelpersService.createFilter(query, 'short_name', vm.specialty.disciplines.data);
        }

        vm.querySearch = function (criteria) {
          if(!criteria)
            return vm.disciplines.filter(SelectHelpersService.notAlreadySelectedFilter(vm.specialty.disciplines.data));

          return vm.disciplines.filter(createFilterFor(criteria));
        }
    }

})();
