(function(){
    "use strict";

    angular.module('app.controllers').controller('SpecialtiesListController', SpecialtiesListController);

    function SpecialtiesListController($state, SpecialtyService, DialogService){
        var vm = this;

        SpecialtyService.all().then(function(specialties){
          if(!specialties.length){
            DialogService.action(
              'В системе не зарегистрированно ни одной специальности. Создать новую ?',
               'Перейти к созданию'
             ).then(function(){
               $state.go('app.specialty-create');
             });
          }
          else {
            vm.specialties = specialties;
          }
        });

        vm.details = function(specialty){
          $state.go('app.specialty-details', {'id': specialty.id});
        };

        vm.edit = function(specialty){
          $state.go('app.specialty-edit', {'id': specialty.id});
        };

    }

})();
