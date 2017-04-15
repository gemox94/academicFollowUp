(function(){
	angular.module('academic')
		.controller('studentInfoCtrl', studentInfoCtrl);

	function studentInfoCtrl($scope, $http, userService){
		$scope.user = userService.getUser();

		console.log($scope.user);

	}
})();