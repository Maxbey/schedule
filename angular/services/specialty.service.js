(function(){
    "use strict";

    angular.module('app.services').factory('SpecialtyService', function(API){
        return new SpecialtyService(API);
    });

    function SpecialtyService(API){
        var resource = API.all('specialties');

        this.all = function(){
            return resource.getList();
        };

        this.create = function(specialty){
            return resource.post(angular.toJson(specialty));
        };
    }

})();
