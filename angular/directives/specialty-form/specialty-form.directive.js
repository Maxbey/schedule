(function(){
    "use strict";

    angular.module('app.controllers').controller('SpecialtyFormController', SpecialtyFormController);

    function SpecialtyFormController($scope, $state, DisciplineService, DialogService, CollectionHelpersService, ToastService, SpecialtyService){
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
              $state.go('app.specialties-list');
          }, function(){
              vm.buttonLocked = false;
          });
        };

        vm.update = function(){
          vm.buttonLocked = true;
          SpecialtyService.update(vm.specialty).then(function(){
            ToastService.show('Специальность обновлена');
            $state.go('app.specialties-list');
          }, function(){
             vm.buttonLocked = false;
          });
        };

        vm.delete = function(){
          DialogService.delete('Вы действительно хотите удалить специальность ?').then(function(){
            vm.buttonLocked = true;
            vm.specialty.remove().then(function(){
              $state.go('app.specialties-list');
              ToastService.show('Специальность удалена');
            });
          });
        };

        function notAlreadySelectedFilter(){
          return function filterFn(discipline) {
            var notAlreadySelected = CollectionHelpersService.exists(vm.specialty.disciplines.data, discipline.id) === false;
            return notAlreadySelected;
          };
        }

        function createFilterFor(query) {
          return function filterFn(discipline) {
            var matchTheShortName = discipline.short_name.indexOf(query) != -1;
            var notAlreadySelected = CollectionHelpersService.exists(vm.specialty.disciplines.data, discipline.id) === false;
            return (matchTheShortName && notAlreadySelected);
          };
        }

        vm.querySearch = function (criteria) {
          if(!criteria)
            return vm.disciplines.filter(notAlreadySelectedFilter());
          var cachedQuery = cachedQuery || criteria;
          return cachedQuery ? vm.disciplines.filter(createFilterFor(cachedQuery)) : [];
        }
    }

})();
