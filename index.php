<?php 

  $weather = "";

  $error = "";


  if($_GET["city"]) {

    $_GET["city"] = str_replace(' ', '',$_GET["city"]);

    $file = "https://www.weather-forecast.com/locations/".$_GET["city"]."/forecasts/latest";
    $file_headers = @get_headers($file);
    if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
        $error="The city didn't found";
    }  else {


        $forcastPage = file_get_contents("https://www.weather-forecast.com/locations/".$_GET["city"]."/forecasts/latest");

        $pageArray = explode('<img alt="left" class="scroll-button__arrow" height="32" src="https://www.weather-forecast.com/assets/base/icon-chevron-circle-left-2326989759101a2f7f2652154505a551.svg" width="32"></button><div class="b-forecast__wrapper b-forecast__wrapper--js" data-scroll-container=""><table class="b-forecast__table js-forecast-table"><thead><tr class="b-forecast__table-description b-forecast__hide-for-small days-summaries"><th></th><td class="b-forecast__table-description-cell--js" colspan="9"><div class="b-forecast__table-description-title"><h2>'.$_GET["city"].' Weather Today</h2> (1–3 days)</div><p class="b-forecast__table-description-content"><span class="phrase">',$forcastPage);

        $weather  = explode('</span></p></td>',$pageArray[1]);

    }
  }



 ?>





<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>What's the Weather</title>

    <style type="text/css">
      
      html { 
        background: url(Image/scene.jpg) no-repeat center center fixed; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
      }

      body {
        background: none;
      }

      .container {
        text-align: center;
        margin-top: 200px;
        width: 500px; 
      }

      input {
        margin: 20px 0;
      }

      button {
        margin-bottom: 20px;
      }


    </style>
  </head>
  <body>
    <div class="container">
      <h1>Whats the Weather ?</h1>

      <p>
        What's the name of the city ?
      </p>

      <form>
        <div class="form-group">
          <input type="text" class="form-control" id="city-name" name="city" placeholder="Eg. Delhi,Mumbai,Tokio,London" value="<?php echo $_GET["city"];  ?>">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>

      <div id="weather"><?php
        if($weather[0]) {
           echo '<div class="alert alert-success" role="alert">'.$weather[0].'</div>';
        }
        else if($error) {
           echo '<div class="alert alert-success" role="danger">'.$error.'</div>';
        }
      ?></div>


    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>