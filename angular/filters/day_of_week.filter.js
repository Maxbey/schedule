(function(){
    "use strict";

    angular.module('app.filters').filter('DayOfWeek', DayOfWeek);

    function DayOfWeek(){
      var daysOfWeek = ['Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница'];
        return function( input ){

            return daysOfWeek[input];
        }
    }

})();
