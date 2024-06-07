<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Time Search</title>
  <!--
  <link rel="stylesheet" type="text/css" href="css/citysearch.css">
  <link rel="stylesheet" type="text/css" href="getWeather.css"> Kulang ni og "css/getWeather" -->
  <!--<link rel="stylesheet" type="text/css" href="timeSearch.css"> Kulang ni og "css/timeSearch" 
    -->
  <link rel="stylesheet" type="text/css" href="css/getCurrency.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/newCitySearch.css">
  <link rel="stylesheet" type="text/css" href="css/navBarTime.css">

</head>
<body>
  <div class="header">
    <img src="images/tempo.png" alt="tempo" class="tempo">
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

  <div class="navigations">
    <nav>
      <ul class="nav-list">
        <li><a href="/weathersearch"><img src="images/weather.png" alt="Weather Icon" /></a></li>
        <li><a href="/currencysearch"><img src="images/currency.png" alt="Time Icon" /></a></li>
        <li><a href="/"><img src="images/city.png" alt="City Icon" /></a></li>
        </ul>
    </nav>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>t>
  <script src="js/timeSearch.js"></script>
</body>
</html>
