(function () {
    angular.module('academic')
        .controller('registerController', function ($scope,  $http, $timeout, $window, $location, CSRF_TOKEN, alertService, userService) {
            $scope.bad_message = "";
            $scope.bad_request = false;
            $scope.alertService = alertService;
            $scope.user = {};

            $scope.check_radio = function(){
                if($scope.user.rol == 2){
                    $scope.show_cubicle = true;
                }else{
                    $scope.show_cubicle = false;
                }
            };

            $scope.bad_password = false;
            $scope.checkPass = function(){
                if($scope.show_cubicle && $scope.user.password != undefined){
                    if($scope.user.password.substring(0,1) != 'P'){
                        $scope.bad_password = true;
                    }
                    if($scope.user.password.substring(0,1) == 'P'){
                        $scope.bad_password = false;
                    }
                }
            };

            $scope.submit = function(){
                /*
                 * Enviar datos a la API
                 */
                var data = {
                    '_token': CSRF_TOKEN,
                    'rol': $scope.user.rol != undefined ? $scope.user.rol : '',
                    'name': $scope.user.name,
                    'lastname': $scope.user.lastname,
                    'email': $scope.user.email,
                    'password': $scope.user.password,
                    'confirmpass' : $scope.user.confirmpass,
                    'key': $scope.user.key,
                    'phone': $scope.user.phone,
                    'cubicle' : $scope.show_cubicle ? $scope.user.cubicle : ''
                };

                $http({
                    method: 'POST',
                    url: '/register',
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

                    $window.location.href = "/";

                }, function(response){
                    angular.forEach(response.data,function (data) {
                        console.log(data)
                        for(err in data){
                            alertService.add("danger",data[err]);
                        }
                    });
                    /*$scope.bad_message = response.data.description;
                     $scope.bad_request = true;

                     $timeout(function () {
                     $scope.bad_request = false;
                     $scope.bad_message = '';
                     }, 5000);*/
                });
            }
        });
})();