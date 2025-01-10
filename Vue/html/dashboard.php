<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <h1>Tableau de bord</h1>
    <div>
        <canvas id="ventes30Jours"></canvas>
    </div>
    <div>
        <canvas id="topVendeurs"></canvas>
    </div>
    <div>
        <canvas id="prix30Ventes"></canvas>
    </div>
    <script>
        // Graphique des ventes des 30 derniers jours
        const ventes30JoursCtx = document.getElementById('ventes30Jours').getContext('2d');
        const ventes30JoursChart = new Chart(ventes30JoursCtx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($datesVentes); ?>,
                datasets: [{
                    label: 'Nombre de ventes',
                    data: <?php echo json_encode($nombreVentes); ?>,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Graphique des top vendeurs
        const topVendeursCtx = document.getElementById('topVendeurs').getContext('2d');
        const topVendeursChart = new Chart(topVendeursCtx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($nomsVendeurs); ?>,
                datasets: [{
                    label: 'Nombre de ventes',
                    data: <?php echo json_encode($nombreVentesVendeurs); ?>,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Graphique des prix des 30 dernières ventes
        const prix30VentesCtx = document.getElementById('prix30Ventes').getContext('2d');
        const prix30VentesChart = new Chart(prix30VentesCtx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($titresVentes); ?>,
                datasets: [{
                    label: 'Prix des ventes',
                    data: <?php echo json_encode($prixVentes); ?>,
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>

</html>