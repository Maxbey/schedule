(function(){
    "use strict";

    angular.module('app.controllers').controller('SpecialtiesManagementController', function(SpecialtyService){
        return new SpecialtiesManagementController(SpecialtyService);
    });

    function SpecialtiesManagementController(SpecialtyService){
        var vm = this;

        SpecialtyService.all().then(function(specialties){
            vm.specialties = specialties;
        });
    }

})();
