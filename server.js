const url = require('url')
const express = require('express')
const bodyParser = require('body-parser');
const server = express()

server.use(express.static('public'))

function greets () {
    var greet = ["Hei", "Hallo", "hei hei"];
    var random = greet[Math.floor((Math.random()*greet.length))];
    return random;
}

server.get('/random/:id', function (req, res) {
  res.send(greets() +" "+ req.params.navn);

})

server.listen(function () {
  console.log(greets())
  console.log('Nå var det tid for og jobbe gitt!')
})