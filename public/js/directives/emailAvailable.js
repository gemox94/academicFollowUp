app.directive('emailAvailable', function($timeout, $q, $http) {
  return {
    restrict: 'AE',
    require: 'ngModel',
    link: function(scope, elm, attr, model) {
      model.$asyncValidators.emailExists = function() {
        var deferred = $q.defer();

          return $http.post('/auth/emailExists', {
                email: model.$viewValue

            }).then(function(response){
                  if (response.data.exists) {
                    // USUARIO EXISTE
                    deferred.reject();

                  }else{
                    deferred.resolve();
                  }

                  return deferred.promise;

            });
      };
    }
  }
});
