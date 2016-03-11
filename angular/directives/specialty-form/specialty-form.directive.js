(function(){
    "use strict";

    angular.module('app.controllers').controller('SpecialtyFormController', SpecialtyFormController);

    function SpecialtyFormController($scope, DisciplineService, CollectionHelpersService){
        var vm = this;

        vm.specialty = $scope.specialty;
        if(!vm.specialty){
          vm.specialty = {
            disciplines:{
              data:[]
            }
          };
        }

        DisciplineService.all().then(function(disciplines){
          vm.disciplines = disciplines;
        });

        vm.addToSelected = function(discipline){
          var notAlreadySelected = CollectionHelpersService.exists(vm.specialty.disciplines.data, discipline.id) === false;
          if(notAlreadySelected)
            vm.specialty.disciplines.data.push(discipline);
        };

        vm.create = function(){
          $scope.$emit('create_specialty', vm.specialty);
        };

        vm.update = function(){
          $scope.$emit('update_specialty', vm.specialty);
        };

        vm.delete = function(){
          $scope.$emit('delete_specialty', vm.specialty);
        };

        function createFilterFor(query) {
          return function filterFn(discipline) {
            var matchTheShortName = discipline.short_name.indexOf(query) != -1;
            var notAlreadySelected = CollectionHelpersService.exists(vm.specialty.disciplines.data, discipline.id) === false;
            return (matchTheShortName && notAlreadySelected);
          };
        }

        vm.querySearch = function (criteria) {
          var cachedQuery = cachedQuery || criteria;
          return cachedQuery ? vm.disciplines.filter(createFilterFor(cachedQuery)) : [];
        }
    }

})();
