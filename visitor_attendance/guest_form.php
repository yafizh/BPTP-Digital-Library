<?php require_once "header.php"; ?>
<style>
    main {
        height: 88vh;
    }

    span a i:hover {
        color: #a8bbbf;
    }

    body {
        font-family: 'Comic Neue', cursive;
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
                                <label for="guest_name" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="guest_name" name="guest_name" autocomplete="off" required>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Jam</label>
                                <input type="time" class="form-control" value="<?= date("H:i"); ?>" disabled required>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Tanggal</label>
                                <input type="date" class="form-control" value="<?= date("Y-m-d"); ?>" disabled required>
                            </div>
                            <div class="col-12" id="guest_profession_field">
                                <label for="guest_profession" class="form-label">Pekerjaan/Profesi</label>
                                <select class="form-select" id="guest_profession" name="guest_profession" required>
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
                                <label for="topic" class="form-label">Topik yang dicari</label>
                                <select class="form-select" name="topic" id="topic" required>
                                    <option value="">Pilih Topik</option>
                                    <option value="UMUR">Umum</option>
                                    <option value="FILSAFAT">Filsafat</option>
                                    <option value="ILMU PENGETAHUAN MASYARAKAT">Ilmu Pengetahuan Masyarakat</option>
                                    <option value="BAHASA">Bahasa</option>
                                    <option value="MATEMATIKA">Matematika</option>
                                    <option value="ILMU PENGETAHUAN TERAPAN">Ilmu Pengetahuan Terapan</option>
                                    <option value="KESENIAN">Kesenian</option>
                                    <option value="LITERATUR">Literatur</option>
                                    <option value="SEJARAH">Sejarah, Biografi</option>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="scripts/guest_form.js"></script>
</body>
</html>