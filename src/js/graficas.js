document.addEventListener('DOMContentLoaded', function(){
    iniciarApp();
});

function iniciarApp(){
    consultarApi();
    
}

function consultarApi(){
    fetch('/api/graficas') // Reemplaza 'URL_DE_TU_API' con la URL de tu API
                .then(response => response.json())
                .then(data => {
                    // Suponiendo que la API devuelve un array de datos, por ejemplo: [{ label: 'Enero', value: 10 }, { label: 'Febrero', value: 20 }, ...]
                    const labels = data.map(item => item.producto);
                    const values = data.map(item => item.total);

                    const ctx = document.getElementById('myChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Datos desde la API',
                                data: values,
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
                })
                .catch(error => {
                    console.error('Error al obtener los datos:', error);
                });
        

}