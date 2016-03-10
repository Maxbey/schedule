(function(){
    "use strict";

    angular.module('app.directives').directive('themeFrom', themeFromDefinition);

    function themeFromDefinition() {

        var directive = {
          restrict: 'EA',
          templateUrl: './views/directives/theme-from/theme-from.html',
          controller: 'ThemeFromController',
          controllerAs: 'vm',
          scope: {
            theme: '='
          }
        };

    return directive;
    }
})();
