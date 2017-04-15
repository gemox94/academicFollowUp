(function(){
	angular.module('academic')
		.controller('periodsCoordinatorCtrl', periodsCoordinatorCtrl);

	function periodsCoordinatorCtrl($scope, $http, $window, $timeout, alertService, userService){
		$scope.alertService = alertService;
		$scope.user = userService.getUser();

		/**
		 * HTTP request to get all the added periods
		 */

		$http({
			method: 'GET',
			url: '/api/coordinator/periods'
		}).then(function(value){
			if (value.data.status_code === 200) {
				$scope.periods = value.data.periods;
			}
			console.log(value);
		}, function(error){
			console.log(error);
		});

		/**
		 * Function to add a new period
		 */

		$scope.createPeriod = function(){

			if($scope.period == undefined || $scope.period == ''){
				$scope.alertService.add('warning', 'Debe introducir el periodo');
				return;
			}

			$http({
				method: 'POST',
				url: '/api/coordinator/periods',
				data: {
					coordinator_id: $scope.user.id,
					period: $scope.period
				}
			}).then(function(value){
			
				/**
				 * Check the status_code of the request
				 */
				
				if(value.data.status_code === 200){
					$scope.alertService.add('success', 'El periodo: \''+value.data.period.period+'\' ha sido agregado');
					$timeout(function(){
						$window.location.href = '/coordinator/periods';
					},1000);
				}

			}, function(error){
				console.log(error);
			});
		}
	}
})();