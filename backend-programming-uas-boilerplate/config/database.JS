// TODO 3: SETUP CONFIG DATABASE

// Import Mysql dan .env
const mysql = require("mysql");
require("dotenv").config();

// Membuat Connection dengan CreateConnection
const db = mysql.createConnection({
  host: process.env.DB_HOST,
  user: process.env.DB_USER,
  password: process.env.DB_PASSWORD,
  database: process.env.DB_DATABASE,
});

// Menyambungkan Ke DB
db.connect(function (err) {
  if (err) {
    console.log("Koneksi error" + err);
    return;
  } else {
    console.log("Koneksi berhasil");
    return;
  }
});

// Export DB
module.exports = db;
