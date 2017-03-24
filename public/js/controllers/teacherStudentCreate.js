(function () {
    angular.module('academic')
        .controller('teacherStudentCreateCtrl', teacherStudentCreateCtrl);
    
    function teacherStudentCreateCtrl($scope, $http, alertService, CSRF_TOKEN) {
        $scope.alertService = alertService;

        $scope.subjects = undefined;
        $scope.student = undefined;
        $scope.showForm = false;

        $scope.searchStudent = function() {
            $http({
                method: 'POST',
                url: '/teacher_students/find',
                headers:{
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                data: {
                    _token: CSRF_TOKEN,
                    matricula: $scope.matricula
                }
            }).then(function(value){
                if(value.data.status_code == 200){
                    $scope.showForm = true;
                    $scope.subjects = value.data.subjects;
                    $scope.student = value.data.student;
                }else if( value.data.status_code == 404){
                    $scope.alertService.add('warning', value.data.message)
                }
                console.log(value);
            }, function(error){
                console.log(error);
            });
        };

        $scope.loadStudent = function(){
            
        }

    }
})();