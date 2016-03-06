(function(){
    "use strict";

    angular.module('app.services').factory('AudienceService', function(API){
      return new AudienceService(API);
    });

    function AudienceService(API){
      var url = 'audiences';
      var all = API.all(url);

      this.all = function(){
          return all.getList();
      };

      this.get = function(id){
          return API.one(url, id).get();
      };

      this.create = function(audience){
          return all.post(angular.toJson(audience));
      };
    }

})();
