(function(){
    "use strict";

    angular.module('app.services').factory('TroopService', function(API){
      return new TroopService(API);
    });

    function TroopService(API){
        var url = 'troops';
        var all = API.all(url);

        this.all = function(){
            return all.getList();
        };

        this.get = function(id){
            return API.one(url, id).get();
        };

        this.create = function(troop){
            return all.post(angular.toJson(troop));
        };
    }

})();
