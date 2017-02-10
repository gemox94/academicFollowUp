app.controller('LotCtrl', function($rootScope, $scope, $http, $uibModal, $timeout, alertService, spinnerService, userService, $filter){
    $scope.loged_user   = userService.getUser();
    $scope.alertService = alertService;
    $scope.collectors   = [];
    $scope.producers    = [];
    $scope.orchards     = [];
    $scope.calibers     = [];
    $scope.lot          = {
        id: window.lot_id
    };

    /*
     * Load calibers
     */
    $http.get('/api/calibers/')
            .then(function(response){
    console.log(response);
            $scope.calibers = response.data;

            }, function(error_response){
                console.log('error', error_response);
            });


    /*
     * Check if we are gonna load an existing lot
     */
    if ($scope.lot.id) {
        /*
         * Ask for lot info
         */
        $http.get('/api/lots/'+$scope.lot.id)
            .then(function(response){
    console.log(response);
                $scope.lot = response.data;
                $scope.lot.created_at = $filter('myDateFormat')($scope.lot.created_at);
                $scope.lot.pay_date = $filter('myDateFormat')($scope.lot.pay_date);

            }, function(error_response){
                console.log('error', error_response);
            });


        $scope.loadProducers = function(){
    console.log($scope.lot.collector);
            /*
             * Ask for list of producers
             */
            $http.get('/api/collectors/'+$scope.lot.collector.id+'/producers/')
                .then(function(response){
                    console.log(response);
                    $scope.producers = response.data;
        console.log($scope.producers);

                }, function(error_response){
                    console.log('error', error_response);
                });
        };
    }else{
        /*
         * New Lot
         * Ask for list of collectors
         */
        var todayDate = moment();

        /*
         * Ask for configuration info
         */
        $http.get('/api/configuration')
           .then(function(response){
               console.log(response);
               var configuration = response.data;

               /*
                * Add days of configuration to pay_date
                */
               $scope.lot.pay_date = todayDate.add(configuration.day_interval, 'days').toDate();

           }, function(error_response){
               console.log('error', error_response);
        });

        $http.get('/api/collectors')
            .then(function(response){
                console.log(response);
                $scope.collectors = response.data;
    console.log($scope.collectors);

            }, function(error_response){
                console.log('error', error_response);
            });


        $scope.loadProducers = function(){
    console.log($scope.lot.collector);
            /*
             * Ask for list of producers
             */
            $http.get('/api/collectors/'+$scope.lot.collector.id+'/producers/')
                .then(function(response){
                    console.log(response);
                    $scope.producers = response.data;
        console.log($scope.producers);

                }, function(error_response){
                    console.log('error', error_response);
                });
        };
    }


    $scope.loadOrchards = function(){
        if ($scope.lot.producer != undefined) {
            /*
             * Ask for list of orchards
             */
        $http.get('/api/producers/'+$scope.lot.producer.id+'/orchards/')
            .then(function(response){
                console.log(response);
                $scope.orchards = response.data;
    console.log($scope.orchards);

            }, function(error_response){
                console.log('error', error_response);
            });

        }else{
            $scope.orchards = [];
        }
    };

    $scope.saveLot = function(){


        if ($scope.lot.id) {
            /*
             * UPDATE
             */

        }else{
            /*
             * CREATE LOT
             */
            $http({
                method: 'POST',
                url: '/api/lots',
                data:{
                    collector_id: $scope.lot.collector.id,
                    producer_id: $scope.lot.producer.id,
                    orchard_id: $scope.lot.orchard.id,
                    user_id: $scope.loged_user.id,
                    carry: $scope.lot.carry,
                    kilo_price: $scope.lot.kilo_price,
                    cut_price: $scope.lot.cut_price,
                    bascule_weight: $scope.lot.bascule_weight,
                    pay_date: $scope.lot.pay_date,
                    number: $scope.lot.number
                }

            }).then(function(response){
                    alertService.add("success", 'El lote "'+$scope.lot.number+'" se creo con exito');
                    console.log(response);

                    window.location.href = '/labels/lots/'+response.data.id

                }, function(error_response){
                    alertService.add("danger", 'Error al crear lote "'+$scope.lot.number+'". Porfavor intentelo más tarde');
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



app.controller('LotListCtrl', function($rootScope, $scope, $http, $uibModal, $timeout, alertService, spinnerService, userService){
    $scope.loged_user   = userService.getUser();
    $scope.alertService = alertService;
    $scope.lots         = [];

    /*
     * Ask for lots info
     */
    $http.get('/api/lots/')
       .then(function(response){
           console.log(response);
           $scope.lots = response.data;

       }, function(error_response){
           console.log('error', error_response);
       });

});
