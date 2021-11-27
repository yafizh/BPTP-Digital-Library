<?php require_once "header.php"; ?>
<style>
    span a i:hover {
        color: #a8bbbf;
    }
</style>

<body class="bg-success text-white">
    <div class="container">
        <main class="mt-5 ps-5 pe-5">
            <div class="py-3">
                <h3 class="fw-bold">
                    <span>
                        <a class="text-white" href="index.php"><i class="fas fa-arrow-left me-3"></i></a>
                    </span>Identitas
                </h3>
                <hr>
            </div>
            <form>
                <div class="row g-5">
                    <div class="col-md-6 col-lg-6">
                        <div class="row g-3">
                            <div class="col-sm-12">
                                <label for="full-name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="full-name" name="full-name" autocomplete="off" required>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="time-come">Jam</label>
                                <input type="time" class="form-control" id="time-come" name="time-come" value="<?= date("H:i"); ?>" disabled required>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="date-come">Tanggal</label>
                                <input type="date" class="form-control" id="date-come" name="date-come" value="<?= date("Y-m-d"); ?>" disabled required>
                            </div>
                            <div class="col-12" id="guest_profession_field">
                                <label for="guest-profession" class="form-label">Pekerjaan/Profesi</label>
                                <select class="form-select" id="guest-profession" name="guest-profession" required>
                                    <option value="">Pilih Pekerjaan/Profesi</option>
                                    <option value="GENERAL">Umum</option>
                                    <option value="STUDENT">Mahasiswa</option>
                                    <option value="BPTP_EMPLOYEE">Karyawan BPTP</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="book-category" class="form-label">Topik yang dicari</label>
                                <select class="form-select" name="book-category" id="book-category" required>
                                    <option value="">Pilih Topik</option>
                                    <option value="1">Umum</option>
                                    <option value="2">Filsafat</option>
                                    <option value="3">Ilmu Pengetahuan Masyarakat</option>
                                    <option value="4">Bahasa</option>
                                    <option value="5">Matematika</option>
                                    <option value="6">Ilmu Pengetahuan Terapan</option>
                                    <option value="7">Kesenian</option>
                                    <option value="8">Literatur</option>
                                    <option value="9">Sejarah, Biografi</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="visit_purpose" class="form-label">Tujuan Kunjungan</label>
                                <textarea id="visit_purpose" name="visit_purpose" autocomplete="off" cols="30" rows="5" required class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="mt-3 d-flex justify-content-end">
                            <button type="submit" class="btn fw-bold border-success text-success bg-light">Kunjungi Perpustakaan</button>
                        </div>
                    </div>
                </div>
            </form>
        </main>
    </div>
    <script src="scripts/guest_form.js"></script>
</body>
</html>