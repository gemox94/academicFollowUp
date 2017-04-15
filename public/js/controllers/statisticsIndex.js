(function(){
    angular.module('academic')
        .controller('statisticsIndexCtrl', statisticsIndexCtrl)
        .controller('StatisticsSectionCtrl', StatisticsSectionCtrl);

    function StatisticsSectionCtrl($scope, $http, userService){
        var user        = userService.getUser();
        $scope.subjects = [];

        var trace1 = {
            y:[],
            x: [],
            type: 'bar',
            orientation: 'v'
        };

        var data = [trace1];

        var layout = {
            title: 'Calificaciones',
            showlegend: false,
            yaxis: {
                title: 'Alumnos',
                titlefont: {
                  family: 'Courier New, monospace',
                  size: 18,
                  color: '#7f7f7f'
                }
            }
        };


        /*
         * Load the all sections
         */
        $http({
            method: 'GET',
            url: '/api/statistics/section'

        }).then(function (value) {
            console.log(value.data);
            $scope.subjects = value.data;

        }, function (error) {
            console.log(error);
        });


        /*
         * Clear the plot
         */
        $scope.clearPlot = function(){
            Plotly.purge('plot');
            $scope.selectedSubject = undefined;
            $scope.filter = undefined;
        };


        var i;
        $scope.updateFilter = function(){
            trace1.y = [];
            trace1.x = [];
            i        = 1;

            if($scope.selectedSubject !== undefined && $scope.filter !== undefined){
                /*
                 * 1 Step
                 * Get the subject according to the NRC - selectedSubject.subject_nrc
                 */
                var subjectToPlot = $scope.subjects[$scope.selectedSubject.subject_nrc];

                /*
                 * 2 Step
                 * Get the correct filter for this subject
                 */
                var filterToPlot = subjectToPlot[$scope.filter];

                /*
                 * 3 Step
                 * Get the number of students in this filter to plot
                 */
                var studentNumberToPlot = filterToPlot.length;

                /*
                 * 4 Step
                 * Fix the yAxis to get integer numbers
                 */
                layout.yaxis.range =  [0, studentNumberToPlot + 2];

                /*
                 * 5 Step
                 * Plot both axis
                 */
                trace1.y.push(studentNumberToPlot);
                trace1.x.push($scope.filter.toString());

                Plotly.newPlot('plot', data, layout, {displayModeBar: true});
            }
        };

    };

    function statisticsIndexCtrl($scope, $http, userService){
        var user = userService.getUser();


        var trace1 = {
            y:[],
            x: [],
            type: 'bar',
            orientation: 'v'
        };

        var data = [trace1];

        var layout = {
            title: 'Calificaciones',
            showlegend: false,
            yaxis: {
                title: 'Alumnos',
                titlefont: {
                  family: 'Courier New, monospace',
                  size: 18,
                  color: '#7f7f7f'
                }
            }
        };

// :DELETE: Example Code
        //Plotly.newPlot('plot', data, layout, {displayModeBar: true});

        $http({
            method: 'POST',
            url: '/api/statistics',
            data: {
                teacher_id: user.id
            }

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
            i        = 1;

            if($scope.selectedSubject !== undefined && $scope.filter !== undefined){
                /*
                 * 1 Step
                 * Get the subject according to the NRC - selectedSubject.subject_nrc
                 */
                var subjectToPlot = $scope.subjects[$scope.selectedSubject.subject_nrc];

                /*
                 * 2 Step
                 * Get the correct filter for this subject
                 */
                var filterToPlot = subjectToPlot[$scope.filter];

                /*
                 * 3 Step
                 * Get the number of students in this filter to plot
                 */
                var studentNumberToPlot = filterToPlot.length;

                /*
                 * 4 Step
                 * Fix the yAxis to get integer numbers
                 */
                layout.yaxis.range =  [0, studentNumberToPlot + 2];

                /*
                 * 5 Step
                 * Plot both axis
                 */
                trace1.y.push(studentNumberToPlot);
                trace1.x.push($scope.filter.toString());

                Plotly.newPlot('plot', data, layout, {displayModeBar: true});
            }
        };

    };

})();
