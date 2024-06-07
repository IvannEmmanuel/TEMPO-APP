$(document).ready(function() {
    $('#weatherSearchForm').submit(function(e) {
        e.preventDefault(); // Prevent form submission

        var location = $('#location').val(); // Get the location from the input field

        // Send an Ajax request to the server
        $.ajax({
            url: '/weather',
            method: 'GET',
            headers: {
                'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiNjM3ZjViNDExYTNkNmUyNDA2MmRjMDVmOGVhZDk1ODIzMTRkZGViMzdhYmUxN2NiMDFmYzJjMDdkZGViOTNiNzQyNGIyZDEwMWE4OGE5MWEiLCJpYXQiOjE3MTc0NjU3MjQuMzQ1NzQzLCJuYmYiOjE3MTc0NjU3MjQuMzQ1NzQ4LCJleHAiOjE3NDkwMDE3MjMuOTMxMjc2LCJzdWIiOiIiLCJzY29wZXMiOltdfQ.hy1AgKGEM9x4_xwBhn-MAvFXWds4jlfOXY5xfRyG7mDL8UfPy1w382We2Yk9zBJay2Wsfni8zmw5bUJOl4LkZja7AmRD-20RxdY-a4HNPFrJEIcWzgaPFmLQOzKzhXivFi_5N6GFKGYuwWGTSjnDebib0LEj4SP7jVWJ5Y7kZmwSiQuWXandCFRE7SEUJRLjp9DOfyAJ5MkKD1FEQ-8TYXGVSFneyiyMx9trjZvNkcXRSW_DQBOUrqFeCq872JgICEecAJMs9SlyKuss5iq6gVCNC_QnwXWrY7L9YXVtx_lrQUKPgakRep7qQLykC-8Py3uW4kR4dhZ0VEU4a1PaB42nGkaQFkMDd-zUE321AEm-X2wZwzYM6TQPsIJnedUtEce2PaoRqT8iO7vKEtJLDWLu9qZUYV41J0kvcnHX_DUK1RWE80hAgTAmT57tOCryn2ZA9knJ4UQmC_coLvoslqOz8pYtcjoctRgV5ucI5hoE9yRk7EY2uQ-MHXZ1BngYB58SmGYQil2KTpIlKulkYl-BazGTjGJGgZu5_OkivXwlTXUEgfZkGTyoMn0FFjUFbyKGQdfTTL1Vd6bhbnavveyw3qcE5Ao_4h63qZ9Poofol2OZThYm2MREp01V2MR7Es8lMFh612T2HAOjUWRzqdSeksDdeuLV50MAHjqnw50' // Replace with your actual access token
            },
            data: { location: location },
            success: function(response) {
                console.log('Response from server:', response); // Log the response
                displayResults(response); // Call a function to display the results
                $('#weatherResults').css('background-color', '#A3CDE5'); // Change background color after receiving results
            },
            error: function(xhr, status, error) {
                console.error('Error:', xhr.responseText); // Log any errors to the console
                $('#weatherResults').html('Failed to fetch weather data.');
            }
        });
    });

    // Function to display search results
    function displayResults(results) {
        var weatherResultsDiv = $('#weatherResults');
        weatherResultsDiv.empty(); // Clear previous results

        try {
            var result = typeof results === 'string' ? JSON.parse(results) : results; // Parse the JSON response if it's a string
            var weatherInfo = `
                <ul>
                    <li><strong>Location:</strong> ${result.location.name}, ${result.location.region}, ${result.location.country}</li>
                    <li><strong>Temperature:</strong> ${result.current.temp_c}°C</li>
                    <li><strong>Condition:</strong> ${result.current.condition.text}</li>
                    <li><strong>Wind:</strong> ${result.current.wind_kph} kph</li>
                    <li><strong>Humidity:</strong> ${result.current.humidity}%</li>
                    <li><strong>Sunrise:</strong> ${result.forecast.forecastday[0].astro.sunrise}</li>
                    <li><strong>Sunset:</strong> ${result.forecast.forecastday[0].astro.sunset}</li>
                    <li><strong>Moonrise:</strong> ${result.forecast.forecastday[0].astro.moonrise}</li>
                    <li><strong>Moonset:</strong> ${result.forecast.forecastday[0].astro.moonset}</li>
                    <li><strong>Moon Phase:</strong> ${result.forecast.forecastday[0].astro.moon_phase}</li>
                </ul>
            `;
            weatherResultsDiv.append(weatherInfo); // Append the weather information to the weather results div
        } catch (e) {
            console.error('Failed to parse JSON:', e);
            weatherResultsDiv.html('Failed to parse weather data.');
        }
    }
});
