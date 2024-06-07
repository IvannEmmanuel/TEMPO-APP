<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Currency Search</title>
  <!--
  <link rel="stylesheet" type="text/css" href="css/citysearch.css">
  <link rel="stylesheet" type="text/css" href="getWeather.css"> Kulang ni og "css/getWeather" -->
  <!--<link rel="stylesheet" type="text/css" href="timeSearch.css"> Kulang ni og "css/timeSearch" 
    -->
  <link rel="stylesheet" type="text/css" href="css/getCurrency.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/newCitySearch.css">
  <link rel="stylesheet" type="text/css" href="css/navBarCurrency.css">
</head>
<body>
  <div class="header">
    <img src="images/tempo.png" alt="tempo" class="tempo">
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

  <div class="navigations">
    <nav>
      <ul class="nav-list">
        <li><a href="/weathersearch"><img src="images/weather.png" alt="Weather Icon" /></a></li>
        <li><a href="/timesearch"><img src="images/time.png" alt="Time Icon" /></a></li>
        <li><a href="/"><img src="images/city.png" alt="City Icon" /></a></li>
        </ul>
    </nav>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="js/getCurrency.js"></script>
</body>
</html>
