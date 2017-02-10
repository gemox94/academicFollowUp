app.controller('CaliberConfigurationCtrl', function($rootScope, $scope, $http, $uibModal, $timeout, userService, alertService, spinnerService){
    $scope.loged_user   = userService.getUser();
    $scope.alertService = alertService;
    $scope.calibers     = [];

    /*
     * Ask for calibers info
     */
    $http.get('/api/calibers/all')
       .then(function(response){
           console.log(response);
           $scope.calibers = response.data;

       }, function(error_response){
           console.log('error', error_response);
    });



    $scope.modalCaliber = function (caliber) {
        var modalInstance = $uibModal.open({
          animation: true,
          templateUrl: 'caliber_modal.html',
          controller: 'CaliberModalCtrl',
          resolve: {
            caliber: function(){
                return caliber;
            }

          }
        });

        modalInstance.result.then(function (result) {
            if (!result.caliber.id) {
                /*
                 * Create new caliber
                 */
                $http({
                    method: 'POST',
                    url: '/api/calibers',
                    data:{
                        name: result.caliber.name,
                        percentage: result.caliber.percentage,
                        a_percentage: result.caliber.a_percentage,
                        b_percentage: result.caliber.b_percentage,
                        user_id: $scope.loged_user.id
                    }
                }).then(function(response){
                        alertService.add("success", 'El calibre "'+result.caliber.name+'" se creó con exito');
                        console.log(response);
                        $scope.calibers.push(response.data);

                    }, function(error_response){
                        alertService.add("danger", 'Error al crear calibre"'+result.caliber.name+'". Porfavor intentelo más tarde');
                        console.log(error_response);
                });

            }else{
                /*
                 * Edit Caliber
                 */
                $http({
                    method: 'PUT',
                    url: '/api/calibers/'+result.caliber.id,
                    data:{
                        id: result.caliber.id,
                        name: result.caliber.name,
                        percentage: result.caliber.percentage,
                        a_percentage: result.caliber.a_percentage,
                        b_percentage: result.caliber.b_percentage,
                        user_id: $scope.loged_user.id
                    }
                }).then(function(response){
                        alertService.add("success", 'El calibre "'+result.caliber.name+'" se actualizó con exito');
                        console.log(response);


                    }, function(error_response){
                        alertService.add("danger", 'Error al actualizar calibre"'+result.caliber.name+'". Porfavor intentelo más tarde');
                        console.log(error_response);
                });
            }
        });
    };


    $scope.enableCaliber = function(caliber, index){
        var modalInstance = $uibModal.open({
          animation: true,
          templateUrl: 'caliber_enable_modal.html',
          controller: 'EnableCaliberModalCtrl',
          resolve: {
                caliber: function (){
                    return caliber;
                },
                index: function(){
                    return index
                }
          }
        });

        modalInstance.result.then(function (result) {
            /*
             * Enable caliber
             */
            $http({
                method: 'PUT',
                url: '/api/calibers/'+result.caliber.id+'/enable'

            }).then(function(response){
                    alertService.add("success", 'El calibre "'+result.caliber.name+'" se activó');
                    caliber.deleted_at = undefined;

                }, function(error_response){
                    alertService.add("danger", 'Error al activar calibre"'+result.caliber.name+'". Porfavor intentelo más tarde');
                    console.log(error_response);
            });
        });
    };

    $scope.deleteCaliber = function(caliber, index){
        var modalInstance = $uibModal.open({
          animation: true,
          templateUrl: 'caliber_delete_modal.html',
          controller: 'DeleteCaliberModalCtrl',
          resolve: {
                caliber: function (){
                    return caliber;
                },
                index: function(){
                    return index
                }
          }
        });

        modalInstance.result.then(function (result) {
            /*
             * Delete caliber
             */
            $http({
                method: 'DELETE',
                url: '/api/calibers/'+result.caliber.id

            }).then(function(response){
                    alertService.add("warning", 'El calibre "'+result.caliber.name+'" se desactivó');
                    caliber.deleted_at = '2012';

                }, function(error_response){
                    alertService.add("danger", 'Error al desactivar calibre"'+result.caliber.name+'". Porfavor intentelo más tarde');
                    console.log(error_response);
            });
        });
    };

});



app.controller('CaliberModalCtrl', function($scope, $http, $uibModalInstance, caliber) {
  $scope.caliber = caliber;

  $scope.ok = function () {
        $uibModalInstance.close({
            caliber: $scope.caliber
        });
    };

  $scope.cancel = function () {
    $uibModalInstance.dismiss('cancel');
  };


    $scope.calculate_qualitys = function(quality){
        /*
         * Check which quality we should calculate
         */
        if (quality == 'A') {
            /*
             * Calculate A
             */
            if ($scope.caliber.b_percentage <= 100) {
                $scope.caliber.a_percentage = 100 - $scope.caliber.b_percentage;

            }else{
                $scope.caliber.a_percentage = 0;
                $scope.caliber.b_percentage = 0;
            }

        }else{
            /*
             * Calculate B
             */
            if ($scope.caliber.a_percentage <= 100) {
                $scope.caliber.b_percentage = 100 - $scope.caliber.a_percentage;

            }else{
                $scope.caliber.a_percentage = 0;
                $scope.caliber.b_percentage = 0;
            }
        }
    };

});


app.controller('DeleteCaliberModalCtrl', function($scope, $http, $uibModalInstance, caliber, index) {
  $scope.caliber = caliber;
  $scope.index   = index;

  $scope.ok = function () {
        $uibModalInstance.close({
            caliber: $scope.caliber,
            index: $scope.index
        });
    };

  $scope.cancel = function () {
    $uibModalInstance.dismiss('cancel');
  };
});


app.controller('EnableCaliberModalCtrl', function($scope, $http, $uibModalInstance, caliber, index) {
  $scope.caliber = caliber;
  $scope.index   = index;

  $scope.ok = function () {
        $uibModalInstance.close({
            caliber: $scope.caliber,
            index: $scope.index
        });
    };

  $scope.cancel = function () {
    $uibModalInstance.dismiss('cancel');
  };
});





app.controller('GeneralConfigurationCtrl', function($rootScope, $scope, $http, $uibModal, $timeout, userService, alertService, spinnerService){
    $scope.loged_user     = userService.getUser();
    $scope.alertService   = alertService;
    $scope.configuration = {};

    /*
     * Ask for configuration info
     */
    $http.get('/api/configuration')
       .then(function(response){
           console.log(response);
           $scope.configuration = response.data;

       }, function(error_response){
           console.log('error', error_response);
    });

    $scope.checkDecrease = function(){
        if ($scope.configuration.decrease_percentage > 100) {
            alertService.add("danger", 'La merma no puede ser mayor a 100 %');
            $scope.configuration.decrease_percentage = 0;
        }else{
            alertService.closeAlert();
        }
    }

    $scope.submitConfiguration = function(){
            /*
             * Save configuration info
             */
            $http({
                method: 'PUT',
                url:'/api/configuration/save',
                data: {
                    decrease_percentage: $scope.configuration.decrease_percentage,
                    day_interval: $scope.configuration.day_interval
                }

            }).then(function(response){
                    alertService.add("success", 'Configuración guardada');

                }, function(error_response){
                    alertService.add("danger", 'Error al guardar configuración. Porfavor intentelo más tarde.');
                    console.log(error_response);
            });
    };


    $scope.submitFiscalConfiguration = function(){
        /*
         * Save fiscal configuration info
         */
        $http({
            method: 'PUT',
            url:'/api/configuration/save/fiscal',
            data: {
                configuration: $scope.configuration
            }

        }).then(function(response){
                alertService.add("success", 'Configuración Fiscal guardada');

            }, function(error_response){
                alertService.add("danger", 'Error al guardar configuración fiscal. Porfavor intentelo más tarde.');
                console.log(error_response);
        });
    };


    $scope.submitLogoConfiguration = function(){
        var formData = new FormData();
        formData.append('image', $('input[type=file]')[0].files[0]);

        /*
         * Save logo configuration
         */
        $http({
            method: 'POST',
            url:'/api/configuration/save/logo',
            withCredentials: true,
            headers: {
                'Content-Type': undefined
            },
            transformRequest: angular.identity,
            data: formData

        }).then(function(response){
                alertService.add("success", 'Logo guardado');

            }, function(error_response){
                alertService.add("danger", 'Error al guardar el Logo. Porfavor intentelo más tarde.');
                console.log(error_response);
        });
    };

});



app.controller('StageConfigurationCtrl', function($rootScope, $scope, $http, $uibModal, $timeout, userService, alertService, spinnerService){
    $scope.loged_user           = userService.getUser();
    $scope.alertService         = alertService;
    $scope.stage_configurations = [];

    /*
     * Ask for stageconfigurations info
     */
    $http.get('/api/stage_configurations/all')
       .then(function(response){
           console.log(response);
           $scope.stage_configurations = response.data;

       }, function(error_response){
           console.log('error', error_response);
    });



    $scope.modalStageConfiguration = function (stage_configuration) {
        var modalInstance = $uibModal.open({
          animation: true,
          templateUrl: 'stage_configuration_modal.html',
          controller: 'StageConfigurationModalCtrl',
          resolve: {
            stage_configuration: function(){
                return stage_configuration;
            }

          }
        });

        modalInstance.result.then(function (result) {
            if (!result.stage_configuration.id) {
                /*
                 * Create new stage configuration
                 */
                $http({
                    method: 'POST',
                    url: '/api/stage_configurations',
                    data:{
                        country: result.stage_configuration.country,
                        box_number: result.stage_configuration.box_number,
                        user_id: $scope.loged_user.id
                    }
                }).then(function(response){
                        alertService.add("success", 'Se agregó una nueva configuración');
                        console.log(response);
                        $scope.stage_configurations.push(response.data);

                    }, function(error_response){
                        alertService.add("danger", 'Error al crear configuración');
                        console.log(error_response);
                });

            }else{
                /*
                 * Edit StageConfigurations
                 */
                $http({
                    method: 'PUT',
                    url: '/api/stage_configurations/'+result.stage_configuration.id,
                    data:{
                        id: result.stage_configuration.id,
                        country: result.stage_configuration.country,
                        box_number: result.stage_configuration.box_number,
                        user_id: $scope.loged_user.id
                    }
                }).then(function(response){
                        alertService.add("success", 'Se actualizó la configuración');
                        console.log(response);


                    }, function(error_response){
                        alertService.add("danger", 'Error al actualizar la configuración');
                        console.log(error_response);
                });
            }
        });
    };


    $scope.enableStageConfiguration = function(stage_configuration, index){
        var modalInstance = $uibModal.open({
          animation: true,
          templateUrl: 'stage_configuration_enable_modal.html',
          controller: 'EnableStageConfigurationModalCtrl',
          resolve: {
                stage_configuration: function (){
                    return stage_configuration;
                },
                index: function(){
                    return index
                }
          }
        });

        modalInstance.result.then(function (result) {
            /*
             * Enable caliber
             */
            $http({
                method: 'PUT',
                url: '/api/stage_configurations/'+result.stage_configuration.id+'/enable'

            }).then(function(response){
                    alertService.add("success", 'Se activó dicha configuración');
                    stage_configuration.deleted_at = undefined;

                }, function(error_response){
                    alertService.add("danger", 'Error al activar configuración');
                    console.log(error_response);
            });
        });
    };

    $scope.deleteStageConfiguration = function(stage_configuration, index){
        var modalInstance = $uibModal.open({
          animation: true,
          templateUrl: 'stage_configuration_delete_modal.html',
          controller: 'DeleteStageConfigurationModalCtrl',
          resolve: {
                stage_configuration: function (){
                    return stage_configuration;
                },
                index: function(){
                    return index
                }
          }
        });

        modalInstance.result.then(function (result) {
            /*
             * Delete stage_configuration
             */
            $http({
                method: 'DELETE',
                url: '/api/stage_configurations/'+result.stage_configuration.id

            }).then(function(response){
                    alertService.add("warning", 'Se desactivó la configuración');
                    stage_configuration.deleted_at = '2012';

                }, function(error_response){
                    alertService.add("danger", 'Error al desactivar la configuración');
                    console.log(error_response);
            });
        });
    };

});


app.controller('StageConfigurationModalCtrl', function($scope, $http, $uibModalInstance, stage_configuration) {
  $scope.stage_configuration = stage_configuration;

  $scope.ok = function () {
        $uibModalInstance.close({
            stage_configuration: $scope.stage_configuration
        });
    };

  $scope.cancel = function () {
    $uibModalInstance.dismiss('cancel');
  };
});



app.controller('DeleteStageConfigurationModalCtrl', function($scope, $http, $uibModalInstance, stage_configuration, index) {
  $scope.stage_configuration = stage_configuration;
  $scope.index   = index;

  $scope.ok = function () {
        $uibModalInstance.close({
            stage_configuration: $scope.stage_configuration,
            index: $scope.index
        });
    };

  $scope.cancel = function () {
    $uibModalInstance.dismiss('cancel');
  };
});


app.controller('EnableStageConfigurationModalCtrl', function($scope, $http, $uibModalInstance, stage_configuration, index) {
  $scope.stage_configuration = stage_configuration;
  $scope.index   = index;

  $scope.ok = function () {
        $uibModalInstance.close({
            stage_configuration: $scope.stage_configuration,
            index: $scope.index
        });
    };

  $scope.cancel = function () {
    $uibModalInstance.dismiss('cancel');
  };
});
