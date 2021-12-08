<?php require_once "header.php"; ?>
<style>
    span a i:hover {
        color: #a8bbbf;
    }
</style>

<body class="bg-success text-white">
    <div class="container">
        <main class="p-5">
            <div class="py-3">
                <div class="d-flex justify-content-between">
                    <h3 class="fw-bold">
                        <span>
                            <a class="text-white" href="index.php"><i class="fas fa-arrow-left me-3"></i></a>
                        </span>Laporan Pengunjung
                    </h3>
                    <h3 class="fw-bold">
                        Grafik Pengunjung<span>
                            <a class="text-white" href="visitor.php"><i class="fas fa-arrow-right ms-3"></i></a>
                        </span>
                    </h3>
                </div>
                <hr>
            </div>
            <table class="table text-white table-borderless table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col">Nama Pengunjung</th>
                        <th scope="col">Waktu Kunjungan</th>
                        <th scope="col">Pekerjaan/Profesi</th>
                        <th scope="col">Topik</th>
                    </tr>
                    <tr>
                        <th scope="col" class="text-center" style="vertical-align: middle;">
                            <i class="fas fa-search"></i>
                        <td scope="col">
                            <input type="text" class="form-control">
                        </td>
                        <td scope="col">
                            <input type="date" class="form-control">
                        </td>
                        <td scope="col">
                            <select class="form-select" id="guest_profession" name="guest_profession" required>
                                <option value="" selected>Pilih Pekerjaan/Profesi</option>
                                <option value="GENERAL">Umum</option>
                                <option value="STUDENT">Mahasiswa</option>
                                <option value="BPTP_EMPLOYEE">Karyawan BPTP</option>
                            </select>
                        </td>
                        <td scope="col">
                            <select id="book-category-id" class="form-select" name="book-category-id">
                                <option value="" selected>Semua</option>
                                <option value="1">Umum</option>
                                <option value="2">Filsafat</option>
                                <option value="3 PENGETAHUAN MASYARAKAT">Ilmu Pengetahuan Masyarakat</option>
                                <option value="4">Bahasa</option>
                                <option value="5">Matematika</option>
                                <option value="6 PENGETAHUAN TERAPAN">Ilmu Pengetahuan Terapan</option>
                                <option value="7">Kesenian</option>
                                <option value="8">Literatur</option>
                                <option value="10">Sejarah, Biografi</option>
                            </select>
                        </td>
                    </tr>
                </thead>
                <tbody style="height:400px;">
                </tbody>
            </table>
            <nav aria-label="..." class="mt-5">
                <ul class="pagination justify-content-center"></ul>
            </nav>
        </main>
    </div>
    <script>
        const capitalizeTheFirstLetterOfEachWord = (words) => {
            var separateWord = words.toLowerCase().split(' ');
            for (var i = 0; i < separateWord.length; i++) {
                separateWord[i] = separateWord[i].charAt(0).toUpperCase() +
                    separateWord[i].substring(1);
            }
            return separateWord.join(' ');
        }

        const MONTH_IN_INDONESIA = [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "July",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember"
        ];

        const dateToIndonesiaDateFormat = (date) => {
            const day = date.split('-')[2];
            const month = date.split('-')[1];
            const year = date.split('-')[0];

            return `${day} ${MONTH_IN_INDONESIA[month-1]} ${year}`
        }




        function findGetParameter(parameterName) {
            var result = null,
                tmp = [];
            var items = location.search.substr(1).split("&");
            for (var index = 0; index < items.length; index++) {
                tmp = items[index].split("=");
                if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
            }
            return result;
        }

        const getData = page => {
            $.ajax({
                url: `${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL}web_service/?request=postCustomQuery`,
                type: 'POST',
                data: {
                    'query': `
                    SELECT
                        guest_table.guest_full_name,
                        DATE(guest_table.guest_come_date_time) AS guest_come_date_time,
                        guest_table.guest_profession,
                        book_category_table.* 
                    FROM guest_table INNER JOIN book_category_table ON guest_table.book_category_id=book_category_table.book_category_id 
                    ORDER BY guest_table.guest_id DESC
                `
                },
                dataType: 'json',
                success: function(response) {
                    console.log(response)
                    if (response.isSuccess) {
                        const batas = 10;
                        let halaman = page;
                        let halaman_awal = (halaman > 1) ? (halaman * batas) - batas : 0;

                        let previous = halaman - 1;
                        let next = halaman + 1;


                        let data = response.data;
                        let jumlah_data = data.length;
                        let total_halaman = Math.ceil(jumlah_data / batas);

                        let data_pegawai = data.splice(halaman_awal, batas);
                        let nomor = halaman_awal + 1;



                        $('.pagination').html('');
                        $(".pagination").append(`
                        <li class="page-item ${(halaman <= 1) ? 'disabled':''}">
                            <a class="page-link ${(halaman <= 1) ? '':'text-success'}" onclick="getData(${parseInt(page)-1})" href="#" tabindex="-1" ${(halaman <= 1) ? 'aria-disabled="true"':''}>Sebelumnya</a>
                        </li>
                    `);

                        for (let x = 1; x <= total_halaman; x++) {
                            if (x == halaman) {
                                $(".pagination").append(`
                                <li class="page-item" aria-current="page">
                                    <label class="page-link text-success" style="background-color:#C0C0C0;border:1px solid #C0C0C0;">${x}</label>
                                </li>
                            `);
                            } else {
                                $(".pagination").append(`
                                <li class="page-item"><a class="page-link text-success" onclick="getData(${parseInt(x)})" href="#">${x}</a></li>
                            `);
                            }
                        }
                        $(".pagination").append(`
                        <li class="page-item ${(halaman < total_halaman) ? '':'disabled'}">
                            <a class="page-link ${(halaman < total_halaman) ? 'text-success':''}" onclick="getData(${parseInt(page)+1})" href="#" ${(halaman < total_halaman) ? '':'aria-disabled="true"'}>Selanjutnya</a>
                        </li>
                    `);

                        $('tbody').html('');
                        $.each(data_pegawai, function(index, value) {
                            $('tbody').append(`
                        <tr>
                            <th scope="row" class="text-center">${nomor}</th>
                            <td><label class="ms-1">${value.guest_full_name}</label></td>
                            <td><label class="ms-1">${dateToIndonesiaDateFormat(value.guest_come_date_time)}</label></td>
                            <td><label class="ms-1">${capitalizeTheFirstLetterOfEachWord(JSON.parse(value.guest_profession)['guest-profession'])}</label></td>
                            <td><label class="ms-1">${capitalizeTheFirstLetterOfEachWord(value.book_category)}</label></td>
                        </tr>                        
                        `)
                            nomor++;
                        })
                    }
                },
            });
        }
        getData(1);
    </script>
</body>

</html>