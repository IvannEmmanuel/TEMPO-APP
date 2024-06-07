$(document).ready(function() {
    $('#citySearchForm').submit(function(event) {
        event.preventDefault(); // Prevent form submission
        var query = $('#city').val(); // Get the value from the input field

        // AJAX request to fetch data from the API
        $.ajax({
            type: 'GET',
            url: '/citysearch',
            headers: {
                'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiNjM3ZjViNDExYTNkNmUyNDA2MmRjMDVmOGVhZDk1ODIzMTRkZGViMzdhYmUxN2NiMDFmYzJjMDdkZGViOTNiNzQyNGIyZDEwMWE4OGE5MWEiLCJpYXQiOjE3MTc0NjU3MjQuMzQ1NzQzLCJuYmYiOjE3MTc0NjU3MjQuMzQ1NzQ4LCJleHAiOjE3NDkwMDE3MjMuOTMxMjc2LCJzdWIiOiIiLCJzY29wZXMiOltdfQ.hy1AgKGEM9x4_xwBhn-MAvFXWds4jlfOXY5xfRyG7mDL8UfPy1w382We2Yk9zBJay2Wsfni8zmw5bUJOl4LkZja7AmRD-20RxdY-a4HNPFrJEIcWzgaPFmLQOzKzhXivFi_5N6GFKGYuwWGTSjnDebib0LEj4SP7jVWJ5Y7kZmwSiQuWXandCFRE7SEUJRLjp9DOfyAJ5MkKD1FEQ-8TYXGVSFneyiyMx9trjZvNkcXRSW_DQBOUrqFeCq872JgICEecAJMs9SlyKuss5iq6gVCNC_QnwXWrY7L9YXVtx_lrQUKPgakRep7qQLykC-8Py3uW4kR4dhZ0VEU4a1PaB42nGkaQFkMDd-zUE321AEm-X2wZwzYM6TQPsIJnedUtEce2PaoRqT8iO7vKEtJLDWLu9qZUYV41J0kvcnHX_DUK1RWE80hAgTAmT57tOCryn2ZA9knJ4UQmC_coLvoslqOz8pYtcjoctRgV5ucI5hoE9yRk7EY2uQ-MHXZ1BngYB58SmGYQil2KTpIlKulkYl-BazGTjGJGgZu5_OkivXwlTXUEgfZkGTyoMn0FFjUFbyKGQdfTTL1Vd6bhbnavveyw3qcE5Ao_4h63qZ9Poofol2OZThYm2MREp01V2MR7Es8lMFh612T2HAOjUWRzqdSeksDdeuLV50MAHjqnw50' // Replace with your actual access token
            },
            data: { q: query },
            success: function(response) {
                // Call function to display location information
                displayLocationInfo(response);
                $('#searchResults').css('background-color', '#A3CDE5');
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(error);
            }
        });
    });

    // Function to display location information
    function displayLocationInfo(results) {
        var searchResultsDiv = $('#searchResults');
        searchResultsDiv.empty(); // Clear previous results

        if (results && results.length > 0) {
            var resultsList = $('<ul>');

            // Loop through the results and add location information to the list
            $.each(results, function(index, result) {
                var listItem = $('<li>').html(
                    'Name: ' + result.name + "<br>" +
                    'State Name: ' + result.state_name + "<br>" +
                    'State Code: ' + result.state_code + "<br>" +
                    'Type: ' + result.type + "<br>" +
                    'Country Name: ' + result.country_name + "<br>" +
                    'Country Code: ' + result.country_code + "<br>"
                );
                resultsList.append(listItem);
            });

            // Append the list of location results to the search results div
            searchResultsDiv.append(resultsList);

            $('li', resultsList).not(':last').css('margin-bottom', '20px');
        } else {
            // If no results found, display a message
            searchResultsDiv.html('No results found.');
        }
    }
});
