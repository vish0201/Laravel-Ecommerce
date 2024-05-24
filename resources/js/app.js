import axios from 'axios';
import './bootstrap';
import Chart from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', function () {
    // Function to fetch and update user chart data
    function updateUserChart() {
        axios.get('/user/get-user-data')
            .then(function (response) {
                const userData = response.data; // Assuming the response contains user data
                updateChart(userData);
                console.log(userData);
            })
            .catch(function (error) {
                console.error('Error fetching user data:', error);
            });
    }

    // Function to update the chart with new data
    function updateChart(userData) {
        var ctx = document.getElementById('userChart').getContext('2d');
        var userChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: Object.keys(userData),
                datasets: [{
                    label: '# of Users',
                    data: Object.values(userData),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
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
    }

    // Call updateUserChart function to initially update user chart
    updateUserChart();
});
