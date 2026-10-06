import Chart from 'chart.js/auto';

class RatingChart {
    constructor() {
        this.chart = null;

        this.init();

        document.addEventListener('livewire:init', () => {
            Livewire.hook('morph.added', ({ el }) => {
                if (el.id === 'ratingChart') {
                    this.init();
                }
            });
        });        

    }

    init() {
        const canvas = document.getElementById('ratingChart');

        if (!canvas) {
            return;
        }

        if (this.chart) {
            this.chart.destroy();
        }        

        const labels = JSON.parse(canvas.dataset.labels);
        const data = JSON.parse(canvas.dataset.values);

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
}

new RatingChart();