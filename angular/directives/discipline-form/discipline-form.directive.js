(function(){
    "use strict";

    angular.module('app.controllers').controller('DisciplineFormController', DisciplineFormController);

    function DisciplineFormController($scope, $state, SpecialtyService, DisciplineService, CollectionHelpersService, ToastService, DialogService){
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
            $state.go('app.disciplines-list');
          }, function(){
            vm.buttonLocked = false;
          });
        };

        vm.update = function(){
          vm.buttonLocked = true;
          DisciplineService.update(vm.discipline).then(function(){
            ToastService.show('Дисциплина обновлена');
            $state.go('app.disciplines-list');
          }, function(){
            vm.buttonLocked = false;
          });
        };

        vm.delete = function(){
          DialogService.delete('Вы действительно хотите удалить дисциплину ?').then(function(){
            vm.buttonLocked = true;
            vm.discipline.remove().then(function(){
              ToastService.show('Дисциплина удалена');
              $state.go('app.disciplines-list');
            });
          });
        };

        function notAlreadySelectedFilter(){
          return function filterFn(specialty) {
            var notAlreadySelected = CollectionHelpersService.exists(vm.discipline.specialties.data, specialty.id) === false;
            return notAlreadySelected;
          };
        }

        function createFilterFor(query) {
          return function filterFn(specialty) {
            var matchTheCode = specialty.code.indexOf(query) != -1;
            var notAlreadySelected = CollectionHelpersService.exists(vm.discipline.specialties.data, specialty.id) === false;
            return (matchTheCode && notAlreadySelected);
          };
        }

        vm.querySearch = function (criteria) {
          if(!criteria)
            return vm.specialties.filter(notAlreadySelectedFilter());
          var cachedQuery = cachedQuery || criteria;
          return cachedQuery ? vm.specialties.filter(createFilterFor(cachedQuery)) : [];
        }
    }

})();
