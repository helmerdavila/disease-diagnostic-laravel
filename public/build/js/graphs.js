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
Morris.Donut({
    element: 'firstdonut',
    data: [
        { label: 'Enfermedad 1', value: 100 },
        { label: 'Enfermedad 2', value: 1000 },
        { label: 'Enfermedad 5', value: 300 }
    ],
    colors: ["#3c8dbc", "#f56954", "#00a65a"]
});