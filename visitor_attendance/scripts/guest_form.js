const university = `
    <div class="col-12 added">
        <label for="country" class="form-label">Nama Universitas</label>
        <select class="form-select" id="country" required>
            <option value="">Pilih Universitas</option>
            <option>Universitas Lambung Mangkurat</option>
            <option>Universitas Islam Kalimantan</option>
            <option>Sekolah Tinggi Manajemen Informatika dan Komputer</option>
        </select>
        <div class="invalid-feedback">
            Please select a valid country.
        </div>
    </div>
    <div class="col-12 added">
        <label for="country" class="form-label">Fakultas</label>
        <select class="form-select" id="country" required>
            <option value="">Pilih Fakultas</option>
            <option>Teknologi Informasi</option>
            <option>Ilmu Humaniora</option>
            <option>Ilmu Sosial</option>
        </select>
    </div>
`;

const employees = `
    <div class="col-12 added">
        <label for="country" class="form-label">Bagian Umum</label>
        <select class="form-select" id="country" required>
            <option value="">Pilih Bagian</option>
            <option>Peneliti</option>
            <option>Penyuluh</option>
            <option>Karyawan/Karyawati</option>
        </select>
    </div>
`;

$('#guest_profession').on('change', function () {
    $(".added").remove();
    if ($(this).val() === 'STUDENT')
        $("#guest_profession_field").after(university)
    else if ($(this).val() === 'BPTP_EMPLOYEE')
        $("#guest_profession_field").after(employees)
});

$("form").on("submit", function(e){
    e.preventDefault();
    location.replace("thanks.php");
});