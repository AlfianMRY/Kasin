// TODO 4: SETUP CONTROLLER

// Import Model Patients
const { NULL } = require("mysql/lib/protocol/constants/types");
const Patients = require("../Models/Patients.JS");

// Membuat Class Student
class PatientsController {
  /**
   *
   * @param {*} req
   * @param {*} res
   *  Menampilkan semua data pada table patients
   */
  async index(req, res) {
    const patients = await Patients.all();
    // Mengecek apakah ada datanya atau tidak
    if (patients.length == 0) {
      const data = {
        message: "Data is Empty",
      };
      res.json(data);
    }
    const data = {
      message: "Get All Resource",
      data: patients,
    };
    res.json(data);
  }

  /**
   *
   * @param {*} req
   * @param {*} res
   *  Menyimpan data ke DB dan menampilkan data yang di inputkan
   */
  async store(req, res) {
    const { name, phone, address, status, in_date_at, out_date_at } = req.body;
    // pengecekan apakah request nya lengkap atau tidak
    if (name && phone && address && status && in_date_at) {
      const lowStatus = status.toLowerCase();
      // pengecekan untuk field status agar sesuai isinya
      if (lowStatus == "positive") {
        const patients = await Patients.create(req.body);
        const data = {
          message: `Resource is added successfully`,
          data: patients,
        };
        res.status(201).json(data);
        // Karena jika sudah recovered atau dead pasti ada tgl keluarnya,
        //maka kita cek apakah tglnya sudah dimasukkan atau belum
      } else if (lowStatus == "recovered" || lowStatus == "dead") {
        if (out_date_at) {
          const patients = await Patients.create(req.body);
          const data = {
            message: `Resource is added successfully`,
            data: patients,
          };
          res.status(201).json(data);
        } else {
          const data = {
            message: `For recovered and dead resource, out_date_at fields must be filled`,
          };
          res.status(422).json(data);
        }
      } else {
        const data = {
          message: `Status fields must be filled by 'positive' or 'recovered' or 'dead'`,
        };
        res.status(422).json(data);
      }
    } else {
      const data = {
        message: `All fields must be filled correctly`,
      };
      res.status(422).json(data);
    }
  }

  /**
   *
   * @param {*} req
   * @param {*} res
   *
   *  Mengupdate data dengan parameter id
   */
  async update(req, res) {
    const { id } = req.params;
    const { status, out_date_at } = req.body;
    // mencari data dengan id yang di masukan di parameter
    const patients = await Patients.find(id);
    if (patients) {
      // jika data yang dicari berdasarkan id ada lalu
      // kita cek apakah status nya di update atau tidak
      // jika di update kita lakukan validasi seperti saat input data
      // jika status tidak di update maka kita update yang ada
      if (status) {
        if (status == "dead" || status == "recovered") {
          if (out_date_at) {
            const patientsUpdated = await Patients.update(id, req.body);
            const data = {
              message: `Resource is update successfully`,
              data: patientsUpdated,
            };
            res.status(200).json(data);
          } else {
            const data = {
              message: `For recovered and dead resource, out_date_at fields must be filled`,
            };
            res.status(422).json(data);
          }
        } else if (status == "positive") {
          const patientsUpdated = await Patients.update(id, req.body);
          const data = {
            message: `Resource is update successfully`,
            data: patientsUpdated,
          };
          res.status(200).json(data);
        } else {
          const data = {
            message: `Status fields must be filled by 'positive' or 'recovered' or 'dead'`,
          };
          res.status(422).json(data);
        }
      } else {
        const patientsUpdated = await Patients.update(id, req.body);
        const data = {
          message: `Resource is update successfully`,
          data: patientsUpdated,
        };
        res.status(200).json(data);
      }
    } else {
      const data = {
        message: `Resource not found`,
      };
      res.status(404).json(data);
    }
  }

  /**
   *
   * @param {*} req
   * @param {*} res
   *
   *  Menghapus data berdasarkan id
   */
  async destroy(req, res) {
    const { id } = req.params;
    // cek id
    const patients = await Patients.find(id);
    // jika ada maka hapus
    if (patients) {
      await Patients.delete(id);
      const data = {
        message: `Resource is delete successfully`,
      };
      res.status(200).json(data);
    } else {
      const data = {
        message: `Resource not found`,
      };
      res.status(404).json(data);
    }
  }

  /**
   *
   * @param {*} req
   * @param {*} res
   *
   * Menampilkan data berdasarkan id
   */
  async show(req, res) {
    const { id } = req.params;
    //  cek id
    const patients = await Patients.find(id);
    // jika ada maka tampilkan
    if (patients) {
      const data = {
        message: `Get Detail Resource`,
        data: patients,
      };
      res.status(200).json(data);
    } else {
      const data = {
        message: `Resource not found`,
      };
      res.status(404).json(data);
    }
  }

  /**
   *
   * @param {*} req
   * @param {*} res
   * Menampilkan data berdasarkan parameter nama
   */
  async search(req, res) {
    // menyimpan parameter dalam variable
    const names = "%" + req.params.name + "%";
    // mencari data berdasarkan nama dalam parameter
    const patients = await Patients.search(names);
    // jika ada tampilkan
    if (patients) {
      const data = {
        message: `Get searched Resource`,
        data: patients,
      };
      res.status(200).json(data);
    } else {
      const data = {
        message: `Resource not found`,
      };
      res.status(404).json(data);
    }
  }

  /**
   *
   * @param {*} req
   * @param {*} res
   *
   * Menampilkan data berdasarkan status yang positive
   */
  async positive(req, res) {
    // simpan string positive untuk jadi parameter
    const status = "positive";
    // mencari data
    const patients = await Patients.findByStatus(status);
    //jika ada tampilkan
    if (patients) {
      const data = {
        message: `Get positive resource`,
        total: patients.length,
        data: patients,
      };
      res.status(200).json(data);
    } else {
      const data = {
        message: `Resource not found`,
      };
      res.status(404).json(data);
    }
  }

  /**
   *
   * @param {*} req
   * @param {*} res
   *
   * Menampilkan data berdasarkan status yang recovered
   */
  async recovered(req, res) {
    // simpan string positive untuk jadi parameter
    const status = "recovered";
    // mencari data
    const patients = await Patients.findByStatus(status);
    //jika ada tampilkan
    if (patients) {
      const data = {
        message: `Get recovered resource`,
        total: patients.length,
        data: patients,
      };
      res.status(200).json(data);
    } else {
      const data = {
        message: `Resource not found`,
      };
      res.status(404).json(data);
    }
  }

  /**
   *
   * @param {*} req
   * @param {*} res
   *
   * Menampilkan data berdasarkan status yang dead
   */
  async dead(req, res) {
    // simpan string positive untuk jadi parameter
    const status = "dead";
    // mencari data
    const patients = await Patients.findByStatus(status);
    //jika ada tampilkan
    if (patients) {
      const data = {
        message: `Get dead resource`,
        total: patients.length,
        data: patients,
      };
      res.status(200).json(data);
    } else {
      const data = {
        message: `Resource not found`,
      };
      res.status(404).json(data);
    }
  }
}

// buat object
const object = new PatientsController();

// export
module.exports = object;
