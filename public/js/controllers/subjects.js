app.controller('SubjectCtrl', function($rootScope, $scope, $http, $uibModal, $timeout, alertService, spinnerService, userService, $filter){
    $scope.loged_user   = userService.getUser();
    $scope.alertService = alertService;
    $scope.subject      = {
        id: window.subject_id
    };

    $scope.saveSubject = function(){


        if ($scope.lot.id) {
            /*
             * UPDATE
             */

        }else{
            /*
             * CREATE Subject
             */
            $http({
                method: 'POST',
                url: '/api/subject',
                data:{
                    subject: $scope.subject
                }

            }).then(function(response){
                    alertService.add("success", 'La materia "'+$scope.subject.name+'" se creo con exito');
                    console.log(response);

                    window.location.href = '/subjects';

                }, function(error_response){
                    alertService.add("danger", 'Error al crear materia "'+$scope.subject.name+'". Porfavor intentelo más tarde');
                    console.log(error_response);

            }).finally(function() {

            });
        }
    }


    $scope.newCollector = function () {
        var modalInstance = $uibModal.open({
          animation: true,
          templateUrl: 'collector_modal.html',
          controller: 'CollectorModalCtrl',
          resolve: {
          }
        });

        modalInstance.result.then(function (result) {
            /*
             * Create new collector
             */
            $http({
                method: 'POST',
                url: '/api/collectors',
                data:{
                    name: result.collector.name,
                    phone: result.collector.phone
                }
            }).then(function(response){
                    alertService.add("success", 'El acopiador "'+result.collector.name+'" se creo con exito');
                    console.log(response);
                    $scope.collectors.push(response.data);

                }, function(error_response){
                    alertService.add("danger", 'Error al crear acopiador "'+result.collector.name+'". Porfavor intentelo más tarde');
                    console.log(error_response);
            });
        });
    };




    $scope.newProducer = function () {
        var modalInstance = $uibModal.open({
          animation: true,
          templateUrl: 'producer_modal.html',
          controller: 'ProducerModalCtrl',
          resolve: {
          }
        });

        modalInstance.result.then(function (result) {
            /*
             * Create new collector
             */
            $http({
                method: 'POST',
                url: '/api/producers',
                data:{
                    name: result.producer.name,
                    phone: result.producer.phone,
                    collector_id: $scope.lot.collector.id
                }
            }).then(function(response){
                    alertService.add("success", 'El productor "'+result.producer.name+'" se creo con exito');
                    console.log(response);
                    $scope.producers.push(response.data);

                }, function(error_response){
                    alertService.add("danger", 'Error al crear productor"'+result.producer.name+'". Porfavor intentelo más tarde');
                    console.log(error_response);
            });
        });
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

app.controller('CollectorModalCtrl', function($scope, $http, $uibModalInstance) {
  $scope.collector = {};

  $scope.ok = function () {
        $uibModalInstance.close({
            collector: $scope.collector
        });
    };

  $scope.cancel = function () {
    $uibModalInstance.dismiss('cancel');
  };
});



app.controller('ProducerModalCtrl', function($scope, $http, $uibModalInstance) {
  $scope.producer = {};

  $scope.ok = function () {
        $uibModalInstance.close({
            producer: $scope.producer
        });
    };

  $scope.cancel = function () {
    $uibModalInstance.dismiss('cancel');
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
    $scope.lots         = [];

    /*
     * Ask for lots info
     */
    $http.get('/api/subjects/'+$scope.loged_user.id+'/teacher')
       .then(function(response){
           console.log(response);
           $scope.lots = response.data;

       }, function(error_response){
           console.log('error', error_response);
       });

});
