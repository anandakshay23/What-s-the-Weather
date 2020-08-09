<?php 

  $weather = "";

  $error = "";


    if ($_GET['city']) {

        $urlContents = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['city'])."&appid=7ad812c256b8203c31a75b3f4a9f79e8");

        $weatherArray = json_decode($urlContents, true);

        if ($weatherArray['cod'] == 200) {

            $weather = "The weather in ".$_GET['city']." is currently '".$weatherArray['weather'][0]['description']."'. ";

            $tempInCelcius = intval($weatherArray['main']['temp'] - 273);

            $weather .= " The temperature is ".$tempInCelcius."&deg;C and the wind speed is ".$weatherArray['wind']['speed']."m/s.";

        } else {

            $error = "Could not find city - please try again.";

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
           echo '<div class="alert alert-primary" role="alert">'.$weather.'</div>';
        }
        else if($error) {
           echo '<div class="alert alert-danger" role="danger">'.$error.'</div>';
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