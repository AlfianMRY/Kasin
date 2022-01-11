/**
 * TODO 1: SETUP SERVER USING EXPRESS.JS.
 * UBAH SERVER DI BAWAH MENGGUNAKAN EXPRESS.JS.
 * SERVER INI DIBUAT MENGGUNAKAN NODE.JS NATIVE.
 */

// Import Express
const express = require("express");

// Buat Server
const app = express();

// Definisi Port
app.listen(3000, () => {
  console.log("Server berjalan di: http://localhost:3000");
});

// Import Route
const router = require("./routes/api");
app.use(express.json());
app.use(router);
