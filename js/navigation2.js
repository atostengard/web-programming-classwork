// opens top navigation bar
function openHeader(evt, headerTabName) {
    var i, headerTabcontent, headerTablinks;
    headerTabcontent = document.getElementsByClassName("headerTabcontent");
    for (i = 0; i < headerTabcontent.length; i++) {
        headerTabcontent[i].style.display = "none";
    }
    headerTablinks = document.getElementsByClassName("btn");
    for (i = 0; i < headerTablinks.length; i++) {
        headerTablinks[i].className = headerTablinks[i].className.replace(" active", "");
    }
    document.getElementById(headerTabName).style.display = "block";
    evt.currentTarget.className += " active";
}

document.getElementById("defaultOpen").click();


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




// opens tab of specific list
function openTab(evt, tabName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("btn");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}

document.getElementById("defaultOpen1").click();



// Editting and Adding to a list
//Create a "close" button and append it to each list item
var myNodelist = document.getElementsByTagName("LI");
var i;
for (i = 0; i < myNodelist.length; i++) {
  var span = document.createElement("SPAN");
  var txt = document.createTextNode("\u00D7");
  span.className = "close";
  span.appendChild(txt);
  myNodelist[i].appendChild(span);
}

// Click on a close button to hide the current list item
var close = document.getElementsByClassName("close");
var i;
for (i = 0; i < close.length; i++) {
  close[i].onclick = function() {
    var div = this.parentElement;
    div.style.display = "none";
  };
}



// Add a "checked" symbol when clicking on a list item
var list = document.querySelector('#todoList');
list.addEventListener('click', function(ev) {
  if (ev.target.tagName === 'LI') {
    ev.target.classList.toggle('checked');
  }
}, false);

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







