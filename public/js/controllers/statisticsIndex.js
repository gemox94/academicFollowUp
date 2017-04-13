(function(){
    angular.module('academic')
        .controller('statisticsIndexCtrl', statisticsIndexCtrl);

    function statisticsIndexCtrl($scope, $http, userService){
        var user = userService.getUser();


        var trace1 = {
            y:[],
            x: [],
            type: 'bar',
            orientation: 'h'
        };

        var data = [trace1];
        var layout = {
            title: 'Calificaciones',
            showlegend: false};
        //Plotly.newPlot('plot', data, layout, {displayModeBar: true});

        $http({
            method: 'POST',
            url: '/api/statistics',
            data: {teacher_id: user.id}
        }).then(function (value) {
            console.log(value.data);
            $scope.subjects = value.data;
        }, function (error) {
            console.log(error);
        });

        $scope.clearPlot = function(){
            Plotly.purge('plot');
            $scope.selectedSubject = undefined;
            $scope.filter = undefined;
        };

        var i;
        $scope.updateFilter = function(){
            trace1.y = [];
            trace1.x = [];
            i = 1;
            if($scope.selectedSubject !== undefined && $scope.filter !== undefined){
                angular.forEach($scope.subjects, function(value, key){
                    if(value[$scope.filter].length !== 0){
                        angular.forEach(value[$scope.filter], function (val) {
                            if(key === $scope.selectedSubject.subject_nrc){
                                //console.log(val);
                                trace1.y.push(val.student.name);
                                trace1.x.push(val.final_grade);
                                i++;
                            }
                        });
                    }else{
                        trace1.y.push(0);
                    }
                });
                Plotly.newPlot('plot', data, layout, {displayModeBar: true});
            }
        };
        
    }

})();