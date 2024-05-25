$(document).ready(function() {
    $('#timeSearchForm').submit(function(e) {
      e.preventDefault(); // Prevent form submission
  
      var location = $('#locationtime').val(); // Get the location from the input field
  
      // Check for empty location
      if (!location) {
        console.error('Please enter a location.');
        return; // Prevent sending the request if location is empty
      }
  
      // Send an Ajax request to the server
      $.ajax({
        url: '/time', // Endpoint for fetching time data (assuming your server handles this route)
        method: 'GET',
        data: { location: location },
        success: function(response) {
          console.log('Response from server:', response);
          displayTime(response); // Call a function to display the results
          $('#timeResults').css('background-color', '#A3CDE5'); // Change background color after receiving results
        },
        error: function(xhr, status, error) {
          console.error('Error:', error);
          $('#timeResults').html('Failed to fetch time data.');
        }
      });
    });
  });
  // Function to display time information
function displayTime(response) {
    var timeResultsDiv = $('#timeResults');
    timeResultsDiv.empty(); // Clear previous results
  
    try {
      var timeData = JSON.parse(response); // Parse the JSON response
      var locationData = timeData.location;
  
      var timeInfo = `
        <ul>
            <li><strong>Name:</strong> ${locationData.name}</li>
            <li><strong>Region:</strong> ${locationData.region}</li>
            <li><strong>Country:</strong> ${locationData.country}</li>
            <li><strong>Latitude:</strong> ${locationData.lat}</li>
            <li><strong>Longitude:</strong> ${locationData.lon}</li>
            <li><strong>Timezone ID:</strong> ${locationData.tz_id}</li>
            <li><strong>Local Time (Epoch):</strong> ${locationData.localtime_epoch}</li>
            <li><strong>Local Time:</strong> ${locationData.localtime}</li>
        </ul>
      `;
      timeResultsDiv.html(timeInfo); // Display the time information in the #timeResults div
    } catch (error) {
      console.error('Error parsing JSON:', error);
      timeResultsDiv.html('Failed to parse time data.');
    }
  }
  