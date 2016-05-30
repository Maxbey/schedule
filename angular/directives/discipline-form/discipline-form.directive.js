(function(){
    "use strict";

    angular.module('app.controllers').controller('DisciplineFormController', DisciplineFormController);

    function DisciplineFormController($scope, $state, SpecialtyService, DisciplineService, SelectHelpersService, ToastService, DialogService){
        var vm = this;

        vm.discipline = $scope.discipline;
        if(!vm.discipline){
          vm.discipline = {
            specialties:{
              data:[]
            }
          };
        }

        vm.buttonLocked = false;

        SpecialtyService.all().then(function(specialties){
          vm.specialties = specialties;
        });

        vm.create = function(){
          vm.buttonLocked = true;
          DisciplineService.create(vm.discipline).then(function(){
            ToastService.show('Дисциплина создана');
            $state.go('management.disciplines-list');
          }, function(){
            vm.buttonLocked = false;
          });
        };

        vm.update = function(){
          vm.buttonLocked = true;
          DisciplineService.update(vm.discipline).then(function(){
            ToastService.show('Дисциплина обновлена');
            $state.go('management.disciplines-list');
          }, function(){
            vm.buttonLocked = false;
          });
        };

        vm.delete = function(){
          DialogService.delete('Вы действительно хотите удалить дисциплину ?').then(function(){
            vm.buttonLocked = true;
            vm.discipline.remove().then(function(){
              ToastService.show('Дисциплина удалена');
              $state.go('management.disciplines-list');
            });
          });
        };


        function createFilterFor(query) {
          return SelectHelpersService.createFilter(query, 'code', vm.discipline.specialties.data);
        }

        vm.querySearch = function (criteria) {
          if(!criteria)
            return vm.specialties.filter(SelectHelpersService.notAlreadySelectedFilter(vm.discipline.specialties.data));

          return vm.specialties.filter(createFilterFor(criteria));
        }
    }

})();
