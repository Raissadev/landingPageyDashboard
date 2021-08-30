<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
var ctx = document.getElementById('myChart').getContext("2d");
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["JAN", "FEB"],
        datasets: [{
            label: "Total",
            borderColor: "#0a58ca",
            pointBorderColor: "#0a58ca",
            pointBackgroundColor: "#0a58ca",
            pointHoverBackgroundColor: "#0a58ca",
            pointHoverBorderColor: "#0a58ca",
            pointBorderWidth: 5,
            pointHoverRadius: 5,
            pointHoverBorderWidth: 1,
            pointRadius: 3,
            fill: false,
            borderWidth: 1,
            data: [0, <?php echo $pegarVisitasTotais; ?>]
        }]
    },
    options: {
        scales: {
        yAxes: [{
            gridLines: {
                display:false
            }
        }], 
    }
}
});
</script>


<script>
var ctx = document.getElementById('chartRadial').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: [''],
        datasets: [{
            label: 'Total de Usuários Online',
            data: [12, 50],
            backgroundColor: [
                '#6a62cc',
                '#0a58ca'
            ],
            borderColor: [
                'transparent'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
        xAxes: [{
            gridLines: {
                display:false
            }
        }]
    }
}
});

</script>