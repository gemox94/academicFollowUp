app.controller('StudentAdvertisementsCtrl', function($scope, $http, alertService, userService, $uibModal){
    $scope.loged_user   = userService.getUser();
    $scope.alertService = alertService;
    $scope.subjects     = [];
    $scope.colors       = ['primary', 'success', 'info', 'warning', 'danger', 'mint', 'purple', 'pink', 'dark'];

    /*
     * Ask for subjects info
     */
    $http.get('/api/student/'+$scope.loged_user.id+'/getAdvertisements')
       .then(function(response){

           $scope.subjects = response.data;

           $scope.subjects.forEach(function(subject){
                subject.advertisements.forEach(function(advertisement){
                    advertisement.color     = $scope.colors[Math.floor(Math.random()*$scope.colors.length)];
                    advertisement.created_at = advertisement.created_at.replace(/(.+) (.+)/, "$1T$2Z");
                });

                if (subject.advertisements.length === 0) {
                    var advertisement = {
                        title: 'No hay ningun anuncio',
                        message: 'No hay ningun anuncio'
                    };

                    subject.advertisements.push(advertisement);
                }
           });

       }, function(error_response){
           console.log('error', error_response);
       });


    /*
     * See the info of an advertisement
     */
    $scope.openAdvertisement = function (advertisement) {
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

        modalInstance.result.then(function () {
            /*
             * Do NOTHING
             */
        });
    };

});


app.controller('TeacherAdvertisementsCtrl', function($scope, $http, alertService, userService, $uibModal){
    $scope.loged_user     = userService.getUser();
    $scope.alertService   = alertService;
    $scope.advertisements = [];
    $scope.colors         = ['primary', 'success', 'info', 'warning', 'danger', 'mint', 'purple', 'pink', 'dark'];

    /*
     * Ask for subjects info
     */
    $http.get('/api/teacher/'+$scope.loged_user.id+'/getAdvertisements')
       .then(function(response){
           $scope.advertisements = response.data;

           $scope.advertisements.forEach(function(advertisement){
                advertisement.color      = $scope.colors[Math.floor(Math.random()*$scope.colors.length)];
                advertisement.created_at = advertisement.created_at.replace(/(.+) (.+)/, "$1T$2Z");
            });

            if ($scope.advertisements.length === 0) {
                var advertisement = {
                    title: 'No hay ningun anuncio',
                    message: 'No hay ningun anuncio'
                };

                $scope.advertisements.push(advertisement);
            }

       }, function(error_response){
           console.log('error', error_response);
       });


    /*
     * See the info of an advertisement
     */
    $scope.openAdvertisement = function (advertisement) {
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

        modalInstance.result.then(function () {
            /*
             * Do NOTHING
             */
        });
    };

});


app.controller('AdvertisementModalCtrl', function($scope, $uibModalInstance, advertisement) {
    $scope.advertisement = advertisement;

    $scope.ok = function () {
        $uibModalInstance.dismiss('cancel');
    };
});


app.controller('CoordinatorAdvertisementsCtrl', function($scope, $http, alertService, userService, $uibModal) {
    $scope.loged_user     = userService.getUser();
    $scope.advertisements = [];


    /*
     * Ask for advertisements
     */
    $http.get('/api/coordinator/'+$scope.loged_user.id+'/getAdvertisements')
        .then(function(response){
            $scope.advertisements = response.data;

        }, function(error_response){
            console.log('error', error_response);
        });


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
            controller: 'AdvertisementCoordinatorModalCtrl',
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
                    url: '/api/coordinator/'+$scope.loged_user.id+'/createAdvertisement',
                    data:{
                        advertisement: result.advertisement
                    }
                }).then(function(response){
                        alertService.add("success", 'Se ha creado el anuncio con éxito', false);
                        $scope.advertisements.push(response.data);

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
                    url: '/api/coordinator/'+$scope.loged_user.id+'/editAdvertisement',
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
         * First is the CONFIRM directive and then the DELETE
         */
        $http({
            method: 'DELETE',
            url: '/api/coordinator/'+$scope.loged_user.id+'/deleteAdvertisement/'+advertisement.id,

        }).then(function(response){
                alertService.add("warning", 'Se ha eliminado el anuncio', false);
                console.log(response);
                $scope.advertisements.splice(index, 1);

            }, function(error_response){
                alertService.add("danger", 'Error al eliminar anuncio. Porfavor intentelo más tarde', false);
                console.log(error_response);
        });
    };

});


app.controller('AdvertisementCoordinatorModalCtrl', function($scope, $uibModalInstance, advertisement) {
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
