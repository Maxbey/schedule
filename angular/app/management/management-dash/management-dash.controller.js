(function(){
    "use strict";

    angular.module('app.controllers').controller('ManagementDashController', ManagementDashController);

    function ManagementDashController(API, $scope, $timeout, ToastService){
        var vm = this;
        vm.chartsReady = false;
        vm.loading = false;

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



    }

})();
