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
        Plotly.newPlot('plot', data, layout, {displayModeBar: true});

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

        var i;
        $scope.updateFilter = function(){
            switch ($scope.filter){

                case 'passed':
                    if($scope.selectedSubject !== undefined){
                        i = 1;
                        angular.forEach($scope.subjects, function(value, key){
                            if(value[$scope.filter].length !== 0){
                                angular.forEach(value[$scope.filter], function (val) {
                                    if(key === $scope.selectedSubject.subject_nrc){
                                        //console.log(val);
                                        trace1.y.push(i);
                                        trace1.x.push(val.final_grade);
                                        i++;
                                    }
                                });
                            }
                        });
                        Plotly.newPlot('plot', data, layout, {displayModeBar: true});
                    }

                case 'failed':
                    if($scope.selectedSubject !== undefined){
                        i = 1;
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
                            }
                        });
                        Plotly.newPlot('plot', data, layout, {displayModeBar: true});
                    }
                    break;

                case 'l_5':
                    if($scope.selectedSubject !== undefined){
                        i = 1;
                        angular.forEach($scope.subjects, function(value, key){
                            if(value[$scope.filter].length !== 0){
                                angular.forEach(value[$scope.filter], function (val) {
                                    if(key === $scope.selectedSubject.subject_nrc){
                                        //console.log(val);
                                        trace1.y.push(i);
                                        trace1.x.push(val.final_grade);
                                        i++;
                                    }
                                });
                            }
                        });
                        Plotly.newPlot('plot', data, layout, {displayModeBar: true});
                    }
                    break;


                case 'e_6':
                    if($scope.selectedSubject !== undefined){
                        i = 1;
                        angular.forEach($scope.subjects, function(value, key){
                            if(value[$scope.filter].length !== 0){
                                angular.forEach(value[$scope.filter], function (val) {
                                    if(key === $scope.selectedSubject.subject_nrc){
                                        //console.log(val);
                                        trace1.y.push(i);
                                        trace1.x.push(val.final_grade);
                                        i++;
                                    }
                                });
                            }
                        });
                        Plotly.newPlot('plot', data, layout, {displayModeBar: true});
                    }
                    break;


                case 'e_7':
                    if($scope.selectedSubject !== undefined){
                        i = 1;
                        angular.forEach($scope.subjects, function(value, key){
                            if(value[$scope.filter].length !== 0){
                                angular.forEach(value[$scope.filter], function (val) {
                                    if(key === $scope.selectedSubject.subject_nrc){
                                        //console.log(val);
                                        trace1.y.push(i);
                                        trace1.x.push(val.final_grade);
                                        i++;
                                    }
                                });
                            }
                        });
                        Plotly.newPlot('plot', data, layout, {displayModeBar: true});
                    }
                    break;


                case 'e_8':
                    if($scope.selectedSubject !== undefined){
                        i = 1;
                        angular.forEach($scope.subjects, function(value, key){
                            if(value[$scope.filter].length !== 0){
                                angular.forEach(value[$scope.filter], function (val) {
                                    if(key === $scope.selectedSubject.subject_nrc){
                                        //console.log(val);
                                        trace1.y.push(i);
                                        trace1.x.push(val.final_grade);
                                        i++;
                                    }
                                });
                            }
                        });
                        Plotly.newPlot('plot', data, layout, {displayModeBar: true});
                    }
                    break;


                case 'e_9':
                    if($scope.selectedSubject !== undefined){
                        i = 1;
                        angular.forEach($scope.subjects, function(value, key){
                            if(value[$scope.filter].length !== 0){
                                angular.forEach(value[$scope.filter], function (val) {
                                    if(key === $scope.selectedSubject.subject_nrc){
                                        //console.log(val);
                                        trace1.y.push(i);
                                        trace1.x.push(val.final_grade);
                                        i++;
                                    }
                                });
                            }
                        });
                        Plotly.newPlot('plot', data, layout, {displayModeBar: true});
                    }
                    break;


                case 'e_10':
                    if($scope.selectedSubject !== undefined){
                        i = 1;
                        angular.forEach($scope.subjects, function(value, key){
                            if(value[$scope.filter].length !== 0){
                                angular.forEach(value[$scope.filter], function (val) {
                                    if(key === $scope.selectedSubject.subject_nrc){
                                        //console.log(val);
                                        trace1.y.push(i);
                                        trace1.x.push(val.final_grade);
                                        i++;
                                    }
                                });
                            }
                        });
                        Plotly.newPlot('plot', data, layout, {displayModeBar: true});
                    }
                    break;

            }
        };
        
    }

})();