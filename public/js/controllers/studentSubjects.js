(function(){
	angular.module('academic')
		.controller('studentSubjectsCtrl', studentSubjectsCtrl);

	function studentSubjectsCtrl($scope, $http, $uibModal, alertService, userService){
		$scope.alertService = alertService;
		$scope.user = userService.getUser();
		$http({
			method: 'GET',
			url: '/api/student/'+$scope.user.id+'/subjects'
		}).then(function(value){
			console.log(value);

			if(value.data.status_code === 200){
				$scope.subjects = value.data.subjects;
			}

		}, function(error){
			console.log(error);
		});
	}

})();