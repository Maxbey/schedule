(function(){
    "use strict";

    angular.module('app.config').config(function(lockerProvider){
      lockerProvider.defaults({
        driver: 'session',
        namespace: 'app',
        separator: '.',
        eventsEnabled: true,
        extend: {}
  });
    });

})();
