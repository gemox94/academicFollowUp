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
                    advertisement.color = $scope.colors[Math.floor(Math.random()*$scope.colors.length)];
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


app.controller('AdvertisementModalCtrl', function($scope, $uibModalInstance, advertisement) {
    $scope.advertisement = advertisement;

    $scope.ok = function () {
        $uibModalInstance.dismiss('cancel');
    };
});
