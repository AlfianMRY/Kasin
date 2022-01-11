// TODO 2: SETUP ROUTING (ROUTER)

// Import Patients Controller
const PatientsController = require("../controllers/PatientsController");

// import express
const express = require("express");
const { Router } = require("express");

// buat routing modular
const router = express.Router();

// callback function
router.get("/", (req, res) => {
  res.send("Hello Alfian");
});

// Routing Covid API
router.get("/patients", PatientsController.index);
router.post("/patients", PatientsController.store);
router.put("/patients/:id", PatientsController.update);
router.delete("/patients/:id", PatientsController.destroy);
router.get("/patients/:id", PatientsController.show);
router.get("/patients/search/:name", PatientsController.search);
router.get("/patients/status/positive", PatientsController.positive);
router.get("/patients/status/recovered", PatientsController.recovered);
router.get("/patients/status/dead", PatientsController.dead);

// Export Route
module.exports = router;
