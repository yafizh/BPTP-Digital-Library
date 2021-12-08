const university = `
    <div class="col-12 added">
        <label for="guest-university" class="form-label">Nama Universitas</label>
        <select class="form-select" name="guest-university" id="guest-university" required>
            <option value="">Pilih Universitas</option>
            <option value="Universitas Lambung Mangkurat">Universitas Lambung Mangkurat</option>
            <option value="Universitas Islam Kalimantan">Universitas Islam Kalimantan</option>
            <option value="Sekolah Tinggi Manajemen Informatika dan Komputer">Sekolah Tinggi Manajemen Informatika dan Komputer</option>
        </select>
    </div>
    <div class="col-12 added">
        <label for="guest-study-program" class="form-label">Fakultas</label>
        <select class="form-select" id="guest-study-program" name="guest-study-program" required>
            <option value="">Pilih Fakultas</option>
            <option value="Teknologi Informasi">Teknologi Informasi</option>
            <option value="Ilmu Humaniora">Ilmu Humaniora</option>
            <option value="Ilmu Sosial">Ilmu Sosial</option>
        </select>
    </div>
`;

const employees = `
    <div class="col-12 added">
        <label for="guest-division" class="form-label">Bagian Umum</label>
        <select class="form-select" name="guest-division" id="guest-division" required>
            <option value="">Pilih Bagian</option>
            <option>Peneliti</option>
            <option>Penyuluh</option>
            <option>Karyawan/Karyawati</option>
        </select>
    </div>
`;

$('#guest-profession').on('change', function () {
    $(".added").remove();
    if ($(this).val() === 'STUDENT')
        $("#guest_profession_field").after(university)
    else if ($(this).val() === 'BPTP_EMPLOYEE')
        $("#guest_profession_field").after(employees)
});

$("form").on("submit", function (e) {
    e.preventDefault();
    let guest_data = {
        "book-category-id": $("#book-category").val(),
        "guest-full-name": $("#full-name").val(),
        "guest-come-date-time": $("#date-come").val() + " " + $("#time-come").val(),
        "guest-come-reason": $("#visit_purpose").val()
    };
    if ($("#guest-profession").val() === 'STUDENT') {
        guest_data["guest-profession"] = JSON.stringify(
            {
                "guest-profession": $("#guest-profession option:selected").val(),
                "guest-university": $("#guest-university option:selected").text(),
                "guest-study-program": $("#guest-study-program option:selected").text()
            }
        );
    }
    else if ($("#guest-profession").val() === 'BPTP_EMPLOYEE') {
        guest_data["guest-profession"] = JSON.stringify(
            {
                "guest-profession": $("#guest-profession option:selected").val(),
                "guest-division": $("#guest-division option:selected").text(),
            }
        );
    } else {
        guest_data["guest-profession"] = JSON.stringify(
            {
                "guest-profession": $("#guest-profession option:selected").val(),
            }
        );
    }

    $.ajax({
        url: `${IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL}web_service/?request=postGuest`,
        type: 'POST',
        data: {
            "guest": guest_data
        },
        dataType: 'json',
        success: function (response) {
            if (response.isSuccess) {
                Swal.fire({
                    title: 'Berhasil Mengisi Buku Tamu',
                    icon: 'success',
                    showConfirmButton: false
                }).then((result) => {
                    if (result.isDismissed) {
                        location.replace(`${IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL}visitor_attendance`);
                    }
                });
            } else {
                console.log(response);
                Swal.fire({
                    title: 'Gagal Mengisi Buku Tamu',
                    icon: 'error',
                    showConfirmButton: false
                });
            }
        }
    });
});