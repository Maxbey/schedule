(function(){
    "use strict";

    angular.module('app.controllers').controller('ManagementDashController', ManagementDashController);

    function ManagementDashController(API, $scope, $timeout){
        var vm = this;
        vm.chartsReady = false;

        var loadCharts = function(dateFrom, dateTo){
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
              console.log("here");
            });

            vm.chartsReady = true;
          });
        };

        $scope.$watchGroup(['vm.from', 'vm.to'], function(dates){
          if(angular.isDefined(dates[0]) && angular.isDefined(dates[1]))
            loadCharts(vm.from.toISOString().split('T')[0], vm.to.toISOString().split('T')[0]);
        });



    }

})();
