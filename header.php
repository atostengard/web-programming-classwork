<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php 
    if (!isset($_SESSION)) {
            session_start();       
    } ?>
<html>
    <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?php echo $_SESSION['layout'] ?>">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="newNavigation.js"></script>
      <script src="gold.js"></script>
      <script src="js.js"></script>
    </head>


    <body>
        <nav class="headerTab">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
              </button>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
              <ul class="nav navbar-nav">
                <button class="headerTablinks" onclick="window.location.href='taskpage.php'" id="defaultOpen">Lists</button> <!-- Page 1 -->
                <button class="headerTablinks" onclick="window.location.href='petpage.php'">Pet</button> <!-- Page 2 -->
                <button class="headerTablinks" onclick="window.location.href='storepage.php'">Store</button> <!-- Page 3 -->
              </ul>
              <ul class="nav navbar-nav navbar-right">
                  <li style = "color:white;">
                    <?php if (isset($_SESSION['userName'])) { ?>
                        Username: <?php 
                                       echo $_SESSION['userName'];
                                  ?><br>
                          Gold: <?php 
                                  $line = mysqli_fetch_array($gold_amt, MYSQLI_ASSOC);
                                  echo $line['amt_gold'];
                                  ?><br>
                          <form action ="logout.php">
                              <button type="submit" id="logoutBtn">Logout</button>
                          </form>
                    <?php }
                        else { ?>
                          <button type="button" id="loginBtn" onclick = "openLogin();">Login</button>
                        <?php } ?>

                  </li>
              </ul>
            </div>
          </div>
        </nav>
        
        <div class = "form-popup" id = "loginForm" method = "post">
            <form action = "login.php" class ="form-container">
                <h1>Login</h1>
                
                <label for="email"><b>Username</b></label>
                <input type="text" placeholder="enter username..." name="userName" required>
                
                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="enter password..." name="password" required>
                
                <button type="submit" class="btn" onclick="showUserStuff()">Login</button>
                <button type="button" class="btn cancel" onclick="closeLogin();">Close</button>
            </form>
        </div>
    </body>
