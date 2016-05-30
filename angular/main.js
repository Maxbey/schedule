(function(){
	"use strict";

	angular.module('app',
		[
		'app.controllers',
		'app.filters',
		'app.services',
		'app.directives',
		'app.routes',
		'app.config',
		'partialsModule'
	])
	.run([
		'$rootScope', '$state', '$stateParams', 'AuthService',
		function($rootScope, $state, $stateParams, AuthService){
			$rootScope.$state = $state;
			$rootScope.$stateParams = $stateParams;

			var deregistrationCallback = $rootScope.$on('$stateChangeStart',
      function(event, toState){
				if(!toState.data || !toState.data.noLogin)
				{
					if(!AuthService.getToken())
					{
						event.preventDefault();
						$state.go('auth.login');
					}

					AuthService.getAuthorizedUser().then(function(user){
						$rootScope.user = user;

					}, function(){
						event.preventDefault();
						$state.go('auth.login');
					});
				}
      }
    );

		$rootScope.$on('$destroy', deregistrationCallback);

		}
	]);

	angular.module('app.routes', []);
	angular.module('app.controllers', [
		'ui.router', 'ngMaterial', 'ngStorage',
		'restangular', 'angular-loading-bar',
		'ngMessages', 'materialCalendar',
		'angular-locker', 'validation.match',
		'chart.js'
	]);
	angular.module('app.filters', []);
	angular.module('app.services', []);
	angular.module('app.directives', []);
	angular.module('app.config', []);

})();
