(function(){
    "use strict";

    angular.module('app.config').config(function($mdDateLocaleProvider){
        $mdDateLocaleProvider.months = [
          'Январь', 'Февраль', 'Март',
          'Апрель', 'Май', 'Июнь',
          'Июль', 'Август', 'Сентябрь',
          'Октябрь', 'Ноябрь', 'Декабрь'
        ];

        $mdDateLocaleProvider.shortDays = ['ПН', 'ВТ', 'СР', 'ЧТ', 'ПТ', 'СБ', 'ВС'];

        $mdDateLocaleProvider.shortMonths = $mdDateLocaleProvider.months;
    });

})();
