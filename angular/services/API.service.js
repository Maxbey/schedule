(function() {
	"use strict";

	angular.module('app.services').factory('API', function(Restangular, ToastService, $localStorage, locker) {

		//content negotiation
		var headers = {
			'Content-Type': 'application/json',
			'Accept': 'application/x.laravel.v1+json'
		};

		return Restangular.withConfig(function(RestangularConfigurer) {
			RestangularConfigurer
				.setBaseUrl('/api/')
				.setDefaultHeaders(headers)
				.addResponseInterceptor(function(data) {
					var extractedData = data.data;

					return extractedData;
				})
				.setErrorInterceptor(function(response) {
					if (response.status === 422
					) {
						for (var error in response.data.errors) {
							return ToastService.error(response.data.errors[error][0]);
						}
					}
				})
				.addFullRequestInterceptor(function(element, operation, what, url, headers) {
					var token = locker.get('jwt');

					if (token) {
						headers.Authorization = 'Bearer ' + token;
					}
				});
		});
	});

})();
