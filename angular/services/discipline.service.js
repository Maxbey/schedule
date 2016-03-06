(function(){
    "use strict";

    angular.module('app.services').factory('DisciplineService', function(API, CollectionHelpersService){
      return new DisciplineService(API, CollectionHelpersService);
    });

    function DisciplineService(API, CollectionHelpersService){
      var url = 'disciplines';
      var all = API.all(url);

      this.all = function(){
          return all.getList();
      };

      this.get = function(id){
          return API.one(url, id).get();
      };

      this.create = function(discipline){
        discipline.specialties = CollectionHelpersService.getIdsFromCollection(discipline.specialties.data);

          return all.post(angular.toJson(discipline));
      };

      this.update = function(discipline){
        discipline.specialties = CollectionHelpersService.getIdsFromCollection(discipline.specialties.data);

        return discipline.save();
      };


    }

})();
