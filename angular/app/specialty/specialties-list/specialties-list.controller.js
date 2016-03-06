(function(){
    "use strict";

    angular.module('app.controllers').controller('SpecialtiesListController', function($state, SpecialtyService){
        return new SpecialtiesListController($state, SpecialtyService);
    });

    function SpecialtiesListController($state, SpecialtyService){
        var vm = this;

        var renderList = function(){
          SpecialtyService.all().then(function(specialties){
              vm.specialties = specialties;
          });
        };

        vm.details = function(specialty){
          $state.go('app.specialty-details', {'id': specialty.id});
        };

        vm.edit = function(specialty){
          $state.go('app.specialty-edit', {'id': specialty.id});
        };

        renderList();

    }

})();
