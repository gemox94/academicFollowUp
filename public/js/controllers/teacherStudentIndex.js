(function () {
   angular.module('academic')
       .controller('teacherStudentIndexCtrl', teacherStudentIndexCtrl);

   function teacherStudentIndexCtrl($scope, $http, alertService){
       $scope.alertService = alertService;

   }
})();