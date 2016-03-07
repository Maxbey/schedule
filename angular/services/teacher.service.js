(function(){
    "use strict";

    angular.module('app.services').factory('TeacherService', function(API){
      return new TeacherService(API);
    });

    function TeacherService(API){
      var url = 'teachers';
      var all = API.all(url);

      this.all = function(){
          return all.getList();
      };

      this.get = function(id){
          return API.one(url, id).get();
      };

      this.create = function(teacher){
          return all.post(angular.toJson(teacher));
      };
    }

})();
