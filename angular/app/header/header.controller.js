(function(){
    "use strict";

    angular.module('app.controllers').controller('HeaderController', HeaderController);

    function HeaderController($state){
      var vm = this;

      vm.menuItems = [
        {text: 'Учебные специальности', state: 'app.specialties-list'},
        {text: 'Учебные взводы', state: 'app.troops-list'},
        {text: 'Дисциплины', state: 'app.disciplines-list'},
        {text: 'Преподаватели', state: 'app.teachers-list'},
        {text: 'Аудитории', state: 'app.audiences-list'}
      ];

      vm.go = function(item){
        $state.go(item.state);
      };


      vm.sidebar_is_opened = false;

      vm.toggle = function(){
        vm.sidebar_is_opened = !vm.sidebar_is_opened;
      }


    }

})();
