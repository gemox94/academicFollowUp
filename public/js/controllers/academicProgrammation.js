app.controller('AcademicProgramamtionCtrl', function($scope, $http, alertService, userService, DTOptionsBuilder, DTColumnDefBuilder, DTColumnBuilder){
    $scope.loged_user   = userService.getUser();
    $scope.alertService = alertService;
    $scope.subjects     = [];

    /*
     * Ask for all subjects info
     */
    $http.get('/api/coordinator/subjects')
       .then(function(response){
           console.log(response);
           $scope.subjects = response.data;

       }, function(error_response){
           console.log('error', error_response);
       });

    $scope.dtOptions = DTOptionsBuilder.newOptions()
        .withDisplayLength(10)
        .withOption("oLanguage", {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }).withColumnFilter({
            aoColumns: [
                {
                    type: 'text',
                    bRegex: true,
                    bSmart: true
                },
                {
                    type: 'text',
                    bRegex: true,
                    bSmart: true
                },
                {
                    type: 'text',
                    bRegex: true,
                    bSmart: true
                },
                {
                    type: 'text',
                    bRegex: true,
                    bSmart: true
                },
                {
                    type: 'text',
                    bRegex: true,
                    bSmart: true
                },
                {
                    type: 'text',
                    bRegex: true,
                    bSmart: true
                }
                //{
                //    type: 'select',
                //    bRegex: false,
                //    values: ['Yoda', 'Titi', 'Kyle', 'Bar', 'Whateveryournameis']
                //}
            ]
        });

    //$scope.dtColumns = [
    //    DTColumnBuilder.newColumn('id').withTitle('Nombre'),
    //    DTColumnBuilder.newColumn('firstName').withTitle('NRC'),
    //    DTColumnBuilder.newColumn('lastName').withTitle('Sección'),
    //    DTColumnBuilder.newColumn('lastName').withTitle('Clave'),
    //    DTColumnBuilder.newColumn('lastName').withTitle('Horario'),
    //    DTColumnBuilder.newColumn('lastName').withTitle('Periodo')
    //];
});
