(function(){
    angular.module('academic')
        .controller('teacherStudentDownCtrl',teacherStudentDownCtrl);

    function teacherStudentDownCtrl($scope, $http, $timeout, $window, alertService, CSRF_TOKEN) {
        $scope.alertService = alertService;

        $scope.searchStudent = function(){
            if($scope.matricula == undefined || $scope.matricula == ''){
                $scope.alertService.add('warning', 'Debe ingresar la matricula');
                return;
            }
            $scope.showForm = false;
            $http({
                method: 'POST',
                url: '/student/subjects',
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                data: {
                    _token: CSRF_TOKEN,
                    key: $scope.matricula
                }
            }).then(function(value){

                if(value.data.status_code == 200){
                    $scope.showForm = true;
                    $scope.student = value.data.student;
                    $scope.subjects = value.data.student.teacher_subjects;
                }

                if(value.data.status_code == 404){
                    $scope.alertService.add('danger', 'Alumno no encontrado');
                }
            }, function(error){
                console.log(error);
            });
        };

        $scope.downStudent = function(){
            console.log($scope.student.id);
            console.log($scope.subject.id);

            if($scope.subject == undefined){
                $scope.alertService.add('warning', 'Debe elegir una materia');
                return;
            }

            $http({
                method: 'POST',
                url: '/teacher_students/down',
                headers:{
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                data: {
                    _token: CSRF_TOKEN,
                    student_id: $scope.student.id,
                    subject_id: $scope.subject.id
                }
            }).then(function(value){
                console.log(value);
                if(value.data.status_code == 200){
                    $scope.alertService.add('success', 'Se ha dado de baja al alumno');
                    $timeout(function(){
                        $window.location.href = '/subjects/'+$scope.subject.id;
                    },1250);
                }
            });
        };

    }
})();