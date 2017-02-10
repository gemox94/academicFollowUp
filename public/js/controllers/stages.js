app.controller('StageCtrl', function($rootScope, $scope, $http, $uibModal, $timeout, alertService, spinnerService, userService, $filter){
    $scope.loged_user           = userService.getUser();
    $scope.alertService         = alertService;
    $scope.stage_configurations = [];
    $scope.returned_boxes       = [];
    $scope.barcode              = {
        new_one: ""
    };
    $scope.stage                = {
        id: window.stage_id,
        configDone : false,
        boxes: []
    };

    /*
     * Check if we are gonna load an existing stage
     */
    if ($scope.stage.id) {
        /*
         * Ask for stage info
         */
        $http.get('/api/stages/'+$scope.stage.id)
            .then(function(response){
    console.log(response);
                $scope.stage = response.data;
                $scope.stage.created_at = $filter('myDateFormat')($scope.stage.created_at);

            }, function(error_response){
                console.log('error', error_response);
            });

    }else{
        /*
         * Load stage_configurations
         */
        $http.get('/api/stage_configurations/')
            .then(function(response){
                $scope.stage_configurations = response.data;

            }, function(error_response){
                console.log('error', error_response);
        });

    }

    $scope.saveStageConfiguration = function() {
        /*
         * Add country and show next view
         */
        $scope.stage.configDone = true;
    };

    $scope.boxesCount = function(){
        var totalCount = 0;

        for(i = 0; i < $scope.stage.boxes.length; i++){
            totalCount += $scope.stage.boxes[i].count;
        }

        return totalCount;
    };


    $scope.addBarcode = function(){
        /*
         * check if we are full
         */
        if ($scope.stage.boxes.length < $scope.stage.configuration.box_number) {
            /*
             * Get Caliber_Lot with this code
             */
            $http.get('/api/calibers_lots/'+$scope.barcode.new_one+'/barcode')
                .then(function(response){
                    /*
                     * This exists then
                     */
                    var found = $scope.stage.boxes.some(function (box) {
                        if(box.barcode === $scope.barcode.new_one){
                            box.count++;
                            return true;
                        }
                    });

                    if(!found){
                        $scope.stage.boxes.push({
                            barcode: $scope.barcode.new_one,
                            count: 1
                        });
                    }


                    $scope.barcode.new_one = "";


                }, function(error_response){
                    alertService.add("danger", 'Ese código no existe');
                    console.log('error', error_response);
            });

        }else{
            alertService.add("warning", 'Tarima llena y lista para guardar');
        }
    };


    /*
     * Save stage
     */
    $scope.saveStage = function(){
        if ($scope.stage.id) {
            /*
             * UPDATE
             */

        }else{
            /*
             * CREATE STAGE
             */
            $http({
                method: 'POST',
                url: '/api/stages',
                data:{
                    user_id: $scope.loged_user.id,
                    boxes: $scope.stage.boxes,
                    configuration: $scope.stage.configuration
                }

            }).then(function(response){
                    alertService.add("success", 'La tarima "'+response.data.barcode+'" se creo con exito');
                    console.log(response);

                    window.location.href = '/labels/stages/'+response.data.id;

                }, function(error_response){
                    alertService.add("danger", 'Error al crear tarima');
                    console.log(error_response);

            }).finally(function() {

            });
        }
    };

});




app.controller('StageListCtrl', function($rootScope, $scope, $http, $uibModal, $timeout, alertService, spinnerService, userService){
    $scope.loged_user   = userService.getUser();
    $scope.alertService = alertService;
    $scope.stages       = [];

    /*
     * Ask for stages info
     */
    $http.get('/api/stages/')
       .then(function(response){
           console.log(response);
           $scope.stages = response.data;

       }, function(error_response){
           console.log('error', error_response);
       });

});
