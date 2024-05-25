$(document).ready(function(){
    $('#citySearchForm').submit(function(e){
        e.preventDefault(); // Prevent form submission
    
        var query = $('#city').val(); // Get the city name from the input field
    
        // Send an Ajax request to the server
        $.ajax({
            url: '/citysearch',
            method: 'GET',
            data: {q: query},
            success: function(response){
                displayLocationInfo(response); // Call a function to display the location information
                $('#searchResults').css('background-color', '#A3CDE5'); // Change background color after receiving results
            },
            error: function(xhr, status, error){
                console.error(xhr.responseText); // Log any errors to the console
            }
        });
    });
    
    
    // Function to display location information
    function displayLocationInfo(results){
        var searchResultsDiv = $('#searchResults');
        searchResultsDiv.empty(); // Clear previous results
    
        if (results && results.length > 0) {
            var resultsList = $('<ul>');
    
            // Loop through the results and add location information to the list
            $.each(results, function(index, result){
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
