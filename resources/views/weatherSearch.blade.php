<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Weather Search</title>
  <!--
  <link rel="stylesheet" type="text/css" href="css/citysearch.css">
  <link rel="stylesheet" type="text/css" href="getWeather.css"> Kulang ni og "css/getWeather" -->
  <!--<link rel="stylesheet" type="text/css" href="timeSearch.css"> Kulang ni og "css/timeSearch" 
    -->
  <link rel="stylesheet" type="text/css" href="css/getCurrency.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/newCitySearch.css">
  <link rel="stylesheet" type="text/css" href="css/navBarWeather.css">
</head>
<body>
  <div class="header">
    <img src="images/tempo.png" alt="tempo" class="tempo">
  </div>
  <h1>Weather Search</h1>
    <div class="container">
        <form id="weatherSearchForm" method="get">
            <img src="images/search.png" alt="search" class="search">
            <input type="text" id="location" name="location" placeholder="Enter location" required class="search-input">
            <button type="submit">Search</button>
        </form>
        <div id="weatherResults"></div>
  </div>

  <div class="navigations">
    <nav>
      <ul class="nav-list">
        <li><a href="/timesearch"><img src="images/time.png" alt="Time Icon" /></a></li>
        <li><a href="/currencysearch"><img src="images/currency.png" alt="Time Icon" /></a></li>
        <li><a href="/"><img src="images/city.png" alt="City Icon" /></a></li>
        </ul>
    </nav>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="js/getWeather.js"></script>
</body>
</html>