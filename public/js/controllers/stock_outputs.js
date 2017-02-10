app.controller('StockOutputCtrl', function($rootScope, $scope, $http, $uibModal, $timeout, alertService, spinnerService, userService, $filter){
    $scope.loged_user           = userService.getUser();
    $scope.alertService         = alertService;
    $scope.barcode              = {
        new_one: ""
    };
    $scope.stockOutput          = {
        id: window.stock_output_id,
        stages: [],
        stage_number: 0
    };

    /*
     * Check if we are gonna load an existing stockOutput
     */
    if ($scope.stockOutput.id) {
        /*
         * Ask for stockOutput info
         */
        $http.get('/api/stock/'+$scope.stockOutput.id)
            .then(function(response){
console.log(response);
                $scope.stockOutput = response.data;
                $scope.stockOutput.created_at = $filter('myDateFormat')($scope.stockOutput.created_at);

            }, function(error_response){
                console.log('error', error_response);
            });

    }else{
        /*
         * New StockOutput
         */

    }

    $scope.stagesCount = function(){
        return $scope.stockOutput.stages.length;
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
                var found = $scope.stockOutput.stages.some(function (stage) {
                    if(stage.barcode === $scope.barcode.new_one){
                        return true;
                    }
                });

                if(!found){
                    $scope.stockOutput.stages.push({
                        barcode: $scope.barcode.new_one
                    });
                }

                $scope.barcode.new_one = "";


            }, function(error_response){
                alertService.add("danger", 'Ese código no existe');
                console.log('error', error_response);
        });
    };


    /*
     * Save StockOutput
     */
    $scope.saveStockOutput = function(){
        if ($scope.stockOutput.id) {
            /*
             * UPDATE
             */

        }else{
            /*
             * CREATE StockOutput
             */
            $http({
                method: 'POST',
                url: '/api/stock',
                data:{
                    user_id: $scope.loged_user.id,
                    ticket: $scope.stockOutput.ticket,
                    stages: $scope.stockOutput.stages
                }

            }).then(function(response){
                    alertService.add("success", 'La salida de almacén se creo con exito');
                    console.log(response);

                    //window.location.href = '/shipments/list/';

                }, function(error_response){
                    alertService.add("danger", 'Error al crear nueva salida de almacén. Inténtelo más tarde');
                    console.log(error_response);

            }).finally(function() {

            });
        }
    };

});





app.controller('StockOutputListCtrl', function($rootScope, $scope, $http, $uibModal, $timeout, alertService, spinnerService, userService){
    $scope.loged_user   = userService.getUser();
    $scope.alertService = alertService;
    $scope.stockOutputs = [];

    /*
     * Ask for shipments info
     */
    $http.get('/api/stock/')
       .then(function(response){
           console.log(response);
           $scope.stockOutputs = response.data;

       }, function(error_response){
           console.log('error', error_response);
       });

});
