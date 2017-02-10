/*
 * Controlador de Login
 */
app.controller('LoginController', function ($scope,  $http, $timeout, $window, $location, CSRF_TOKEN, alertService, userService) {
    $scope.bad_message = "";
    $scope.bad_request = false;

    $scope.submit = function(){
        /*
         * Enviar datos a la API
         */
        var data = {
                    '_token': CSRF_TOKEN,
                    'email': $scope.user.email,
                    'password': $scope.user.password
                };

        $http({
                method: 'POST',
                url: '/login',
                headers: {
                    'Content-Type' : 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': CSRF_TOKEN
                },
                data: $.param(data)

        }).then(function(response){
            /*
             * Login success, store user info
             */
            userService.setUser(response.data.user);

            $window.location.href = "/dashboard";

            }, function(response){
                $scope.bad_message = response.data.description;
                $scope.bad_request = true;

                $timeout(function () {
                    $scope.bad_request = false;
                    $scope.bad_message = '';
                }, 5000);
        });
    }

});
