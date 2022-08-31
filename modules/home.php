<?php include 'modules/decrypt.php'; ?>
<?php include 'modules/trible.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">  
    <title>Home | MyEcoria</title>
    <link rel="stylesheet" href="utils/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <div class="wrapper">
      <header>
        <h1>Hi 🚀</h1>
        <p>
          
          <?php
            if(isset($_COOKIE['user_adresse'])){
                echo 'Welcome <a href="https://explorer.paw.digital/account/'.$user.'">you</a>';
                echo "</br>";
                echo "</br>";
                echo '<img src="https://pawnimal.paw.digital/api/v1/nano?address='.$user.'">';
            } else {
                echo '

                <script type="text/javascript">
                    $(document).ready(function () {
                    $(location).attr("href", "http://localhost");
                    });
                </script>

                ';
            }
          ?>
          
        </p>
        <hr size="5" style="background-color: black;">
        <h2>Trible information:</h2>
        <div>
        
          <p>Trible size: <?php echo $voting; ?></p>
          <p>Number of delegates: <?php echo $representativeCount; ?></p>
        </div>
      </header>
      
    </div>

    
    <script src="utils/js/script.js"></script>

  </body>
</html>