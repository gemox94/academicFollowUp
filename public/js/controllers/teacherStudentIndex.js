(function () {
   angular.module('academic')
       .controller('teacherStudentIndexCtrl', teacherStudentIndexCtrl)
       .controller('StudentInfoModalCtrl', StudentInfoModalCtrl);

   function teacherStudentIndexCtrl($scope, $http, $uibModal, alertService){
       $scope.alertService = alertService;

       $scope.studentInfo = function(student){
           var modalInstance = $uibModal.open({
               animation: true,
               ariaLabelledBy: 'modal-title',
               ariaDescribedBy: 'modal-body',
               templateUrl: 'studentInfoModal.html',
               controller: 'StudentInfoModalCtrl',
               size: 'lg',
               resolve: {
                   student: function () {
                       return student;
                   }
               }
           });

           modalInstance.result.then(function () {
           }, function () {
           });
       };
   }

    function StudentInfoModalCtrl($scope, $uibModalInstance, student) {
        console.log(student);
        $scope.student = student;
        $scope.subjects = student.teacher_subjects;

        $scope.ok = function(){
           $uibModalInstance.close();
        };

        $scope.cancel = function(){
           $uibModalInstance.dismiss();
        };

   }
})();