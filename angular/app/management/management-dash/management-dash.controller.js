(function(){
    "use strict";

    angular.module('app.controllers').controller('ManagementDashController', ManagementDashController);

    function ManagementDashController(API, TroopService, $window, $scope, $timeout, ToastService, SelectHelpersService){
        var vm = this;

        vm.chartsReady = false;
        vm.loading = false;
        vm.troopsForExport = [];

        var loadTroops = function(){
          TroopService.all().then(function(troops){
            vm.troops = troops;
          });
        };

        var loadCharts = function(dateFrom, dateTo){
          vm.loading = true;

          API.all('schedule/teachers-stat').getList({
            from: dateFrom,
            to: dateTo
          }).then(function(stat){
            if(angular.isDefined(vm.absolute))
            {
              delete vm.absolute.data;
              delete vm.absolute.labels;
            }

            vm.absolute = {
              data: [],
              labels: []
            };

            vm.relatively = {
              data: [],
              labels: []
            };

            vm.absolute.data.push([]);
            vm.relatively.data.push([]);

            angular.forEach(stat, function(teacher){
              vm.absolute.labels.push(teacher.name);
              vm.relatively.labels.push(teacher.name);

              vm.absolute.data[0].push(teacher.absolute);
              vm.relatively.data[0].push(teacher.relatively);
            });

            $timeout(function() {
              $scope.$apply();
            });

            vm.chartsReady = true;
            vm.loading = false;
          });
        };

        vm.loadCharts = function(){
          if(angular.isDefined(vm.from) && angular.isDefined(vm.to))
            loadCharts(vm.from.toISOString().split('T')[0], vm.to.toISOString().split('T')[0]);
          else {
            {
              ToastService.show("Укажите временной диапазон");
            }
          }
        };

        function troopsQuerySearch(criteria){
          return SelectHelpersService.querySearch(vm.troops, createFilterForTroops, criteria);
        }

        function createFilterForTroops(query) {
          return SelectHelpersService.createFilter(query, 'code', vm.troopsForExport);
        }

        vm.troopsSearch = function(criteria){
          if(!criteria)
            return vm.troops.filter(SelectHelpersService.notAlreadySelectedFilter(vm.troopsForExport));

          return troopsQuerySearch(criteria);
        };

        vm.export = function(){
          if(vm.troopsForExport.length === 0)
            return;

          var troopsString = "";

          angular.forEach(vm.troopsForExport, function(troop){
            troopsString += troop.id + '|'
          });

          troopsString = troopsString.substring(0, troopsString.length - 1);

            $window.open('api/schedule/export?troops=' + troopsString);
        }

        loadTroops();
    }





})();
