// JavaScript Document

var mysql = require('mysql');

var con = mysql.createConnection({
  host: "ec2-46-137-174-67.eu-west-1.compute.amazonaws.com",
  user: "ybyncykjxyctqo",
  password: "02d96d972d10c154bf3524ee74dbefa3543ebec61049e3db4f7eae9114956db0",
  database: "d34eo2gvf0u1tf"
});

var username = document.getElementById('username');
var password = document.getElementById('password');
var name = document.getElementById('name');
var btn = document.getElementById('btn');
var msg = document.getElementById('msg');

btn.addEventListener("click", function() {
	
con.connect(function(err) {
  if (err) throw err;
  msg.innerHTML = "Det har skjedd noe feil :'("
  //Insert a record in the "customers" table:
  var sql = "INSERT INTO accounts (username, password, name) VALUES ("username.value", "password.value", "name.value")";
  con.query(sql, function (err, result) {
    if (err) throw err;
    msg.innerHTML = "Bruker er laget";
  });
});
});