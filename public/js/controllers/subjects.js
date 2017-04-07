app.controller('SubjectCtrl', function($rootScope, $scope, $http, $uibModal, $timeout, alertService, spinnerService, userService, $filter){
    $scope.loged_user      = userService.getUser();
    $scope.alertService    = alertService;
    $scope.subject_names   = [];
    $scope.selectedSubject = {};
    $scope.subject         = {
        id: window.subject_id
    };


    if ($scope.subject.id) {
        /*
         * Load existing subject
         */
        $http.get('/api/subjects/'+$scope.subject.id)
           .then(function(response){
console.log(response);
               $scope.subject = response.data;

           }, function(error_response){
               console.log('error', error_response);
           });
    }


    /*
     * Get subject_names
     */
    $http.get('/api/subjects/names')
       .then(function(response){
           $scope.subject_names = response.data;

       }, function(error_response){
           console.log('error', error_response);
       });


    /*
     * Method for saving subjects
     */
    $scope.saveSubject = function(){
        if ($scope.subject.id) {
            /*
             * UPDATE Subject
             */
            $http({
                method: 'POST',
                url: '/api/subjects/update',
                data:{
                    subject: $scope.subject
                }

            }).then(function(response){
                    alertService.add("success", 'La materia "'+$scope.subject.name+'" se actualizó con exito');
                    console.log(response);

                    window.location.href = '/subjects';

                }, function(error_response){
                    alertService.add("danger", 'Error al actualizar materia "'+$scope.subject.name+'". Porfavor intentelo más tarde');
                    console.log(error_response);

            }).finally(function() {

            });

        }else{
            /*
             * Set selected subject name
             * Set teacher id
             */
            $scope.subject.name       = $scope.selectedSubject.data.name;
            $scope.subject.teacher_id = $scope.loged_user.id;

            /*
             * CREATE Subject
             */
            $http({
                method: 'POST',
                url: '/api/subjects/create',
                data:{
                    subject: $scope.subject
                }

            }).then(function(response){
                    alertService.add("success", 'La materia "'+$scope.subject.name+'" se creó con exito');
                    console.log(response);

                    window.location.href = '/subjects';

                }, function(error_response){
                    alertService.add("danger", 'Error al crear materia "'+$scope.subject.name+'". Porfavor intentelo más tarde');
                    console.log(error_response);

            }).finally(function() {

            });
        }
    };


    /*
     * Save evaluations
     */
    $scope.saveEvaluations = function(){
        /*
         * Save subject
         */
        $http({
            method: 'POST',
            url: '/api/subjects/'+$scope.subject.id+'/saveEvaluations',
            data:{
                subject: $scope.subject
            }

        }).then(function(response){
                alertService.add("success", 'Se guardo evaluaciones para "'+$scope.subject.name+'" se creó con exito');
                console.log(response);

                //window.location.href = '/subjects';

            }, function(error_response){
                alertService.add("danger", 'Error al guardar evaluaciones para "'+$scope.subject.name+'". Porfavor intentelo más tarde');
                console.log(error_response);

        }).finally(function() {

        });
    };

    $scope.editEvaluations = function (student) {
console.log(student);
        var modalInstance = $uibModal.open({
          animation: true,
          templateUrl: 'evaluations_modal.html',
          controller: 'EvaluationsModalCtrl',
          resolve: {
            studentEdit: function(){
              return student;
            }
          }
        });

        modalInstance.result.then(function (result) {
            /*
             * Save evaluations for this student
             */
            $http({
                method: 'POST',
                url: '/api/student/'+result.student.id+'/updateStudentEvaluations',
                data:{
                    student: result.student
                }
            }).then(function(response){
console.log(response);
                    alertService.add("success", 'Las calificaciones del estudiante"'+result.student.name+'" se guardaron con exito');

                }, function(error_response){
                    alertService.add("danger", 'Error al guardar calificaciones del estudiante"'+result.student.name+'". Porfavor intentelo más tarde');
                    console.log(error_response);
            });
        });
    };


});

app.controller('EvaluationsModalCtrl', function($scope, $http, $uibModalInstance, studentEdit) {
  $scope.student = studentEdit;

  $scope.student.evaluationsOfSubject.forEach(function(evaluation){
    evaluation.pivot.grade = parseFloat(evaluation.pivot.grade);
  });
console.log($scope.student);
  $scope.ok = function () {
        $uibModalInstance.close({
            student: $scope.student
        });
    };

  $scope.cancel = function () {
    $uibModalInstance.dismiss('cancel');
  };
});



app.controller('SubjectsListCtrl', function($rootScope, $scope, $http, $uibModal, $timeout, alertService, spinnerService, userService){
    $scope.loged_user   = userService.getUser();
    $scope.alertService = alertService;
    $scope.subjects     = [];

    /*
     * Ask for subjects info
     */
    $http.get('/api/subjects/'+$scope.loged_user.id+'/teacher')
       .then(function(response){
           console.log(response);
           $scope.subjects = response.data;

       }, function(error_response){
           console.log('error', error_response);
       });


    $scope.deleteSubject = function(subject, index){
        /*
         * Create new orchard
         */
        $http({
            method: 'POST',
            url: '/api/subjects/'+subject.id+'/delete'

        }).then(function(response){
                alertService.add("warning", 'La materia "'+subject.name+'" se eliminó.');
                console.log(response);
                $scope.subjects.splice(index, 1);

            }, function(error_response){
                alertService.add("danger", 'Error al eliminar materia"'+subject.name+'". Por favor intentelo más tarde');
                console.log(error_response);
        });
    };
});
