app.controller('AcademicProgramamtionCtrl', function($scope, $http, alertService, userService){
    $scope.loged_user   = userService.getUser();
    $scope.alertService = alertService;
    $scope.subjects     = [];

    /*
     * Ask for all subjects info
     */
    $http.get('/api/coordinator/subjects')
       .then(function(response){
           console.log(response);
           $scope.subjects = response.data;

       }, function(error_response){
           console.log('error', error_response);
       });
});
