<!DOCTYPE html>

<?php 
    if (!isset($_SESSION)) {
            session_start();       
    } ?>
<html>
    <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
      <link rel="stylesheet" href="newStyles.css">
      <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>


    <body>
    <?php require 'requirements.php';?>
    
    <?php if (isset($_SESSION['userName'])) {?>
        <div id="Pet" class="headerTabcontent">
            <div class="petTab">
                <p>Name: Veronica</p> 
                <p>Status: <?php echo $_SESSION['petStatus']?></p>
                <ul style="color:white; text-align:left;">  
                    <li>
                      <form action="useTreatPowerup.php">
                        <button style="position:relative; right:9%;">Use Treat Powerup</button>
                      </form>
                    </li><br>
                    <li>
                      <form action="useNapPowerup.php">
                        <button style="position:relative; right:9%;">Use Nap Powerup</button>
                      </form>
                    </li><br>
                    <li>
                      <form action="usePlayPowerup.php">
                        <button style="position:relative; right:9%;">Use Play Powerup</button>
                      </form>
                    </li><br>
                </ul><br><br>
                <form action="makeSad.php">
                        <button>Make Him Sad</button>
                </form>
            </div> 
            
            <div class="petContent">
                <span class='circle'>
                    <image id='pet_big' title="pet" src=<?php echo $_SESSION['petImage']?>>                  
                </span>
            </div>
        </div>
    <?php } ?>   
    <?php if (!isset($_SESSION['userName'])) {?>
        <div id="loggedOutDiv" style="position:absolute; left: 45%; top: 200px; text-align:center">
        <img src='http://images.neopets.com/template_images/aisha_baby_cry.gif'><br>
        Oh no, you're not logged in!
        </div>
    <?php } ?>

    <!-- Copyright Footer -->
    <footer class="container-fluid text-center" style="position:fixed; bottom:0; left:40%;">
        <p style="display:inline">All images copyright Neopets.com, © 1999-2018.</p>
        <div style="display:inline; position: relative; left: 45%;">
            Layout:
            <form action="changeLayouts.php" method="post" style="display:inline"><input class = "btn cancel" type="submit" name="layoutChoice" value="Christmas"></form>
            <form action="changeLayouts.php" method="post" style="display:inline"><input class = "btn" type="submit" name="layoutChoice" value="Navy and Teal"></form>
        </div>
    </footer>
    <script src="newNavigation.js"></script>
    </body>
</html>
