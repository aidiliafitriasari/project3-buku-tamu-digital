document.addEventListener('DOMContentLoaded', function () {

    const data = window.adminDashboardData || {};

    const rootStyles = getComputedStyle(document.documentElement);

    const primaryColor =
        rootStyles.getPropertyValue('--amins-blue').trim() || '#00309F';


    // CHART 1 — KUNJUNGAN PER DEPARTEMEN (BAR)
    const departmentData = data.visitsByDepartment || [];

    const departmentCanvas =
        document.getElementById('departmentVisitsChart');

    if (departmentCanvas && departmentData.length > 0) {

        const departmentLabels = departmentData.map(
            item => item.department_name
        );

        const departmentTotals = departmentData.map(
            item => Number(item.total)
        );

        new Chart(departmentCanvas, {
            type: 'bar',

            data: {
                labels: departmentLabels,

                datasets: [{
                    label: 'Jumlah Kunjungan',
                    data: departmentTotals,

                    backgroundColor: primaryColor,
                    borderRadius: 8,
                    borderSkipped: false,

                    maxBarThickness: 42
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        display: false
                    },

                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return ' ' + context.parsed.y + ' kunjungan';
                            }
                        }
                    }
                },

                scales: {
                    x: {
                        grid: {
                            display: false
                        },

                        ticks: {
                            color: '#64748b'
                        }
                    },

                    y: {
                        beginAtZero: true,

                        ticks: {
                            precision: 0,
                            color: '#64748b'
                        },

                        grid: {
                            color: 'rgba(148, 163, 184, 0.15)'
                        }
                    }
                }
            }
        });
    }


    // CHART 2 — GRAFIK HARIAN (LINE)
    const dailyData = data.dailyVisits || [];

    const dailyCanvas =
        document.getElementById('dailyVisitsChart');

    if (dailyCanvas && dailyData.length > 0) {

        const dailyLabels = dailyData.map(item => {
            const date = new Date(item.date + 'T00:00:00');

            return date.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'short'
            });
        });

        const dailyTotals = dailyData.map(
            item => Number(item.total)
        );

        new Chart(dailyCanvas, {
            type: 'line',

            data: {
                labels: dailyLabels,

                datasets: [{
                    label: 'Jumlah Kunjungan',
                    data: dailyTotals,

                    borderColor: primaryColor,
                    backgroundColor: 'rgba(0, 48, 159, 0.08)',

                    borderWidth: 2,

                    pointBackgroundColor: primaryColor,
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,

                    pointRadius: 4,
                    pointHoverRadius: 6,

                    tension: 0.35,

                    fill: true
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        display: false
                    },

                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return ' ' + context.parsed.y + ' kunjungan';
                            }
                        }
                    }
                },

                scales: {
                    x: {
                        grid: {
                            display: false
                        },

                        ticks: {
                            color: '#64748B'
                        }
                    },

                    y: {
                        beginAtZero: true,

                        ticks: {
                            precision: 0,
                            color: '#64748B'
                        },

                        grid: {
                            color: 'rgba(148, 163, 184, 0.15)'
                        }
                    }
                }
            }
        });
    }


    // CHART 3 — JAM TERPADAT (BAR)
    const hourlyData = data.visitsByHour || [];

    const hourlyCanvas =
        document.getElementById('visitsByHourChart');

    if (hourlyCanvas && hourlyData.length > 0) {

        const hourlyLabels = hourlyData.map(
            item => item.hour
        );

        const hourlyTotals = hourlyData.map(
            item => Number(item.total)
        );

        new Chart(hourlyCanvas, {
            type: 'bar',

            data: {
                labels: hourlyLabels,

                datasets: [{
                    label: 'Jumlah Kunjungan',

                    data: hourlyTotals,

                    backgroundColor: primaryColor,

                    borderRadius: 7,

                    borderSkipped: false,

                    maxBarThickness: 22
                }]
            },

            options: {
                responsive: true,

                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        display: false
                    },

                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return ' ' +
                                    context.parsed.y +
                                    ' kunjungan';
                            }
                        }
                    }
                },

                scales: {
                    x: {
                        grid: {
                            display: false
                        },

                        ticks: {
                            color: '#64748B',

                            maxRotation: 0,

                            autoSkip: true,

                            maxTicksLimit: 8
                        }
                    },

                    y: {
                        beginAtZero: true,

                        ticks: {
                            precision: 0,

                            color: '#64748B'
                        },

                        grid: {
                            color: 'rgba(148, 163, 184, 0.15)'
                        }
                    }
                }
            }
        });
    }

});