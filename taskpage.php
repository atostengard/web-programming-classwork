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
    <div id="hidden_form_container" style="display:none;"></div>
    
      <div class="pageContent">

        <!--only executes through line 51 if user not logged in-->
        <?php if (isset($_SESSION['userName'])) {?>

          <!-- Tab with user lists displayed -->
          <div class="tab" id="tab">

            <h3 style="text-align:center;"><b>My Lists:</b></h3>

          <!--retrieves list names and prints them to sidebar -->
            <?php while ($line = mysqli_fetch_array($listNames, MYSQLI_ASSOC)) { ?>
              <form method="post" action="tasks.php">
                <input id="listName" type="submit" name="listName" class="btn" value="<?php echo $line['name']?>">
              </form>
            <?php } ?> 

            <hr>

            <!-- Sort tasks by due date -->
            <h4 style="text-align:center;"><b>Sort Tasks by Due Date</b></h4>
<!--            <div class='input-group date' id='datetimepicker2'>
              
              <input type='text' class="form-control" name="sortDate" placeholder='Pick due date' id="sortDateInput"/>

              <span class="input-group-addon" id="calendarBtn">
                <span class="glyphicon glyphicon-calendar"></span>
              </span>

               Still trying to figure out how to make this look nice 
              <div id=btnTest>
                <button type="submit" id="sortDateBtn">Go</button>
              </div>

            </div>-->

            <!-- User can view list of tasks by due date -->
            <form method="post" action="getTasksByDate.php" id="sortDateForm">
              <div class="container" id="sortDateContainer">
                <div class="row">
                    <div class='col-lg-1'>
                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker2'>
                                <input type='text' class="form-control" name="sortDate" placeholder='Tasks by day' id="sortDatePicker"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <script type="text/javascript">
                        $(function () {
                            $('#datetimepicker2').datetimepicker({
                                format: 'MM/DD/YYYY',
                                useCurrent: false
                            });
                        });
                        
                        $("#datetimepicker2").on('dp.change', function() {
                              $('#sortDateForm').submit();
                        });
                    </script>
                </div>
              </div>
             </form>


            <!-- User can create their own list -->
            <h4 style="text-align:center;"><b>Create New List:</b></h4>
            <form method="post" action="addList.php">
              <input id="listInput" type="text" name="listName" placeholder="List Name">
              <button type="submit" class="add-btn" id="addListBtn" onclick="addList()">Add</button>
            </form>

          </div> <!-- Ends tab -->
        
        
        <!-- Tabcontent - tasks from user clicked list -->
        <div class="col-sm-8 text-left" id="tabcontent">

          <!--print selected list name in header-->
          <?php if (isset($_SESSION['listName'])) {?>
            
            <div id="listHeader">
              <!-- List Name -->
              <h1><?php echo $_SESSION['listName'];?></h1>
            </div>
            <hr>

            <div id="tabcontent2"> <!-- Lists of tasks -->
              <!--Create list of tasks from the database-->
              <ul id="myUL">
                  <?php foreach($_SESSION['tasks'] as $key=>$value) {?>
                    <li><?php echo $value;?></li><br>
                  <?php }?>
              </ul>

              <!-- User can create their own task-->
              <div class="alignTest"> <!-- div allows input fields to be on same line -->

                <form method="post" action="addTask.php" id="addTaskForm">
              
                  <input type="text" name="taskToAdd" placeholder="  Task Name" id="addTaskInput">
                  <input placeholder="Frequency (i.e. 7 for once a week)" name="frequency" id="addTaskFrequency">
                    <!---bootstrap datepicker for addTask function-->
                    <div class="container" id="addTaskDateContainer">
                        <div class="row">
                            <div class='col-lg-1'>
                                <div class="form-group" id="addTaskFormContainer">
                                    <div class='input-group date' id='datetimepicker1'>
                                        <input type='text' class="form-control" name="date" placeholder='Due Date' style="width:150px;" id="dueDateInput"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <script type="text/javascript">
                                $(function () {
                                    $('#datetimepicker1').datetimepicker({
                                        format: 'MM/DD/YYYY'
                                    });
                                });
                            </script>
                        </div>
                        <button type="submit" class="addTaskBtn">Add</button>
                  <br>                         
                        <!--bootstrap time picker for addTask function
                        ****no time, we can worry about this later
                        <div class="container">
                        <div class="row">
                            <div class='col-sm-6'>
                                <div class="form-group">
                                    <div class='input-group date' id='datetimepicker2'>
                                        <input type='text' class="form-control" name="datetime" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <script type="text/javascript">
                                $(function () {
                                    $('#datetimepicker2').datetimepicker({
                                        format: 'HH:mm'
                                    });
                                });
                            </script>
                        </div>
                        </div>
                        -->
                
                </form> 
              </div>
              
              <?php }
              }?>

            </div>

        </div>

    <!-- Login check -->
    <?php if (!isset($_SESSION['userName'])) {?>
      <div id="loggedOutDiv" style="position:absolute; left: 45%; top: 200px; text-align:center">
        <img src='http://images.neopets.com/template_images/aisha_baby_cry.gif'>
        <br>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="newNavigation.js"></script>

  </body>
</html>