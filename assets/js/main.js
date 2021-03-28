
jQuery(document).ready(function($) {
    
    var data = {
        datasets: [{
            data: [],
            backgroundColor: ['red', 'blue', 'green']

        }],
        labels: [],
    }

    try {

        loginsData.forEach(element => {
            data.datasets[0].data.push( element.count );
            data.labels.push( element.type );
    
        });
        var ctx = document.getElementById('loginsChart');
    
    
    
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: data,
        });
    } catch(e) {

    }


})