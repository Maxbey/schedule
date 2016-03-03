(function(){
	"use strict";

	angular.module('app.routes').config(function($stateProvider, $urlRouterProvider){

		var getView = function(viewName){
			return './views/app/' + viewName + '/' + viewName + '.html';
		};

		$urlRouterProvider.otherwise('/');

		$stateProvider
			.state('app', {
				abstract: true,
				views: {
					header: {
						templateUrl: getView('header')
					},
					footer: {
						templateUrl: getView('footer')
					},
					main: {}
				}
			})
			.state('app.landing', {
				url: '/',
				data: {},
				views: {
					'main@': {
						templateUrl: getView('landing')
					}
				}
			})

			.state('app.specialties-list', {
				url: '/specialties',
				views: {
					'main@': {
						templateUrl: getView('specialties-list')
					}
				}
			})
			.state('app.specialty-details', {
				url: '/specialties/{id}/show',
				views: {
					'main@': {
						templateUrl: getView('specialty-details')
					}
				}
			})
			.state('app.specialty-create', {
				url: '/specialties/create',
				views: {
					'main@': {
						templateUrl: getView('specialty-create')
					}
				}
			})
			.state('app.specialty-edit', {
				url: '/specialties/{id}/edit',
				views: {
					'main@': {
						templateUrl: getView('specialty-edit')
					}
				}
			})
			.state('app.troops-list', {
				url: '/troops',
				views: {
					'main@': {
						templateUrl: getView('troops-list')
					}
				}
			})
			.state('app.troop-create', {
				url: '/troops/create',
				views: {
					'main@': {
						templateUrl: getView('troop-create')
					}
				}
			})
			.state('app.troop-edit', {
				url: '/troops/{id}/edit',
				views: {
					'main@': {
						templateUrl: getView('troop-edit')
					}
				}
			})
			;

	});
})();
