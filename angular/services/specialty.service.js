(function(){
    "use strict";

    angular.module('app.services').factory('SpecialtyService', function(API){
        return new SpecialtyService(API);
    });

    function SpecialtyService(API){
      var url = 'specialties';
      var all = API.all(url);

        this.all = function(){
            return all.getList();
        };

        this.create = function(specialty){
            return all.post(angular.toJson(specialty));
        };

        this.get = function(id){
            return API.one(url, id).get();
        };
    }

})();
