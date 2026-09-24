document.addEventListener('DOMContentLoaded', function () {
    const chartElement = document.getElementById('todayVisitsChart');

    if (!chartElement) {
        return;
    }

    const dashboardData = window.petugasDashboardData || {};

    const todayVisitsByHour = dashboardData.todayVisitsByHour || [];

    const labels = todayVisitsByHour.map(function (item) {
        return item.hour;
    });

    const values = todayVisitsByHour.map(function (item) {
        return Number(item.total ?? 0);
    });

    new Chart(chartElement, {
        type: 'line',

        data: {
            labels: labels,

            datasets: [
                {
                    label: 'Kunjungan',
                    data: values,
                    borderWidth: 2,
                    tension: 0.35,
                    fill: true
                }
            ]
        },

        options: {
            responsive: true,

            maintainAspectRatio: false,

            scales: {
                y: {
                    beginAtZero: true,

                    ticks: {
                        precision: 0
                    }
                }
            },

            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
});