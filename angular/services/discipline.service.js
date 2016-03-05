(function(){
    "use strict";

    angular.module('app.services').factory('DisciplineService', function(API){
      return new DisciplineService(API);
    });

    function DisciplineService(API){
      var url = 'disciplines';
      var all = API.all(url);

      this.all = function(){
          return all.getList();
      };

      this.create = function(discipline){
          return all.post(angular.toJson(discipline));
      };

      this.get = function(id){
          return API.one(url, id).get();
      };
    }

})();
