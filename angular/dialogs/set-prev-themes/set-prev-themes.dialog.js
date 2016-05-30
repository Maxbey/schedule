(function(){
    "use strict";

    angular.module('app.controllers').controller('SetPrevThemesController', SetPrevThemesController);


    function SetPrevThemesController(DialogService, DisciplineService, $scope, SelectHelpersService){
        var vm = this;

        vm.loading = true;
        vm.prevThemes = $scope.prevThemes;

        DisciplineService.all().then(function(disciplines){
          vm.disciplines = disciplines;
          vm.loading = false;
        });

        function disciplinesQuerySearch(criteria){
          return SelectHelpersService.querySearch(vm.disciplines, createFilterForDisciplines, criteria);
        }

        function themesQuerySearch(criteria){
          var cachedQuery = cachedQuery || criteria;

          return cachedQuery ? vm.avaliableThemes.filter(createFilterForThemes(cachedQuery)) : [];
        }

        function createFilterForDisciplines(query) {
          return SelectHelpersService.createFilter(query, 'full_name', []);
        }

        function createFilterForThemes(query){
          return SelectHelpersService.createFilter(query, 'name', vm.prevThemes);
        }

        vm.disciplinesSearch = function(criteria){
          if(!criteria)
            return vm.disciplines;
          return disciplinesQuerySearch(criteria);
        };

        vm.themesSearch = function(criteria){
          if(!criteria)
            return vm.avaliableThemes.filter(SelectHelpersService.notAlreadySelectedFilter(vm.prevThemes));
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
