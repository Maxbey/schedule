(function(){
    "use strict";

    angular.module('app.controllers').controller('HeaderController', HeaderController);

    function HeaderController($state){
      var vm = this;

      vm.scheduleMenuItems = [
        {text: 'Учебные специальности', state: 'management.specialties-list'},
        {text: 'Учебные взводы', state: 'management.troops-list'},
        {text: 'Дисциплины', state: 'management.disciplines-list'},
        {text: 'Преподаватели', state: 'management.teachers-list'},
        {text: 'Аудитории', state: 'management.audiences-list'}
      ];

      vm.settingsMenuItems = [
        {text: 'Пользователи', state: 'management.users-list'}
      ];

      vm.dashboardsMenuItems = [
        {text: 'Панель администратора', state: 'management.dashboard'},
        {text: 'Панель пользователя', state: 'user.user-dash'}
      ];

      vm.go = function(item){
        $state.go(item.state);
      };


      vm.sidebarIsOpened = false;

      vm.toggle = function(){
        vm.sidebarIsOpened = !vm.sidebarIsOpened;
      }


    }

})();
