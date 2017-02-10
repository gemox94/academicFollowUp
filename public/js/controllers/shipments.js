app.controller('ShipmentCtrl', function($rootScope, $scope, $http, $timeout, $uibModal, $timeout, alertService, spinnerService, userService, $filter){
    $scope.loged_user           = userService.getUser();
    $scope.alertService         = alertService;
    $scope.barcode              = {
        new_one: ""
    };
    $scope.shipment             = {
        id: window.shipment_id,
        stages: [],
        box_number: 0,
        decrease_total: 0,
        fruit_total: 0,
        total: 0
    };

    /*
     * Check if we are gonna load an existing shipment
     */
    if ($scope.shipment.id) {
        /*
         * Ask for shipment info
         */
        $http.get('/api/shipments/'+$scope.shipment.id)
            .then(function(response){
console.log(response);
                $scope.shipment = response.data;
                $scope.shipment.created_at = $filter('myDateFormat')($scope.shipment.created_at);

                if ($scope.shipment.status == 'returned') {
                    $scope.shipment.status2 = 'Entregado';

                }else{
                    $scope.shipment.status2 = 'En espera';
                }

            }, function(error_response){
                console.log('error', error_response);
            });

    }else{
        /*
         * New shipment
         * The load decrease lots
         */
        $http.get('/api/lots/decrease')
            .then(function(response){
console.log(response);
                $scope.shipment.decrease_lots = response.data;

            }, function(error_response){
                console.log('error', error_response);
            });

    }

    $scope.stagesCount = function(){
        return $scope.shipment.stages.length;
    };


    $scope.sumTotalDecrease = function(){
        var total = 0;
        $scope.shipment.decrease_lots.forEach(function(element){
            total += element.total_cost;
        });

        $scope.shipment.decrease_total = total;
        $scope.sumTotal();
    }

    $scope.sumDirect = function(){
        $scope.shipment.direct_total_mxn = parseFloat($scope.shipment.flete) + parseFloat($scope.shipment.packing_mxn) + parseFloat($scope.shipment.secure_mxn) + parseFloat($scope.shipment.customs_mexican_mxn) + parseFloat($scope.shipment.customs_american_mxn) + parseFloat($scope.shipment.box_total_mxn);
        $scope.shipment.direct_total_usd = $scope.shipment.direct_total_mxn / $scope.shipment.exchange;

        $scope.sumTotal();
    }

    $scope.sumTotal = function(){
        $scope.shipment.total = 0;

        if (!isNaN($scope.shipment.direct_total_mxn)) {
            $scope.shipment.total += parseFloat($scope.shipment.direct_total_mxn);
        }

        if (!isNaN($scope.shipment.decrease_total)) {
            $scope.shipment.total += parseFloat($scope.shipment.decrease_total);
        }

        if (!isNaN($scope.shipment.fruit_total)) {
            $scope.shipment.total += parseFloat($scope.shipment.fruit_total);
        }
    }

    $scope.addBarcode = function(){
        /*
         * Get Stage with this code
         */
        $http.get('/api/stages/'+$scope.barcode.new_one+'/barcode')
            .then(function(response){
                /*
                 * This exists then
                 */
                var found = $scope.shipment.stages.some(function (stage) {
                    if(stage.barcode === $scope.barcode.new_one){
                        return true;
                    }
                });

                if(!found){
                    /*
                     * sum box number
                     * And add it to stages
                     */
                    $scope.shipment.box_number  += parseInt(response.data.box_number);
                    $scope.shipment.fruit_total += parseFloat(response.data.real_fruit_price);
                    $scope.sumTotal();

                    $scope.shipment.stages.push({
                        barcode: $scope.barcode.new_one,
                        box_number: response.data.box_number
                    });
                }

                $scope.barcode.new_one = "";


            }, function(error_response){
                alertService.add("danger", 'Ese código no existe');
                console.log('error', error_response);
        });
    };


    /*
     * Porcentaje Utilidad
     */
    $scope.billPercentage = function () {
        var modalInstance = $uibModal.open({
          animation: true,
          templateUrl: 'bill_percentage.html',
          controller: 'BillPercentageModalCtrl',
          resolve: {
          }
        });

        modalInstance.result.then(function (result) {
            $scope.shipment.bill_percentage = result.shipment.bill_percentage;

            /*
             * CREATE SHIPMENT
             */
            $http({
                method: 'POST',
                url: '/api/shipments',
                data:{
                    user_id: $scope.loged_user.id,
                    shipment: $scope.shipment,
                    stages: $scope.shipment.stages,
                    decrease_lots: $scope.shipment.decrease_lots
                }

            }).then(function(response){
                    alertService.add("success", 'El embarque "'+response.data.barcode+'" se creo con exito');
                    console.log(response);

                    $timeout(function(){
                        window.location.href = '/shipments/list/'
                    }, 2000);

                }, function(error_response){
                    alertService.add("danger", 'Error al crear embarque. Inténtelo más tarde');
                    console.log(error_response);

            }).finally(function() {

            });

        });
    };


    /*
     * Save stage
     */
    $scope.saveShipment = function(){
        if ($scope.shipment.id) {
            /*
             * UPDATE
             */

        }else{
            /*
             * Dialog of bill_percentage "porcentaje de utilidad"
             */
            $scope.billPercentage();
        }
    };

});


app.controller('ShipmentDeliverCtrl', function($rootScope, $scope, $http, $uibModal, $timeout, alertService, spinnerService, userService, $filter){
    $scope.loged_user           = userService.getUser();
    $scope.alertService         = alertService;
    $scope.barcode              = {
        new_one: "",
        news: []
    };
    $scope.shipment             = {
        id: window.shipment_id,
        stages: []
    };

    /*
     * Check if we are gonna load an existing shipment
     */
    if ($scope.shipment.id) {
        /*
         * Ask for shipment info
         */
        $http.get('/api/shipments/'+$scope.shipment.id)
            .then(function(response){
    console.log(response);
                $scope.shipment = response.data;
                $scope.shipment.created_at = $filter('myDateFormat')($scope.shipment.created_at);

            }, function(error_response){
                console.log('error', error_response);
            });

    }else{

    }

    $scope.stagesCount = function(){
        return $scope.barcode.news.length;
    };


    $scope.addBarcode = function(){
        /*
         * Get Stage with this code
         */
        $http.get('/api/stages/'+$scope.barcode.new_one+'/barcode')
            .then(function(response){
                /*
                 * This exists then
                 */
                var found = $scope.shipment.stages.some(function (stage) {
                    if(stage.barcode === $scope.barcode.new_one){
                        /*
                         * Cambiar clase
                         */
                        alertService.add("success", 'Tarima devuelta', false);
                        stage.status = 'returned';
                        $scope.barcode.news.push({
                            barcode: $scope.barcode.new_one
                        });

                        return true;
                    }
                });

                if(!found){
                    alertService.add("danger", 'Esa tarima no pertenece a este embarque');
                }

                $scope.barcode.new_one = "";


            }, function(error_response){
                alertService.add("danger", 'Ese código no existe');
                console.log('error', error_response);
        });
    };


    $scope.modalConfirmation = function (number) {
        var modalInstance = $uibModal.open({
            animation: true,
            templateUrl: 'confirmation_modal.html',
            controller: function($scope, $uibModalInstance, number){
                $scope.number = number;

                $scope.ok = function () {
                    $uibModalInstance.close({
                    });
                };

                $scope.cancel = function () {
                    $uibModalInstance.dismiss('cancel');
                };
            },
            resolve: {
                number: function(){
                    return number;
                }
            }
        });

        modalInstance.result.then(function (result) {
            $scope.sendShipment();
        });
    };


    /*
     * Deliver Shipment
     */
    $scope.deliverShipment = function(){
        /*
         * Check if there are missing stages
         */
        if ($scope.barcode.news.length < $scope.shipment.stages.length) {
            var number = $scope.shipment.stages.length - $scope.barcode.news.length;
console.log(number);
            $scope.modalConfirmation(number);

        }else{
            $scope.sendShipment();
        }
    };

    $scope.sendShipment = function(){
        /*
         * DELIVER SHIPMENT
         */
        $http({
            method: 'PUT',
            url: '/api/shipments/'+$scope.shipment.id+'/deliver',
            data:{
                user_id: $scope.loged_user.id,
                stages: $scope.barcode.news
            }

        }).then(function(response){
console.log(response);
                alertService.add("success", 'El embarque "'+response.data.barcode+'" se entregó con exito');

                if (response.data.api_send == 200) {
                    /*
                     * SUCCESS
                     */
                    alertService.add("warning", 'SE AGREGÓ PRODUCTOS AL PUNTO DE VENTA');

                }else{
                    alertService.add("danger", 'ERROR AL AGREGAR PRODUCTOS AL PUNTO DE VENTA');
                }

                $timeout(function(){
                    window.location.href = '/shipments/list/'
                }, 7000);

            }, function(error_response){
                alertService.add("danger", 'Error al entregar embarque. Inténtelo más tarde');
                console.log(error_response);

        }).finally(function() {

        });
    }

});




app.controller('ShipmentListCtrl', function($rootScope, $scope, $http, $uibModal, $timeout, alertService, spinnerService, userService){
    $scope.loged_user   = userService.getUser();
    $scope.alertService = alertService;
    $scope.shipments    = [];

    /*
     * Ask for shipments info
     */
    $http.get('/api/shipments/')
       .then(function(response){
           console.log(response);
           $scope.shipments = response.data;

       }, function(error_response){
           console.log('error', error_response);
       });

});


app.controller('BillPercentageModalCtrl', function($scope, $http, $uibModalInstance) {
    $scope.shipment = {
        bill_percentage: 30
    };

    $scope.ok = function () {
            $uibModalInstance.close({
                shipment: $scope.shipment
            });
      };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };
});
