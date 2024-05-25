<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>City Search</title>
  <!--
  <link rel="stylesheet" type="text/css" href="css/citysearch.css">
  <link rel="stylesheet" type="text/css" href="getWeather.css"> Kulang ni og "css/getWeather" -->
  <!--<link rel="stylesheet" type="text/css" href="timeSearch.css"> Kulang ni og "css/timeSearch" 
    -->
  <link rel="stylesheet" type="text/css" href="css/getCurrency.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/newCitySearch.css">
</head>
<body>
  <div class="header">
    <img src="images/tempo.png" alt="tempo" class="tempo">
      <div class="user-profile">
          <span class="username">Ivan Dadacay</span>
          <div class="user-icon-container">
                <img src="images/username.png" alt="User Icon" class="user-icon">
          </div>
      </div>
  </div>

  <!-- CITY SEARCH -->

  <h1>City Search</h1>
  <div class="container">
    <form id="citySearchForm">
      <img src="images/search.png" alt="search" class="search">
      <input type="text" id="city" name="q" placeholder="Search a place..." required class="search-input">
      <button type="submit">Search</button>
    </form>
    <div id="searchResults"></div>
  </div>

  <!-- WEATHER SEARCH -->
  <br><br><br><br>
  <h1>Weather Search</h1>
    <div class="container">
        <form id="weatherSearchForm" method="get">
            <img src="images/search.png" alt="search" class="search">
            <input type="text" id="location" name="location" placeholder="Enter location" required class="search-input">
            <button type="submit">Search</button>
        </form>
        <div id="weatherResults"></div>
  </div>

  <!-- TIME SEARCH -->
  <h1 class = "text-time">Time Search</h1>
  <div class="container">
    <form id="timeSearchForm" method="get">
      <img src="images/search.png" alt="search" class="search">
      <input type="text" id="locationtime" name="locationtime" placeholder="Enter Location" class="search-input">
      <button type="submit">Search</button>
    </form>

    <div id="timeResults"></div>
  </div>

  <h1>Currency Converter</h1>
  <div class="containercurrency">
  <form id="currencyForm">
    <label for="from">From:</label>
    <input type="text" id="from" name="from" required>
    <label for="to">To:</label>
    <input type="text" id="to" name="to" required>
    <div class="amount-group">
      <label for="amount">Amount:</label>
      <input type="number" id="amount" name="amount" required>
      <button type="submit">Convert</button>
    </div>
  </form>
    <div id="result"></div>
  </div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="js/citysearch.js"></script> 
  <script src="js/getWeather.js"></script>
  <script src="js/timeSearch.js"></script>
  <script src="js/getCurrency.js"></script>
</body>
</html>
