(function(){
    "use strict";

    angular.module('app.controllers').controller('AudiencesListController', AudiencesListController);

    function AudiencesListController($state, AudienceService, DialogService){
        var vm = this;

        AudienceService.all().then(function(audiences){
          if(!audiences.length){
            DialogService.action(
              'В системе не зарегистрированно ни одной аудитории. Создать новую ?',
               'Перейти к созданию'
             ).then(function(){
               $state.go('management.audience-create');
             });
          }
          else{
            vm.audiences = audiences;
          }
        });

        vm.edit = function(audience){
          $state.go('management.audience-edit', {'id': audience.id});
        };
    }

})();
