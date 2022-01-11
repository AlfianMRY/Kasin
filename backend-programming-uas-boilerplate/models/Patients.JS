// TODO 5: SETUP MODEL

// Import DB
const { prependOnceListener } = require("../config/database");
const db = require("../config/database");

class Patients {
  /**
   *
   * @param callback
   * @returns Mengembalikan semua data [pada table patients]
   */
  static all(callback) {
    return new Promise((resolve, reject) => {
      // Query ke DB
      const sql = "select * from patients";
      db.query(sql, function (err, results) {
        resolve(results);
      });
    });
  }

  /**
   *
   * @param request = data yang ingin di inputkan
   * @param callback
   * @returns kembalikan data yang di inputkan
   */
  static async create(request, callback) {
    // insert ke db dan menyimpan nilai id
    const id = await new Promise((resolve, reject) => {
      const insert = "INSERT INTO patients SET ?";
      db.query(insert, request, (err, results) => {
        resolve(results.insertId);
      });
    });
    // kembalikan data yang di input
    return new Promise((resolve, reject) => {
      const select = "SELECT * FROM patients WHERE id = ?";
      db.query(select, id, (err, results) => {
        resolve(results);
      });
    });
  }

  /**
   *
   * @param id = data id yang di kirim lewat parameter
   * @returns kembalikan data apakah ada atau tiadk
   */
  static find(id) {
    return new Promise((resolve, reject) => {
      const sql = "SELECT * FROM patients WHERE id = ?";
      db.query(sql, id, (err, results) => {
        const [patients] = results;
        resolve(patients);
      });
    });
  }

  /**
   *
   * @param id = data id yang di kirim lewat parameter
   * @param data = data yang ingin di update dalam req.body
   * @returns kembalikan data yang di update untuk ditampilkan
   */
  static update(id, data) {
    new Promise((resolve, reject) => {
      const sql = "UPDATE patients SET ? WHERE id = ?";
      db.query(sql, [data, id], (err, results) => {
        resolve(results);
      });
    });
    return this.find(id);
  }

  /**
   *
   * @param id = data id yang di kirim lewat parameter
   * @returns kembalikan informasi kalau sudah di hapus / tidak ada datanya
   */
  static delete(id) {
    return new Promise((resolve, reject) => {
      const sql = "DELETE FROM patients WHERE id = ?";
      db.query(sql, id, (err, results) => {
        resolve(results);
      });
    });
  }

  /**
   *
   * @param names = data nama yang di cari yang dikirim dari parameter
   * @returns data yang di cari untuk di tampilkan
   */
  static search(names) {
    return new Promise((resolve, reject) => {
      const sql = "SELECT * FROM patients WHERE name LIKE N?";
      db.query(sql, names, (err, results) => {
        resolve(results);
      });
    });
  }

  /**
   *
   * @param status = data status yang dikirim berdasarkan methodnya
   * @returns data berdasarkan status yang di cari
   */
  static findByStatus(status) {
    return new Promise((resolve, reject) => {
      const sql = "SELECT * FROM patients WHERE status = ?";
      db.query(sql, status, (err, results) => {
        resolve(results);
      });
    });
  }
}

//export class
module.exports = Patients;
