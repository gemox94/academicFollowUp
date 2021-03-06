(function(){
	angular.module('academic')
		.controller('studentSubjectsCtrl', studentSubjectsCtrl)
		.controller('ShowGradesModalCtrl', ShowGradesModalCtrl)
        .filter('capitalize', function () {
            return function(input) {
                return (!!input) ? input.charAt(0).toUpperCase() + input.substr(1).toLowerCase() : '';
            }
        });


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

		$scope.showGrades = function(subject){

            var modalInstance = $uibModal.open({
                animation: true,
                templateUrl: 'ShowGradesModal.html',
                controller: 'ShowGradesModalCtrl',
                resolve: {
                    subject: function(){
                        return subject;
                    },
                    student_id: function () {
                        return $scope.user.id;
                    }
                }
            });
		}
	}

	function ShowGradesModalCtrl($scope, $http, $uibModalInstance, subject, student_id){
        $http({
            method: 'GET',
            url: '/api/student/'+student_id+'/grades/'+subject.id
        }).then(function(value){
            console.log(value);
            $scope.grades = value.data.evaluations;
        }, function(error){
            console.log(error);
        });

        $scope.close = function(){
			$uibModalInstance.close();
		};
	}

})();