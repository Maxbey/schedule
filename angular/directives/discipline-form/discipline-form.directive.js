(function(){
    "use strict";

    angular.module('app.controllers').controller('DisciplineFormController', DisciplineFormController);

    function DisciplineFormController($scope, SpecialtyService, CollectionHelpersService){
        var vm = this;

        vm.discipline = $scope.discipline;
        if(!vm.discipline){
          vm.discipline = {
            specialties:{
              data:[]
            }
          };
        }

        SpecialtyService.all().then(function(specialties){
          vm.specialties = specialties;
        });

        vm.create = function(){
          $scope.$emit('create_discipline', vm.discipline);
        };

        vm.update = function(){
          $scope.$emit('update_discipline', vm.discipline);
        };

        vm.delete = function(){
          $scope.$emit('delete_discipline', vm.discipline);
        };

        function createFilterFor(query) {
          return function filterFn(specialty) {
            var matchTheCode = specialty.code.indexOf(query) != -1;
            var notAlreadySelected = CollectionHelpersService.exists(vm.discipline.specialties.data, specialty.id) === false;
            return (matchTheCode && notAlreadySelected);
          };
        }

        vm.querySearch = function (criteria) {
          var cachedQuery = cachedQuery || criteria;
          return cachedQuery ? vm.specialties.filter(createFilterFor(cachedQuery)) : [];
        }
    }

})();
