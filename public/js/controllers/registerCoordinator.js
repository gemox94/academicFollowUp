app.controller('RegisterCoordinatorCtrl', function($rootScope, $scope, $http, $uibModal, $timeout, alertService, spinnerService, userService){
    $scope.loged_user   = userService.getUser();
    $scope.alertService = alertService;
    $scope.coordinator  = {
        password: '',
        password2: ''
    };

    $scope.createCoordinator = function(){
        $http({
            method: 'POST',
            url: '/api/coordinator/new',
            data: {
                id: $scope.loged_user.id,
                password: $scope.coordinator.password
            }

        }).then(function(response){
                console.log(response);
                alertService.add("success", 'Se ha dado de alta como coordinador');
                $timeout(function(){
                    window.location.href= '/';

                },2500);

            }, function(error_response){
                alertService.add("danger", 'Error al darse de alta como coordinador. Porfavor inténtelo más tarde "');
                console.log(error_response);
        });
    }
});
