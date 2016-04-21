(function(){
	"use strict";

	angular.module('app.routes').config(function($stateProvider, $urlRouterProvider){

		var getView = function(path){
			var viewName = path.substring(path.lastIndexOf('.') + 1, path.length);

			return './views/app/' + path.replace(/\./g, '/') + '/' + viewName + '.html';
		};

		$urlRouterProvider.otherwise('/');

		$stateProvider
			.state('management', {
				abstract: true,
				url: '/management',
				views: {
					header: {
						templateUrl: getView('header')
					},
					main: {}
				}
			})
			.state('management.dashboard', {
				url: '/',
				data: {},
				views: {
					'main@': {
						templateUrl: getView('management.management-dash')
					}
				}
			})

			.state('management.specialties-list', {
				url: '/specialties',
				views: {
					'main@': {
						templateUrl: getView('management.specialty.specialties-list')
					}
				}
			})
			.state('management.specialty-details', {
				url: '/specialties/{id}/show',
				views: {
					'main@': {
						templateUrl: getView('management.specialty.specialty-details')
					}
				}
			})
			.state('management.specialty-create', {
				url: '/specialties/create',
				views: {
					'main@': {
						templateUrl: getView('management.specialty.specialty-create')
					}
				}
			})
			.state('management.specialty-edit', {
				url: '/specialties/{id}/edit',
				views: {
					'main@': {
						templateUrl: getView('management.specialty.specialty-edit')
					}
				}
			})
			.state('management.troops-list', {
				url: '/troops',
				views: {
					'main@': {
						templateUrl: getView('management.troop.troops-list')
					}
				}
			})
			.state('management.troop-create', {
				url: '/troops/create',
				views: {
					'main@': {
						templateUrl: getView('management.troop.troop-create')
					}
				}
			})
			.state('management.troop-edit', {
				url: '/troops/{id}/edit',
				views: {
					'main@': {
						templateUrl: getView('management.troop.troop-edit')
					}
				}
			})
			.state('management.disciplines-list', {
				url: '/disciplines',
				views: {
					'main@': {
						templateUrl: getView('management.discipline.disciplines-list')
					}
				}
			})
			.state('management.discipline-create', {
				url: '/disciplines/create',
				views: {
					'main@': {
						templateUrl: getView('management.discipline.discipline-create')
					}
				}
			})
			.state('management.discipline-edit', {
				url: '/disciplines/{id}/edit',
				views: {
					'main@': {
						templateUrl: getView('management.discipline.discipline-edit')
					}
				}
			})
			.state('management.discipline-details', {
				url: '/disciplines/{id}/show',
				views: {
					'main@': {
						templateUrl: getView('management.discipline.discipline-details')
					}
				}
			})
			.state('management.audiences-list', {
				url: '/audiences',
				views: {
					'main@': {
						templateUrl: getView('management.audience.audiences-list')
					}
				}
			})
			.state('management.audience-create', {
				url: '/audiences/create',
				views: {
					'main@': {
						templateUrl: getView('management.audience.audience-create')
					}
				}
			})
			.state('management.audience-edit', {
				url: '/audiences/{id}/edit',
				views: {
					'main@': {
						templateUrl: getView('management.audience.audience-edit')
					}
				}
			})
			.state('management.teachers-list', {
				url: '/teachers',
				views: {
					'main@': {
						templateUrl: getView('management.teacher.teachers-list')
					}
				}
			})
			.state('management.teacher-create', {
				url: '/teachers/create',
				views: {
					'main@': {
						templateUrl: getView('management.teacher.teacher-create')
					}
				}
			})
			.state('management.teacher-edit', {
				url: '/teachers/{id}/edit',
				views: {
					'main@': {
						templateUrl: getView('management.teacher.teacher-edit')
					}
				}
			})
			.state('management.themes-list', {
				url: '/disciplines/{id}/themes',
				views: {
					'main@': {
						templateUrl: getView('management.theme.themes-list')
					}
				}
			})
			.state('management.theme-create', {
				url: '/disciplines/{id}/themes/create',
				views: {
					'main@': {
						templateUrl: getView('management.theme.theme-create')
					}
				}
			})
			.state('management.theme-edit', {
				url: '/disciplines/{id}/themes/{themeId}/edit',
				views: {
					'main@': {
						templateUrl: getView('management.theme.theme-edit')
					}
				}
			})
			.state('management.theme-details', {
				url: '/disciplines/{id}/themes/{themeId}/show',
				views: {
					'main@': {
						templateUrl: getView('management.theme.theme-details')
					}
				}
			})
			.state('management.users-list', {
				url: '/users',
				views: {
					'main@': {
						templateUrl: getView('management.user.users-list')
					}
				}
			})
			.state('management.user-create', {
				url: '/users/create',
				views: {
					'main@': {
						templateUrl: getView('management.user.user-create')
					}
				}
			});

			$stateProvider
			.state('user', {
				abstract: true,
				main: {}
			})
				.state('user.user-dash', {
					url: '/',
					views: {
						'main@': {
							templateUrl: getView('user-dash')
						}
					},
					data: {
						noLogin: true
					}
				});

			$stateProvider
				.state('auth', {
					abstract: true,
					main: {}
				})
			.state('auth.login', {
				url: '/login',
				data: {
					noLogin: true
				},
				views: {
					'main@': {
						templateUrl: getView('login')
					}
				}
			});

	});
})();
