import Chart from 'chart.js/auto';

class RatingChart {
    constructor() {
        const canvas = document.getElementById('ratingChart');

        if (!canvas) {
            return;
        }

        
        
        const labels = JSON.parse(canvas.dataset.labels);
        const data = JSON.parse(canvas.dataset.values);

        console.log(data);

        this.chart = new Chart(canvas, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Rating',
                    data: data,
                    borderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: false
                    }
                }
            }
        });
    }

    setData(labels, data) {
        this.chart.data.labels = labels;
        this.chart.data.datasets[0].data = data;
        this.chart.update();
    }

    destroy() {
        this.chart?.destroy();
    }
}

new RatingChart();