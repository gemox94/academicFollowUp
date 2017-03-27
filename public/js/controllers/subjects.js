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


    $scope.saveEvaluations = function(){

    };

    $scope.newOrchard = function () {
        var modalInstance = $uibModal.open({
          animation: true,
          templateUrl: 'orchard_modal.html',
          controller: 'OrchardModalCtrl',
          resolve: {
          }
        });

        modalInstance.result.then(function (result) {
            /*
             * Create new orchard
             */
            $http({
                method: 'POST',
                url: '/api/orchards',
                data:{
                    name: result.orchard.name,
                    type: result.orchard.type,
                    producer_id: $scope.lot.producer.id
                }
            }).then(function(response){
                    alertService.add("success", 'La huerta "'+result.orchard.name+'" se creó con exito');
                    console.log(response);
                    $scope.orchards.push(response.data);

                }, function(error_response){
                    alertService.add("danger", 'Error al crear huerta"'+result.orchard.name+'". Porfavor intentelo más tarde');
                    console.log(error_response);
            });
        });
    };


});

app.controller('OrchardModalCtrl', function($scope, $http, $uibModalInstance) {
  $scope.orchard = {};

  $scope.ok = function () {
        $uibModalInstance.close({
            orchard: $scope.orchard
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
