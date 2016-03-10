(function(){
	"use strict";

	angular.module('app.routes').config(function($stateProvider, $urlRouterProvider){

		var getView = function(path){
			var viewName = path.substring(path.lastIndexOf('.') + 1, path.length);

			return './views/app/' + path.replace('.', '/') + '/' + viewName + '.html';
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
						templateUrl: getView('specialty.specialties-list')
					}
				}
			})
			.state('app.specialty-details', {
				url: '/specialties/{id}/show',
				views: {
					'main@': {
						templateUrl: getView('specialty.specialty-details')
					}
				}
			})
			.state('app.specialty-create', {
				url: '/specialties/create',
				views: {
					'main@': {
						templateUrl: getView('specialty.specialty-create')
					}
				}
			})
			.state('app.specialty-edit', {
				url: '/specialties/{id}/edit',
				views: {
					'main@': {
						templateUrl: getView('specialty.specialty-edit')
					}
				}
			})
			.state('app.troops-list', {
				url: '/troops',
				views: {
					'main@': {
						templateUrl: getView('troop.troops-list')
					}
				}
			})
			.state('app.troop-create', {
				url: '/troops/create',
				views: {
					'main@': {
						templateUrl: getView('troop.troop-create')
					}
				}
			})
			.state('app.troop-edit', {
				url: '/troops/{id}/edit',
				views: {
					'main@': {
						templateUrl: getView('troop.troop-edit')
					}
				}
			})
			.state('app.disciplines-list', {
				url: '/disciplines',
				views: {
					'main@': {
						templateUrl: getView('discipline.disciplines-list')
					}
				}
			})
			.state('app.discipline-create', {
				url: '/disciplines/create',
				views: {
					'main@': {
						templateUrl: getView('discipline.discipline-create')
					}
				}
			})
			.state('app.discipline-edit', {
				url: '/disciplines/{id}/edit',
				views: {
					'main@': {
						templateUrl: getView('discipline.discipline-edit')
					}
				}
			})
			.state('app.discipline-details', {
				url: '/disciplines/{id}/show',
				views: {
					'main@': {
						templateUrl: getView('discipline.discipline-details')
					}
				}
			})
			.state('app.audiences-list', {
				url: '/audiences',
				views: {
					'main@': {
						templateUrl: getView('audience.audiences-list')
					}
				}
			})
			.state('app.audience-create', {
				url: '/audiences/create',
				views: {
					'main@': {
						templateUrl: getView('audience.audience-create')
					}
				}
			})
			.state('app.audience-edit', {
				url: '/audiences/{id}/edit',
				views: {
					'main@': {
						templateUrl: getView('audience.audience-edit')
					}
				}
			})
			.state('app.teachers-list', {
				url: '/teachers',
				views: {
					'main@': {
						templateUrl: getView('teacher.teachers-list')
					}
				}
			})
			.state('app.teacher-create', {
				url: '/teachers/create',
				views: {
					'main@': {
						templateUrl: getView('teacher.teacher-create')
					}
				}
			})
			.state('app.teacher-edit', {
				url: '/teachers/{id}/edit',
				views: {
					'main@': {
						templateUrl: getView('teacher.teacher-edit')
					}
				}
			})
			.state('app.themes-list', {
				url: '/disciplines/{id}/themes',
				views: {
					'main@': {
						templateUrl: getView('theme.themes-list')
					}
				}
			})
			.state('app.theme-create', {
				url: '/disciplines/{id}/themes/create',
				views: {
					'main@': {
						templateUrl: getView('theme.theme-create')
					}
				}
			})
			.state('app.theme-edit', {
				url: '/disciplines/{id}/themes/{themeId}/edit',
				views: {
					'main@': {
						templateUrl: getView('theme.theme-edit')
					}
				}
			})
			.state('app.theme-details', {
				url: '/disciplines/{id}/themes/{themeId}/show',
				views: {
					'main@': {
						templateUrl: getView('theme.theme-details')
					}
				}
			});

	});
})();
