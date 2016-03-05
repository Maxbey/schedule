(function(){
    "use strict";

    angular.module('app.controllers').controller('SpecialtyDetailsController', SpecialtyDetailsController);

    function SpecialtyDetailsController($stateParams, SpecialtyService){
        var vm = this;

        SpecialtyService.get($stateParams.id).then(function(specialty){
          vm.specialty = specialty;
        });
    }

})();
