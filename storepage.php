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
      <link rel="stylesheet" href="<?php echo $_SESSION['layout'] ?>">

      <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>


    <body>
    <?php require 'requirements.php';?>
    <div id="hidden_form_container_store" style="display:none;"></div>
    
    <?php if (isset($_SESSION['userName'])) {?>
        <div id="Store" class="headerTabcontent">
            <!-- Should go in loop to populate from database -->
            <div class="itemRow" style="margin-left:15%;margin-top:5px;">
                <div class="col-sm-3" id="icon" style="color:white;">
                    <h3>Treat</h3>
                    <p>Satisfy your pet's hunger with a tasty treat</p>
                    <hr>
                    <br>
                    <p>100 gold</p>
                    <button class="buyBtn" id="buyTreat" style="color:black;" onclick="buyTreat()">Buy</button>
                    <p></p>
                </div>
                <div class="col-sm-3" id="icon" style="color:white;">
                    <h3>Nap</h3>
                    <p>Give your pet some extra zzz's with a cozy nap</p>
                    <hr>
                    <br>
                    <p>50 gold</p>
                    <button class="buyBtn" id="buyNap" style="color:black;" onclick="buyNap()">Buy</button>
                    <p></p>
                </div>
                <div class="col-sm-3" id="icon" style="color:white;">
                    <h3>Play Time</h3>
                    <p>Boost your pet's mood with their favorite toy</p>
                    <hr>
                    <br>
                    <p>100 gold</p>
                    <button class="buyBtn" id="buyPlay" style="color:black;" onclick="buyPlay()">Buy</button>
                    <p></p>
                </div>
                <br>
                
            </div>

            <div id="itemList">
                <h3 style="padding:15px;">Your Power-ups:</h3>
                <ul id="powerups">  
                    <!--Values-->                
                  <?php foreach($_SESSION['powerups'] as $key=>$value) {?>
                    <li><?php echo $value;?></li><br>
                  <?php }?>
                  
                

              </ul>
            </div>

            <!--
            <div id="status">
              <h4 id="balance">Current Balance: 1000 gold</h4>
              <h4 id="current">Current Power Ups:</h4>
              <ul id="purchase-list">
                <li id="items">Nap</li>
                <li id="items">Treat</li>
              </ul>

            </div>
            -->

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
    <script src="gold.js"></script>

    </body>