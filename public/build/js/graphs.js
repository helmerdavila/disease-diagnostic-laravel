$(function(){
    // obtener los valores de /api/two-top

    if ($('#firstchart').length) {
        $.get('/api/two-top', function(data){
            Morris.Line({
                element: 'firstchart',
                data: data.result,
                lineColors : ['#dd4b39', '#f39c12'],
                xkey: 'month',
                ykeys: ['first', 'second'],
                labels: data.names
            });
        }); 
    };

    if ($('#firstdonut').length) {
        // obtener los valores desde /api/all-diseases
        $.get('/api/all-diseases', function(data){
            Morris.Donut({
                element: 'firstdonut',
                data: data,
                colors: ["#18576E", "#f56954", "#18bc9c"]
            });
        }); 
    };

     if ($('#anual-disease-diagnostics').length) {
        $('#anual-disease').change(function(){
            var selectDisease = $('#anual-disease').val();
            $.get('/api/anual-disease-diagnostics/' + selectDisease, function(data){
                // usado para limpiar la pantalla, causa divs fantasmas
                $('#anual-disease-diagnostics').empty();
                Morris.Line({
                    element: 'anual-disease-diagnostics',
                    data: data.result,
                    lineColors : ['#dd4b39', '#f39c12'],
                    xkey: 'month',
                    ykeys: ['first'],
                    labels: data.names
                });
            }); 
        });
    };

    if ($('#anual-state-diagnostics').length) {
        $('#anual-state').change(function(){
            var selectState = $('#anual-state').val();
                $.get('/api/anual-state-diagnostics/' + selectState, function(data){
                    // usado para limpiar la pantalla, causa divs fantasmas
                    $('#anual-state-diagnostics').empty();
                    Morris.Line({
                        element: 'anual-state-diagnostics',
                        data: data.result,
                        lineColors : ['#dd4b39', '#f39c12', "#18576E", '#f56954', "#18bc9c"],
                        xkey: 'month',
                        ykeys: data.indexs,
                        labels: data.names
                    });
                }); 
        });
    };

    if ($('#diagnostics-by-state').length) {
        $.get('/api/diagnostics-by-state', function(data){
            Morris.Donut({
                element: 'diagnostics-by-state',
                data: data,
                colors: ["#18576E", "#f56954", "#18bc9c"]
            });
        }); 
    };

    if ($('#users-by-state').length) {
        $.get('/api/users-by-state', function(data){
            Morris.Donut({
                element: 'users-by-state',
                data: data,
                colors: ["#18576E", "#f56954", "#18bc9c"]
            });
        }); 
    };

    if ($('#top-5-user-diagnostics').length) {
        $.get('/api/top-users-diagnostics', function(data){
            Morris.Donut({
                element: 'top-5-user-diagnostics',
                data: data,
                colors: ["#18576E", "#f56954", "#18bc9c"]
            });
        });
    };

    if ($('#top-5-diagnostic-diseases').length) {
        $.get('/api/top-diseases-diagnostics', function(data){
            Morris.Donut({
                element: 'top-5-diagnostic-diseases',
                data: data,
                colors: ["#18576E", "#f56954", "#18bc9c"]
            });
        });
    };

    if ($('#user-diseases').length) {
        // obtener los valores desde /api/user-diseases
        $.get('/api/user-diseases', function(data){
            Morris.Donut({
                element: 'user-diseases',
                data: data,
                colors: ["#18576E", "#f56954", "#18bc9c"]
            });
        }); 
    };
});