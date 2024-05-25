$(document).ready(function() {
    $('#weatherSearchForm').submit(function(e) {
        e.preventDefault(); // Prevent form submission

        var location = $('#location').val(); // Get the location from the input field

        // Send an Ajax request to the server
        $.ajax({
            url: '/weather',
            method: 'GET',
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
