// JavaScript Document

var box = document.getElementById('task-box');

var titleIn = document.getElementById('tasknavn');
var task = document.getElementById('beskrivelse');
var dato = document.getElementById('dato');
var klokke = document.getElementById('klokkeslett');

var button = document.getElementById('btn');



button.addEventListener("click", function() {
	console.log(task.value);
	box.innerHTML += "<div class='task-boxes'><h1 class='task-head'>" + titleIn.value + "</h1><p class='task-cont'>" + task.value + "<br>" + dato.value + " " + klokke.value + "</p></div>";
});


function showResult(str) {
 
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("livesearch").innerHTML=this.responseText;
      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","livesearch.php?q="+str,true);
  xmlhttp.send();
}
