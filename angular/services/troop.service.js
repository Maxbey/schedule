(function(){
    "use strict";

    angular.module('app.services').factory('TroopService', function(API){
      return new TroopService(API);
    });

    function TroopService(API){
        var all = API.all('troops');

        this.all = function(){
            return all.getList();
        };

        this.get = function(id){
            return API.one('troops', id).get();
        };

        this.create = function(troop){
            return all.post(angular.toJson(troop));
        };
    }

})();
