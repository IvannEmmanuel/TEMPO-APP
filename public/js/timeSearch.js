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
          headers: {
            'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiNjM3ZjViNDExYTNkNmUyNDA2MmRjMDVmOGVhZDk1ODIzMTRkZGViMzdhYmUxN2NiMDFmYzJjMDdkZGViOTNiNzQyNGIyZDEwMWE4OGE5MWEiLCJpYXQiOjE3MTc0NjU3MjQuMzQ1NzQzLCJuYmYiOjE3MTc0NjU3MjQuMzQ1NzQ4LCJleHAiOjE3NDkwMDE3MjMuOTMxMjc2LCJzdWIiOiIiLCJzY29wZXMiOltdfQ.hy1AgKGEM9x4_xwBhn-MAvFXWds4jlfOXY5xfRyG7mDL8UfPy1w382We2Yk9zBJay2Wsfni8zmw5bUJOl4LkZja7AmRD-20RxdY-a4HNPFrJEIcWzgaPFmLQOzKzhXivFi_5N6GFKGYuwWGTSjnDebib0LEj4SP7jVWJ5Y7kZmwSiQuWXandCFRE7SEUJRLjp9DOfyAJ5MkKD1FEQ-8TYXGVSFneyiyMx9trjZvNkcXRSW_DQBOUrqFeCq872JgICEecAJMs9SlyKuss5iq6gVCNC_QnwXWrY7L9YXVtx_lrQUKPgakRep7qQLykC-8Py3uW4kR4dhZ0VEU4a1PaB42nGkaQFkMDd-zUE321AEm-X2wZwzYM6TQPsIJnedUtEce2PaoRqT8iO7vKEtJLDWLu9qZUYV41J0kvcnHX_DUK1RWE80hAgTAmT57tOCryn2ZA9knJ4UQmC_coLvoslqOz8pYtcjoctRgV5ucI5hoE9yRk7EY2uQ-MHXZ1BngYB58SmGYQil2KTpIlKulkYl-BazGTjGJGgZu5_OkivXwlTXUEgfZkGTyoMn0FFjUFbyKGQdfTTL1Vd6bhbnavveyw3qcE5Ao_4h63qZ9Poofol2OZThYm2MREp01V2MR7Es8lMFh612T2HAOjUWRzqdSeksDdeuLV50MAHjqnw50' // Replace with your actual access token
          },
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
      var timeData = response; // Use the response directly without parsing
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
      console.error('Error processing response:', error);
      timeResultsDiv.html('Failed to parse time data.');
  }
}
