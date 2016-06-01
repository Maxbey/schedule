(function(){
    "use strict";

    angular.module('app.controllers').controller('GenerationController', GenerationController);


    function GenerationController(DialogService){

        this.hide = function(){
            DialogService.hide();
        };

    }

})();
