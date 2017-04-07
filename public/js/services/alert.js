app.factory('alertService', function($rootScope, $window) {
    var alertService = {};

    /*
     * Tipos de alerta:
     * danger
     * success
     * warning
     *
     * Para llamar a una alerta
     * 1) Coloca la directiva uib-alert
     * 2) En el controlador injecta rootScope y alertService
     * 3) En el controlador asigna $scope.alertService = alertService
     * 4) En el controlador alertService.add("success", "Alerta Agregada!");
     */

    $rootScope.alerts = [];
    //$rootScope.alerts = [
    //    { type: 'danger', msg: 'Oh snap! Change a few things up and try submitting again.' },
    //    { type: 'success', msg: 'Well done! You successfully read this important alert message.' }
    //];

    alertService.add = function(type, msg, NoUp) {
        if (NoUp === undefined) {
            $window.scrollTo(0, 0);
        }

        $rootScope.alerts.push({'type': type, 'msg': msg});
    };

    alertService.closeAlert = function(index) {
      $rootScope.alerts.splice(index, 1);
    };

    return alertService;
});
