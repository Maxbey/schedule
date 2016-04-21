(function(){
    "use strict";

    angular.module('app.services').factory('UserService', function(API){
      return new UserService(API);
    });

    function UserService(API){
      var url = 'users';
      var all = API.all(url);

      this.all = function(){
          return all.getList();
      };

      this.get = function(id){
          return API.one(url, id).get();
      };

      this.create = function(user){
          return all.post(angular.toJson(user));
      };
    }

})();
