(function(){
    "use strict";

    angular.module('app.services').factory('ThemeService', function(API, CollectionHelpersService){
      return new ThemeService(API, CollectionHelpersService);
    });

    function ThemeService(API, CollectionHelpersService){
      var url = 'themes';
      var all = API.all(url);


      function prepareAudiences(theme){
        return CollectionHelpersService.getIdsFromCollection(theme.audiences.data);
      }

      function prepareTeachers(theme){
        return CollectionHelpersService.getIdsFromCollection(theme.teachers.data);
      }

      this.create = function(theme){
        theme.audiences = prepareAudiences(theme);
        theme.teachers = prepareTeachers(theme);

        return all.post(angular.toJson(theme));
      };

      this.update = function(theme){
        theme.audiences = prepareAudiences(theme);
        theme.teachers = prepareTeachers(theme);

        return theme.save();
      };

      this.get = function(id){
          return API.one(url, id).get();
      };
    }

})();
