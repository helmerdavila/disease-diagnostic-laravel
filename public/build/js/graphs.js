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
                colors: ["#3c8dbc", "#f56954", "#00a65a"]
            });
        }); 
    };

    if ($('#diagnostics-by-state').length) {
        $.get('/api/diagnostics-by-state', function(data){
            Morris.Donut({
                element: 'diagnostics-by-state',
                data: data,
                colors: ["#3c8dbc", "#f56954", "#00a65a"]
            });
        }); 
    };

    if ($('#users-by-state').length) {
        $.get('/api/users-by-state', function(data){
            Morris.Donut({
                element: 'users-by-state',
                data: data,
                colors: ["#3c8dbc", "#f56954", "#00a65a"]
            });
        }); 
    };

    if ($('#top-5-user-diagnostics')) {
        $.get('/api/top-users-diagnostics', function(data){
            Morris.Donut({
                element: 'top-5-user-diagnostics',
                data: data,
                colors: ["#3c8dbc", "#f56954", "#00a65a"]
            });
        });
    };

    if ($('#top-5-diagnostic-diseases')) {
        $.get('/api/top-diseases-diagnostics', function(data){
            Morris.Donut({
                element: 'top-5-diagnostic-diseases',
                data: data,
                colors: ["#3c8dbc", "#f56954", "#00a65a"]
            });
        });
    };
});