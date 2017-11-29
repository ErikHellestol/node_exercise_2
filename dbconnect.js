var pgp = require('pg-promise')();

//db connect string
var conn = process.env.DATABASE_URL || 'postgres://ybyncykjxyctqo:02d96d972d10c154bf3524ee74dbefa3543ebec61049e3db4f7eae9114956db0@ec2-46-137-174-67.eu-west-1.compute.amazonaws.com:5432/d34eo2gvf0u1tf';
var db = pgp(conn);

module.exports = db;
