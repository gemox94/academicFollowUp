(function(){
	angular.module('academic')
		.controller('periodsCoordinatorCtrl', periodsCoordinatorCtrl);

	function periodsCoordinatorCtrl($scope, $http, alertService, userService){
		$scope.alertService = alertService;
		$scope.user = userService.getUser();

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
				console.log(value);
				if(value.data.status_code === 200){
					$scope.alertService.add('success', 'El periodo: \''+value.data.period.period+'\' ha sido agregado');
				}

			}, function(error){
				console.log(error);
			});
		}
	}
})();