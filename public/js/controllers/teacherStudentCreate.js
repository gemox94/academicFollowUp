(function () {
    angular.module('academic')
        .controller('teacherStudentCreateCtrl', teacherStudentCreateCtrl);
    
    function teacherStudentCreateCtrl($scope, $http, $window, $timeout, alertService, CSRF_TOKEN) {
        $scope.alertService = alertService;

        $scope.subjects = undefined;
        $scope.student = undefined;
        $scope.showForm = false;

        $scope.searchStudent = function() {
            if($scope.matricula == undefined || $scope.matricula == ''){
                $scope.alertService.add('warning', 'Debe ingresar la matricula');
                return;
            }
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
            }, function(error){
                console.log(error);
            });
        };

        $scope.loadStudent = function(){
            if($scope.subject == undefined){
                $scope.alertService.add('warning', 'Debe escoge una materia');
                return;
            }

            $http({
                method: 'POST',
                url: '/teacher_students/register_student',
                headers:{
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                data: {
                    _token: CSRF_TOKEN,
                    student_id: $scope.student.id,
                    subject_id: $scope.subject.id
                }
            }).then(function(value){
                if(value.data.status_code == 200){
                    $scope.alertService.add('success','Se registro exitosamente el alumno');
                    $timeout(function(){
                        $window.location.href = '/teacher_students';
                    },1250);
                }

                if(value.data.status_code == 403){
                    $scope.alertService.add('warning','El alumno ya esta inscrito');
                }
            }, function (error) {
                console.log(error);
            });
        }

    }
})();