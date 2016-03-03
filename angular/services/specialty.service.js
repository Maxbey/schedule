(function(){
    "use strict";

    angular.module('app.services').factory('SpecialtyService', function(API){
        return new SpecialtyService(API);
    });

    function SpecialtyService(API){
        var all = API.all('specialties');
        var relationsQuery = '?include=troops,disciplines';

        this.all = function(){
            return all.getList();
        };

        this.create = function(specialty){
            return all.post(angular.toJson(specialty));
        };

        this.getWithRelations = function(id){
            return API.one('specialties/' + id + relationsQuery).get();
        };

        this.get = function(id){
            return API.one('specialties', id).get();
        };
    }

})();
