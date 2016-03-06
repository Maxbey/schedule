(function(){
    "use strict";

    angular.module('app.controllers').controller('AudiencesListController', AudiencesListController);

    function AudiencesListController($state, AudienceService){
        var vm = this;

        var renderList = function(){
          AudienceService.all().then(function(audiences){
              vm.audiences = audiences;
          });
        };

        vm.details = function(audience){
          $state.go('app.audience-details', {'id': audience.id});
        };

        vm.edit = function(audience){
          $state.go('app.audience-edit', {'id': audience.id});
        };

        renderList();
    }

})();
