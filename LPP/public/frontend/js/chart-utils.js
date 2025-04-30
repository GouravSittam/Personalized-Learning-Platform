// Chart Utilities
class ChartUtils {
    static createProgressChart(container, data, options = {}) {
        const canvas = document.createElement('canvas');
        container.appendChild(canvas);

        const ctx = canvas.getContext('2d');
        const defaultOptions = {
            type: 'doughnut',
            data: {
                labels: ['Completed', 'Remaining'],
                datasets: [{
                    data: [data.completed, data.total - data.completed],
                    backgroundColor: [
                        options.color || '#007bff',
                        '#e9ecef'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = data.total;
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        };

        return new Chart(ctx, { ...defaultOptions, ...options });
    }

    static createTimelineChart(container, data, options = {}) {
        const canvas = document.createElement('canvas');
        container.appendChild(canvas);

        const ctx = canvas.getContext('2d');
        const defaultOptions = {
            type: 'line',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Progress',
                    data: data.values,
                    borderColor: options.color || '#007bff',
                    backgroundColor: 'rgba(0, 123, 255, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        };

        return new Chart(ctx, { ...defaultOptions, ...options });
    }

    static createSkillChart(container, data, options = {}) {
        const canvas = document.createElement('canvas');
        container.appendChild(canvas);

        const ctx = canvas.getContext('2d');
        const defaultOptions = {
            type: 'radar',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Current Level',
                    data: data.currentLevels,
                    backgroundColor: 'rgba(0, 123, 255, 0.2)',
                    borderColor: '#007bff',
                    pointBackgroundColor: '#007bff',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: '#007bff'
                }, {
                    label: 'Target Level',
                    data: data.targetLevels,
                    backgroundColor: 'rgba(40, 167, 69, 0.2)',
                    borderColor: '#28a745',
                    pointBackgroundColor: '#28a745',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: '#28a745'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    r: {
                        beginAtZero: true,
                        max: 5
                    }
                }
            }
        };

        return new Chart(ctx, { ...defaultOptions, ...options });
    }
} 