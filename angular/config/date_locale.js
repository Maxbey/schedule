(function(){
    "use strict";

    angular.module('app.config').config(function($mdDateLocaleProvider){
        $mdDateLocaleProvider.months = [
          'Январь', 'Февраль', 'Март',
          'Апрель', 'Май', 'Июнь',
          'Июль', 'Август', 'Сентябрь',
          'Октябрь', 'Ноябрь', 'Декабрь'
        ];

        $mdDateLocaleProvider.shortMonths = $mdDateLocaleProvider.months;
    });

})();
