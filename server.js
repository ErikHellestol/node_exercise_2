const express = require('express');
const app = express();



app.use(express.static("./public"));

app.listen(process.env.PORT || 8080, function () { // do something with the port
  console.log('Star wars');
});

console.log("noe tull");
// skjønner ingenting
