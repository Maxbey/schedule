(function(){
    "use strict";

    angular.module('app.config').config(function($locationProvider){
        $locationProvider.html5Mode(true);
    });

})();
