(function(){
    "use strict";

    angular.module('app.services').factory('SpecialtyService', function(API){
        return new SpecialtyService(API);
    });

    function SpecialtyService(API){
        this.all = function(){
            return API.all('specialties').getList();
        };
    }

})();
