$(function(){
    Morris.Area({
        element: 'firstchart',
        data: [
            { y: '2006', a: 100, b: 90 },
            { y: '2007', a: 75,  b: 65 },
            { y: '2008', a: 50,  b: 40 },
            { y: '2009', a: 75,  b: 65 },
            { y: '2010', a: 50,  b: 40 },
            { y: '2011', a: 75,  b: 65 },
            { y: '2012', a: 100, b: 90 }
        ],
        lineColors : ['#dd4b39', '#f39c12'],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Series A', 'Series B']
    });

    // obtener los valores desde /api/all-diseases
    $.get('/api/all-diseases', function(data){
        Morris.Donut({
            element: 'firstdonut',
            data: data,
            colors: ["#3c8dbc", "#f56954", "#00a65a"]
        });
    });
});