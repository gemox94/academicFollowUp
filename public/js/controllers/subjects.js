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
                    alertService.add("success", 'Las calificaciones del estudiante"'+result.student.name+'" se guardaron con exito', false);
                    student.pivot.final_grade = response.data;

                }, function(error_response){
                    alertService.add("danger", 'Error al guardar calificaciones del estudiante"'+result.student.name+'". Porfavor intentelo más tarde', false);
                    console.log(error_response);
            });
        });
    };


    /*
     * Function for creating advertisement
     * modal
     */
    $scope.advertisementModal = function (advertisement) {

        if (advertisement) {
            advertisement.isNew = false;

        }else{
            advertisement = {
                isNew: true
            };
        }

        var modalInstance = $uibModal.open({
            animation: true,
            templateUrl: 'advertisement_modal.html',
            controller: 'AdvertisementModalCtrl',
            resolve: {
                advertisement: function(){
                    return advertisement;
                }
            }
        });

        modalInstance.result.then(function (result) {

            if (result.advertisement.isNew) {
                /*
                 * Create new advertisement for this subject
                 */
                $http({
                    method: 'POST',
                    url: '/api/subjects/'+$scope.subject.id+'/createAdvertisement',
                    data:{
                        advertisement: result.advertisement
                    }
                }).then(function(response){
                        alertService.add("success", 'Se ha creado el anuncio con éxito', false);
                        $scope.subject.advertisements.push(response.data);

                    }, function(error_response){
                        alertService.add("danger", 'Error al crear anuncio. Porfavor intentelo más tarde', false);
                        console.log(error_response);
                });

            }else{
                /*
                 * Edit an advertisement
                 */
                $http({
                    method: 'POST',
                    url: '/api/subjects/'+$scope.subject.id+'/editAdvertisement',
                    data:{
                        advertisement: result.advertisement
                    }

                }).then(function(response){
                        alertService.add("success", 'Se ha actualizado el anuncio con éxito', false);
                        console.log(response);

                    }, function(error_response){
                        alertService.add("danger", 'Error al editar anuncio. Porfavor intentelo más tarde', false);
                        console.log(error_response);
                });
            }

        });
    };


    $scope.deleteAdvertisement = function(advertisement, index){
            /*
             * DELETE
             */
            $http({
                method: 'DELETE',
                url: '/api/subjects/'+$scope.subject.id+'/deleteAdvertisement/'+advertisement.id,

            }).then(function(response){
                    alertService.add("warning", 'Se ha eliminado el anuncio', false);
                    console.log(response);
                    $scope.subject.advertisements.splice(index, 1);

                }, function(error_response){
                    alertService.add("danger", 'Error al eliminar anuncio. Porfavor intentelo más tarde', false);
                    console.log(error_response);
            });
    };



    /*
     * Function for creating advertisement
     * modal
     */
//    $scope.deleteAdvertisementModal = function (advertisement) {
//console.log(advertisement);
//        var modalInstance = $uibModal.open({
//            animation: true,
//            templateUrl: 'advertisementDelete_modal.html',
//            resolve: {
//                advertisement: function(){
//                    return advertisement;
//                }
//            },
//            controller: function(){
//console.log(advertisement);
//                $scope.advertisement = advertisement;
//
//                $scope.ok = function () {
//                    $uibModalInstance.close({
//                        advertisement: $scope.advertisement
//                    });
//                };
//
//                $scope.cancel = function () {
//                    $uibModalInstance.dismiss('cancel');
//                };
//            }
//        });
//
//        modalInstance.result.then(function (result) {
//console.log(result);
//
//
//        });
//    };

});




app.controller('EvaluationsModalCtrl', function($scope, $uibModalInstance, studentEdit) {
    $scope.student = studentEdit;

    $scope.student.evaluationsOfSubject.forEach(function(evaluation){
        evaluation.pivot.grade = parseFloat(evaluation.pivot.grade);
    });

    $scope.ok = function () {
        $uibModalInstance.close({
            student: $scope.student
        });
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };
});



app.controller('AdvertisementModalCtrl', function($scope, $uibModalInstance, advertisement) {
  $scope.advertisement = advertisement;

    $scope.ok = function () {
        $uibModalInstance.close({
            advertisement: $scope.advertisement
        });
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };
});




app.controller('SubjectsListCtrl', function($scope, $http, alertService, userService){
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
