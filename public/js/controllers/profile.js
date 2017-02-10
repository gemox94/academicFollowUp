app.controller('profileController', function($scope, $http, $localStorage, $uibModal, $window, alertService){
    $storage            = $localStorage;
    $scope.alertService = alertService;
    api_prefix          = '/api/profile/'+$storage.user.id;

    /*
     * Get user info
     */
    $http.get(api_prefix)
        .then(function(response){
            $scope.user = response.data;

        }, function(error_response){
            console.log(error_response);
        });

    $scope.edit_profile_modal = function (user) {

        var modalInstance = $uibModal.open({
            templateUrl: 'edit_profile_modal.html',
            controller: 'EditModalInstance',
            resolve: {
                user: function (){
                    return user;
                }
            }
        });

        modalInstance.result.then(function (result) {
            /*
             * Update user
             */
            $http({
                method: 'PUT',
                url: '/api/profile/'+result.user.id,
                data:{
                    user: result.user
                }

            }).then(function(response){
                    alertService.add("success", 'Perfil actualizado');
                    $scope.user = result.user;

                }, function(error_response){
                    alertService.add("danger", 'Error al actualizar perfil');
                    console.log(error_response);
            });
        });
    };


    $scope.edit_karaoke_modal = function (karaoke) {

        var modalInstance = $uibModal.open({
            templateUrl: 'edit_karaoke_modal.html',
            controller: 'EditKaraokeModalInstance',
            resolve: {
                karaoke: function (){
                    return karaoke;
                }
            }
        });

        modalInstance.result.then(function (result) {
            /*
             * Update karaoke
             */
            $http({
                method: 'PUT',
                url: '/api/karaokes/'+result.karaoke.id,
                data:{
                    karaoke: result.karaoke
                }

            }).then(function(response){
                    alertService.add("success", 'Información del karaoke actualizada');
                    $scope.user.karaoke = result.karaoke;

                }, function(error_response){
                    alertService.add("danger", 'Error al actualizar karaoke');
                    console.log(error_response);
            });
        });
    };

});


app.controller('EditModalInstance', function ($scope, $http, $uibModalInstance, user) {
    $scope.user = user;

    $scope.ok = function () {
        $uibModalInstance.close({
            user: $scope.user
        });
    };

    $scope.cancel = function () {
        console.log('cancelling');
        $uibModalInstance.dismiss('cancel');
    };
});


app.controller('EditKaraokeModalInstance', function ($scope, $http, $uibModalInstance, karaoke) {
    $scope.karaoke = karaoke;

    $scope.ok = function () {
        $uibModalInstance.close({
            karaoke: $scope.karaoke
        });
    };

    $scope.cancel = function () {
        console.log('cancelling');
        $uibModalInstance.dismiss('cancel');
    };
});
