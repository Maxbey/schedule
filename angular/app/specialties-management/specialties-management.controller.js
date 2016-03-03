(function(){
    "use strict";

    angular.module('app.controllers').controller('SpecialtiesManagementController', function(SpecialtyService, ToastService){
        return new SpecialtiesManagementController(SpecialtyService, ToastService);
    });

    function SpecialtiesManagementController(SpecialtyService, ToastService){
        var vm = this;

        var renderList = function(){
          SpecialtyService.all().then(function(specialties){
              vm.specialties = specialties;
          });
        };

        vm.details = function(){
          alert("Clicked !");
        };

        vm.remove = function(item){
          console.log(item);
          item.remove();
          vm.specialties.splice(vm.specialties.indexOf(item), 1);
          ToastService.show("Специальность удалена");
        };

        renderList();

    }

})();
