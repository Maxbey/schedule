(function(){
    "use strict";

    angular.module('app.controllers').controller('SetPrevThemesController', SetPrevThemesController);


    function SetPrevThemesController(DialogService, DisciplineService, $scope, CollectionHelpersService){
        var vm = this;

        vm.loading = true;
        vm.prevThemes = $scope.prevThemes;

        DisciplineService.all().then(function(disciplines){
          vm.disciplines = disciplines;
          vm.loading = false;
        });

        function disciplinesQuerySearch(criteria){
          var cachedQuery = cachedQuery || criteria;

          return cachedQuery ? vm.disciplines.filter(createFilterForDisciplines(cachedQuery)) : [];
        }

        function themesQuerySearch(criteria){
          var cachedQuery = cachedQuery || criteria;

          return cachedQuery ? vm.avaliableThemes.filter(createFilterForThemes(cachedQuery)) : [];
        }

        function createFilterForDisciplines(query) {
          var lowercaseQuery = angular.lowercase(query);
          return function filterFn(discipline) {
            return (discipline.full_name.indexOf(lowercaseQuery) === 0);
          };
        }

        function createFilterForThemes(query){

          return function filterFn(theme){
            var matchTheName = theme.name.indexOf(query) != -1;
            var notAlreadySelected = CollectionHelpersService.exists(vm.prevThemes, theme.id) === false;

            return (matchTheName && notAlreadySelected);
          };
        }

        function notAlreadySelectedFilter(){
          return function filterFn(theme) {
            var notAlreadySelected = CollectionHelpersService.exists(vm.prevThemes, theme.id) === false;

            return notAlreadySelected;
          };
        }

        vm.disciplinesSearch = function(criteria){
          if(!criteria)
            return vm.disciplines;
          return disciplinesQuerySearch(criteria);
        };

        vm.themesSearch = function(criteria){
          if(!criteria)
            return vm.avaliableThemes.filter(notAlreadySelectedFilter());
          return themesQuerySearch(criteria);
        };

        vm.loadDisciplineThemes = function(discipline){
          if(!discipline)
            return;
            vm.loading = true;
          DisciplineService.get(discipline.id).then(function(discipline){
            vm.avaliableThemes = discipline.themes.data;
            vm.loading = false;
          });
        };

        vm.hide = function(){
            DialogService.hide();
        };

    }

})();
