(function(){
    "use strict";

    angular.module('app.services').factory('SpecialtyService', function(API, CollectionHelpersService){
        return new SpecialtyService(API, CollectionHelpersService);
    });

    function SpecialtyService(API, CollectionHelpersService){
      var url = 'specialties';
      var all = API.all(url);

        this.all = function(){
            return all.getList();
        };

        this.create = function(specialty){
          specialty.disciplines = CollectionHelpersService.getIdsFromCollection(specialty.disciplines.data);
            return all.post(angular.toJson(specialty));
        };

        this.update = function(specialty){
          specialty.disciplines = CollectionHelpersService.getIdsFromCollection(specialty.disciplines.data);
          return specialty.save();
        };

        this.get = function(id){
            return API.one(url, id).get();
        };
    }

})();
