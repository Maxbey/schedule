(function(){
    "use strict";

    angular.module('app.services').factory('SelectHelpersService', function(CollectionHelpersService){
      return new SelectHelpersService(CollectionHelpersService);
    });

    function SelectHelpersService(CollectionHelpersService){

      this.createFilter = function(query, property, model){

        return function filterFn(entity) {
            var notAlreadySelected = CollectionHelpersService.exists(model, entity.id) === false;
            var match = angular.lowercase(entity[property]).indexOf(angular.lowercase(query)) === 0;

          return (match && notAlreadySelected);
        };
      };

      this.querySearch = function(array, filter, query){
        return array.filter(filter(query));
      };

      this.notAlreadySelectedFilter = function(model){
        return function filterFn(entity) {
          var notAlreadySelected = CollectionHelpersService.exists(model, entity.id) === false;

          return notAlreadySelected;
        };
      }
    }

})();
