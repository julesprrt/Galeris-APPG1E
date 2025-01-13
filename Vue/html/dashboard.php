<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Administrateur</title>
    <link rel="stylesheet" href="Vue/CSS/dashboard.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <header class="admin-header">
        <div class="logo-link"> <a href="./"><img src="images/logo.png" class="logo-img"></a></div>
        </a>
        <h1>Tableau de bord Administrateur Galeris</h1>
    </header>
    <div class="container">
        <div class="stats-box">
            <h2>Statistiques Globales</h2>
            <p>Total CA : <?php echo $boxStats['total_revenue']; ?> €</p>
            <p>Moyenne des ventes : <?php echo number_format($boxStats['avg_price'], 2); ?> €</p>
            <p>CA du mois : <?php echo $boxStats['monthly_revenue']; ?> €</p>
        </div>

        <div class="chart-row">
            <div class="chart-card">
                <h2>Ventes (30 jours)</h2>
                <canvas id="ventes30Jours"></canvas>
            </div>
            <div class="chart-card">
                <h2>Top vendeurs</h2>
                <canvas id="topVendeurs"></canvas>
            </div>
        </div>

        <div class="chart-row">
            <div class="chart-card">
                <h2>Prix (30 dernières ventes)</h2>
                <canvas id="prix30Ventes"></canvas>
            </div>
            <div class="chart-card">
                <h2>Inscriptions (30 jours)</h2>
                <canvas id="userInscriptions"></canvas>
            </div>
        </div>


        <div class="chart-row">
            <div class="chart-card">
                <h2>Expositions</h2>
                <canvas id="expositionStatus"></canvas>
            </div>
            <div class="chart-card">
                <h2>Status des ventes</h2>
                <canvas id="venteStatus"></canvas>
            </div>
        </div>


        <div class="chart-row">
            <div class="chart-card">
                <h2>Livraisons par Ville</h2>
                <canvas id="villesChart"></canvas>
            </div>
            <div class="chart-card">
                <h2>Catégories d'œuvres</h2>
                <canvas id="categorieChart"></canvas>
            </div>
        </div>
    </div>
    <!-- Script Chart.js pour initialiser les 8 graphiques -->
    <script>
        const ventes30JoursCtx = document.getElementById('ventes30Jours').getContext('2d');
        new Chart(ventes30JoursCtx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($datesVentes); ?>,
                datasets: [{
                    label: 'Nombre de ventes',
                    data: <?php echo json_encode($nombreVentes); ?>,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: false
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


        const topVendeursCtx = document.getElementById('topVendeurs').getContext('2d');
        new Chart(topVendeursCtx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($nomsVendeurs); ?>,
                datasets: [{
                    label: 'Nombre de ventes',
                    data: <?php echo json_encode($nombreVentesVendeurs); ?>,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 2
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


        const prix30VentesCtx = document.getElementById('prix30Ventes').getContext('2d');
        new Chart(prix30VentesCtx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($titresVentes); ?>,
                datasets: [{
                    label: 'Prix des ventes',
                    data: <?php echo json_encode($prixVentes); ?>,
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 2
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


        const userInscriptionsCtx = document.getElementById('userInscriptions').getContext('2d');
        new Chart(userInscriptionsCtx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($inscriptionDates); ?>,
                datasets: [{
                    label: 'Nouvelles inscriptions',
                    data: <?php echo json_encode($inscriptionCounts); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
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

        const expositionStatusCtx = document.getElementById('expositionStatus').getContext('2d');
        new Chart(expositionStatusCtx, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($statutLabels); ?>,
                datasets: [{
                    data: <?php echo json_encode($statutCounts); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(75, 192, 192, 0.6)'
                    ],
                    borderColor: '#fff',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                cutout: '50%'
            }
        });

        const venteStatusCtx = document.getElementById('venteStatus').getContext('2d');
        new Chart(venteStatusCtx, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($venteStatusLabels); ?>,
                datasets: [{
                    data: <?php echo json_encode($venteStatusValues); ?>,
                    backgroundColor: [
                        'rgba(75,192,192,0.7)',
                        'rgba(255,99,132,0.7)'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true
            }
        });

        const villesCtx = document.getElementById('villesChart').getContext('2d');
        new Chart(villesCtx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($villeLabels); ?>,
                datasets: [{
                    label: 'Nombre de livraisons',
                    data: <?php echo json_encode($villeValues); ?>,
                    backgroundColor: 'rgba(153, 102, 255, 0.3)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 2
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

        const categorieCtx = document.getElementById('categorieChart').getContext('2d');
        new Chart(categorieCtx, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($categorieLabels); ?>,
                datasets: [{
                    label: "Catégories d'œuvres",
                    data: <?php echo json_encode($categorieValues); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)'

                    ],
                    borderColor: '#fff',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                cutout: '50%'
            }
        });
    </script>

    <footer>
        <p>© 2025 - Galeris</p>
    </footer>
</body>

</html>