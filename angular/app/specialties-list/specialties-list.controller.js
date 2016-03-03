(function(){
    "use strict";

    angular.module('app.controllers').controller('SpecialtiesListController', function(SpecialtyService, ToastService){
        return new SpecialtiesListController(SpecialtyService, ToastService);
    });

    function SpecialtiesListController(SpecialtyService, ToastService){
        var vm = this;

        var renderList = function(){
          SpecialtyService.all().then(function(specialties){
              vm.specialties = specialties;
          });
        };

        vm.create = function(){
          DialogService.fromTemplate('SpecialtyForm');
        };

        vm.details = function(){
          alert("Show details");
        };

        vm.remove = function(item){
          item.remove();
          vm.specialties.splice(vm.specialties.indexOf(item), 1);
          ToastService.show("Специальность удалена");
        };

        renderList();

    }

})();
