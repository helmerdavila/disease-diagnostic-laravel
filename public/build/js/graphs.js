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


});