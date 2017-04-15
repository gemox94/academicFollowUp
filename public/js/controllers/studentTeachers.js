(function(){

	angular.module('academic')
		.controller('studentTeachersCtrl', studentTeachersCtrl);

	function studentTeachersCtrl($scope, $http, alertService){
		$scope.alertService = alertService;


		/**
		 * HTTP (GET) request to get all the teachers
		 */
		$http({
			method: 'GET', 
			url: '/api/student/teachers'
		}).then(function(value){
			
			/**
			 * Assigning teachers from backend to angular $scope
			 * First check if status_code === 200
			 */
			if(value.data.status_code === 200){
				$scope.teachers = value.data.teachers;
			}

			console.log(value);
		}, function(error){
			console.log(error)
		});

	}

})();