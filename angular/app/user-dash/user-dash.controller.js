(function(){
    "use strict";

    angular.module('app.controllers').controller('UserDashController', UserDashController);

    function UserDashController(TroopService){
        var vm = this;

        TroopService.all().then(function(troops){
          vm.troops = troops;
        });

        function themesQuerySearch(criteria){
          var cachedQuery = cachedQuery || criteria;

          return cachedQuery ? vm.troops.filter(createFilterForTroop(cachedQuery)) : [];
        }

        function createFilterForTroop(query) {
          var lowercaseQuery = angular.lowercase(query);
          return function filterFn(troop) {
            return (troop.code.indexOf(lowercaseQuery) === 0);
          };
        }

        vm.troopsSearch = function(criteria){
          if(!criteria)
            return vm.troops;
          return themesQuerySearch(criteria);
        };

        vm.loadOccupations = function(troop){
          if(troop)
          {
            troop.getList('occupations').then(function(occupations){
              vm.occupations = occupations;
              console.log(occupations);
            });
          }
        };

        vm.formTeachersString = function(occupation){
          var result = "";

          angular.forEach(occupation.teachers.data, function(teacher){
            result += ' ' + teacher.military_rank + ' ';
            result += teacher.name + '  ';
          });

          return result;
        };

        vm.formAudiencesString = function(occupation){
          var result = "";

          angular.forEach(occupation.audiences.data, function(audience){
            result += '  ' + audience.location + ',';
          });



          return result.substring(0, result.length - 1) + ' ';
        };
    }

})();
