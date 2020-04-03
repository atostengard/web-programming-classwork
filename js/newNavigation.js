//Adds new todo list to tab of all lists
function addList() {

  title = document.getElementById("newList").value.toString();
  //console.log(title);

  var btn = document.createElement("button");
  btn.setAttribute("type","button");
  btn.setAttribute("class","btn");

  btn.setAttribute("onclick","openTab(event,"+"'"+title+"'"+")");

  var t = document.createTextNode(title);

  // var span = document.createElement("SPAN");
  // var text = document.createTextNode("\u00D7");
  // span.className = "close";
  // span.appendChild(text);

  btn.appendChild(t);
  // btn.appendChild(span);
  document.getElementById("tab").appendChild(btn);
}



// Editting and Adding to a list
//Create a "close" button and append it to each list item
// var myNodelist = document.getElementsByTagName("LI");
// var i;
// for (i = 0; i < myNodelist.length; i++) {
//   var span = document.createElement("SPAN");
//   var txt = document.createTextNode("\u00D7");
//   span.className = "close";
//   span.appendChild(txt);
//   myNodelist[i].appendChild(span);
// }

// Click on a close button to hide the current list item
// var close = document.getElementsByClassName("close");
// var i;
// for (i = 0; i < close.length; i++) {
//   close[i].onclick = function() {
//     var div = this.parentElement;
//     div.style.display = "none";
//   };
// }



// Add a "checked" symbol when clicking on a list item
//var list = document.querySelector('#test');
//list.addEventListener('click', function(ev) {
//  if (ev.target.tagName === 'LI') {
//    ev.target.classList.toggle('checked');
//  }
//}, false);


// functions for buying the three different powerups
function buyTreat() {
    
    //fills out hidden form on storepage to submit to addPowerup.php
    var theForm = document.createElement('form');
    theForm.action = 'addPowerup.php';
    theForm.method = 'post';
    
    var input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'powerupType';
    input.value = 'foodPowerup';
    
    theForm.appendChild(input);
    document.getElementById('hidden_form_container_store').appendChild(theForm);
    theForm.submit();

    

  //console.log("clicked Treat");
}

function buyNap() {

   //fills out hidden form on storepage to submit to addPowerup.php
    var theForm = document.createElement('form');
    theForm.action = 'addPowerup.php';
    theForm.method = 'post';
    
    var input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'powerupType';
    input.value = 'napPowerup';
    
    theForm.appendChild(input);
    document.getElementById('hidden_form_container_store').appendChild(theForm);
    theForm.submit();
  //console.log("clicked Nap");
}

function buyPlay() {

  //fills out hidden form on storepage to submit to addPowerup.php
    var theForm = document.createElement('form');
    theForm.action = 'addPowerup.php';
    theForm.method = 'post';
    
    var input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'powerupType';
    input.value = 'playPowerup';
    
    theForm.appendChild(input);
    document.getElementById('hidden_form_container_store').appendChild(theForm);
    theForm.submit();
  console.log("clicked Play");
}




// Create a new list item when clicking on the "Add" button
function newElement() {
  var li = document.createElement("li");
  var inputValue = document.getElementById("myInput").value;
  var t = document.createTextNode(inputValue);
  li.appendChild(t);
  if (inputValue === '') {
    alert("You must write something!");
  } else {
    document.getElementById("todoList").appendChild(li);
  }
  document.getElementById("myInput").value = "";

  var span = document.createElement("SPAN");
  var txt = document.createTextNode("\u00D7");
  span.className = "close";
  span.appendChild(txt);
  li.appendChild(span);

  for (i = 0; i < close.length; i++) {
    close[i].onclick = function() {
      var div = this.parentElement;
      div.style.display = "none";
    };
  }
}

//get event when user clicks on task <li> item
function getEventTarget(event) {
    event = event || window.event;
    return event.target || event.srcElement;
}

var ul = document.getElementById('myUL');
ul.onclick = function(event) {
    var target = getEventTarget(event);
    var targetHTML = target.innerHTML
    var htmlTagStart = targetHTML.indexOf('<');
    var targetString = targetHTML.substring(0, htmlTagStart);
    
    //fills out hidden form on taskpage to submit to deleteTask.php
    var theForm = document.createElement('form');
    theForm.action = 'deleteTask.php';
    theForm.method = 'post';
    
    //next create input where task name will go
    var input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'taskName';
    input.value = targetString;
    
    theForm.appendChild(input);
    document.getElementById('hidden_form_container').appendChild(theForm);
    theForm.submit();
}
