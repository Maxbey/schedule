(function(){
    "use strict";

    angular.module('app.controllers').controller('UserDashController', UserDashController);

    function UserDashController($scope, TroopService, SelectHelpersService){
        var vm = this;
        vm.loading = true;

        TroopService.all().then(function(troops){
          vm.troops = troops;
          vm.loading = false;
        });

        function troopsQuerySearch(criteria){
          return SelectHelpersService.querySearch(vm.troops, createFilterForTroop, criteria);
        }

        function createFilterForTroop(query) {
          return SelectHelpersService.createFilter(query, 'code', []);
        }

        vm.troopsSearch = function(criteria){
          if(!criteria)
            return vm.troops;
          return troopsQuerySearch(criteria);
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


        vm.arrivalDayFilter = function(date){
          return date.getDay() == vm.troop.day + 2;
        };

        $scope.$watch('vm.date', function(date){
          if(date)
          {
            vm.loading = true;
            vm.troop.customGET('occupations', {date_of: date.toISOString().slice(0,10)}).then(function(occupations){
              vm.occupations = occupations;
              vm.loading = false;
            });
          }
        });
    }

})();
