app.factory('userService', function($rootScope, $window, $localStorage) {
    var userService = {};

    userService.setUser = function(user) {
        /*
         * Reset user info
         */
        try {
            $localStorage.$reset();

        } catch(e) {

        }

        $rootScope.$storage = $localStorage.$default({
            user : user
        });
    };

    userService.removeUser = function(){
        delete $localStorage.user;
    };

    userService.getUser = function(){
        /*
         * Check if there is a user
         */
        if($localStorage.user !== undefined){
            return $localStorage.user;
        }

        /*
         * If nothing was returned then
         * we must redirect the user
         * to the login page
         */
        $localStorage.$reset();
        $window.location.href = "/logout";

    };

    return userService;

});
