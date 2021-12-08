<?php require_once 'header.php' ?>

<body>
    <main>
        <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                <svg class="bi me-5" width="40" height="32">
                    <use xlink:href="#bootstrap" />
                </svg>
                <span class="fs-4">Admin</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li>
                    <a href="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>information_system/app/home_page.php" class="nav-link link-dark">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#home" />
                        </svg>
                        Halaman Utama
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>information_system/app/admin_page/beranda.php" class="nav-link active" aria-current="page" id="beranda">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#speedometer2" />
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>information_system/app/admin_page/add_catalog_page.php" class="nav-link link-dark" id="katalog">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#grid" />
                        </svg>
                        Katalog
                    </a>
                </li>
                <li>
                    <a href="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>information_system/app/admin_page/report_page.php" class="nav-link link-dark" id="reporty">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#table" />
                        </svg>
                        Laporan
                    </a>
                </li>
                <li>
                    <a href="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>information_system/app/admin_page/change_password_page.php" class="nav-link link-dark" id="ganti_password">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#people-circle" />
                        </svg>
                        Ganti Password
                    </a>
                </li>
                <li>
                    <a href="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>information_system/app/admin_page/login_page.php" class="nav-link link-dark">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#logout" />
                        </svg>
                        Keluar
                    </a>
                </li>
            </ul>
        </div>

        <div class="b-example-divider" style="position: relative; z-index:9;"></div>

        <div class="d-flex flex-column flex-grow-1 p-3 bg-light">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                <span class="fs-4">Dashboard</span>
            </a>
            <hr>
            <div class="d-flex flex-column h-100">
                <div class="d-flex mb-3" style="flex: 1;">
                    <div class="card me-3" style="flex:1;">
                        <div id="curve_chart1" class="mb-3 " style="width: 100%; height:100%;"></div>
                    </div>
                    <div class="card" style="flex:1;">
                        <div id="curve_chart2" class="mb-3 " style="width: 100%; height:100%;"></div>
                    </div>
                </div>
                <div class="d-flex" style="flex: 1;">
                    <div class="card me-3" style="flex:1;">
                        <div id="curve_chart3" class="mb-3 " style="width: 100%; height:100%;"></div>
                    </div>
                    <div class="card" style="flex:1;">
                        <div id="piechart" class="" style="width: 100%; height:100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        google.charts.setOnLoadCallback(drawChart2);

        google.charts.setOnLoadCallback(drawChart3);
        google.charts.setOnLoadCallback(drawChartPie);

        const DAY_IN_INDONESIA = [
            "Minggu",
            "Senin",
            "Selasa",
            "Rabu",
            "Kamis",
            "Jumat",
            "Sabtu",
            "Minggu"
        ];
        let guest_diagram_data = [
            ['Hari', 'Umum', 'Mahasiswa', 'Karyawan BPTP']
        ];
        $.ajax({
            url: `${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL}web_service/index.php?request=postCustomQuery`,
            type: 'POST',
            data: {
                'query': `
                SELECT 
                    guest_profession, 
                    DATE(guest_come_date_time) AS guest_come_date 
                FROM 
                    guest_table 
                WHERE guest_come_date_time > NOW() - INTERVAL 5 DAY
                `
            },
            dataType: 'json',
            async: false,
            success: function(response) {
                if (response.isSuccess) {
                    if (response.data.length) {
                        let visitor_per_date = {};
                        $.each(response.data, function(index, value) {
                            if (value.guest_come_date in visitor_per_date) {
                                visitor_per_date[value.guest_come_date].push(value);
                            } else {
                                visitor_per_date[value.guest_come_date] = [value];
                            }
                        });

                        $.each(visitor_per_date, function(index, value) {
                            const d = new Date(index);
                            let day = d.getDay()

                            let umum = 0;
                            let siswa = 0;
                            let karyawan = 0;
                            $.each(value, function(index, value) {
                                if (JSON.parse(value.guest_profession)['guest-profession'] == 'GENERAL') {
                                    umum++;
                                } else if (JSON.parse(value.guest_profession)['guest-profession'] == 'STUDENT') {
                                    siswa++;
                                } else if (JSON.parse(value.guest_profession)['guest-profession'] == 'BPTP_EMPLOYEE') {
                                    karyawan++;
                                }
                            });
                            guest_diagram_data.push([DAY_IN_INDONESIA[day], umum, siswa, karyawan]);
                        });
                    } else {
                        guest_diagram_data.push(["Senin", 0,0,0]);
                    }
                }

            },
        });










        let website_guest_diagram_data = [
            ['Tanggal', 'Pengunjung'],
        ];
        $.ajax({
            url: `${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL}web_service/index.php?request=postCustomQuery`,
            type: 'POST',
            data: {
                'query': `
                    SELECT 
                        COUNT(website_guest_id) AS visitor, 
                        DATE(website_guest_date_time_enter) AS website_guest_date_time_enter
                    FROM 
                        website_guest_table WHERE website_guest_date_time_enter > (NOW() - INTERVAL 7 DAY) 
                    GROUP BY 
                        DATE(website_guest_date_time_enter)
                `
            },
            dataType: 'json',
            async: false,
            success: function(response) {
                if (response.isSuccess) {
                    if (response.data.length) {
                        $.each(response.data, function(index, value) {
                            website_guest_diagram_data.push([value.website_guest_date_time_enter, parseInt(value.visitor)]);
                        });
                    } else {
                        website_guest_diagram_data.push(["1-1-2021", 0]);
                    }
                }

            },
        });


        let android_guest_diagram_data = [
            ['Tanggal', 'Pengunjung'],
        ];
        $.ajax({
            url: `${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL}web_service/index.php?request=postCustomQuery`,
            type: 'POST',
            data: {
                'query': `
                    SELECT 
                        COUNT(android_guest_id) AS visitor, 
                        DATE(android_guest_date_time_enter) AS android_guest_date_time_enter
                    FROM 
                        android_guest_table WHERE android_guest_date_time_enter > NOW() - INTERVAL 7 DAY 
                    GROUP BY 
                        DATE(android_guest_date_time_enter)
                `
            },
            dataType: 'json',
            async: false,
            success: function(response) {
                if (response.isSuccess) {
                    if (response.data.length) {
                        $.each(response.data, function(index, value) {
                            android_guest_diagram_data.push([value.android_guest_date_time_enter, parseInt(value.visitor)]);
                        });
                    } else {
                        android_guest_diagram_data.push(["1-1-2021", 0]);
                    }
                }

            },
        });







        let pie_chart = [
                ['Task', 'Hours per Day'],
                // ['Android', 11],
                // ['Website', 2],
                // ['Kantor BPTP', 2]
            ];
        $.ajax({
            url: `${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL}web_service/?request=postCustomQuery`,
            type: 'POST',
            data: {
                'query': `
                    SELECT COUNT(website_guest_id) AS website_guest FROM website_guest_table WHERE website_guest_date_time_enter > NOW() - INTERVAL 1 MONTH;
                `
            },
            dataType: 'json',
            async: false,
            success: function(response) {
                if (response.isSuccess) {
                    if (response.data.length) {
                        pie_chart.push(['Website', parseInt(response.data[0].website_guest)])
                    } else {
                        console.log('Data Kosong')
                    }
                }
            },
        });

        $.ajax({
            url: `${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL}web_service/index.php?request=postCustomQuery`,
            type: 'POST',
            data: {
                'query': `
                    SELECT COUNT(guest_id) AS guest_visitor FROM guest_table WHERE guest_come_date_time > NOW() - INTERVAL 1 MONTH;
                `
            },
            dataType: 'json',
            async: false,
            success: function(response) {
                if (response.isSuccess) {
                    if (response.data.length) {
                        pie_chart.push(['Kantor BPTP', parseInt(response.data[0].guest_visitor)])
                    } else {
                        console.log('Data Kosong')
                    }
                }
            },
        });

        $.ajax({
            url: `${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL}web_service/index.php?request=postCustomQuery`,
            type: 'POST',
            data: {
                'query': `
                SELECT COUNT(android_guest_id) AS android_guest FROM android_guest_table WHERE android_guest_date_time_enter > NOW() - INTERVAL 1 MONTH;
                `
            },
            dataType: 'json',
            async: false,
            success: function(response) {
                console.log(response)
                if (response.isSuccess) {
                    if (response.data.length) {
                        pie_chart.push(['Android', parseInt(response.data[0].android_guest)])
                    }
                }
            },
        });


        function drawChart() {
            // var data = google.visualization.arrayToDataTable([
            //     ['Hari', 'Umum', 'Mahasiswa', 'Karyawan BPTP'],
            //     ['Senin', 0, 0, 0],
            //     ['Selasa', 0, 0, 0],
            //     ['Rabu', 0, 0, 0],
            //     ['Kamis', 0, 0, 0],
            //     ['Jumat', 0, 0, 0],
            // ]);
            var data = google.visualization.arrayToDataTable(guest_diagram_data);

            var options = {
                title: 'Kunjungan Website BPTP 1 Minggu Terakhir',
                curveType: 'function',
                legend: {
                    position: 'bottom'
                },
                titleTextStyle: {
                    fontSize: 16
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart1'));

            chart.draw(data, options);
        }

        function drawChart2() {
            var data = google.visualization.arrayToDataTable(website_guest_diagram_data);

            var options = {
                title: 'Kunjungan Website BPTP 1 Minggu Terakhir',
                curveType: 'function',
                legend: {
                    position: 'bottom'
                },
                titleTextStyle: {
                    fontSize: 16
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart2'));

            chart.draw(data, options);
        }

        function drawChart3() {
            var data = google.visualization.arrayToDataTable(android_guest_diagram_data);

            var options = {
                title: 'Kunjungan Mobile App BPTP 1 Minggu Terakhir',
                curveType: 'function',
                legend: {
                    position: 'bottom'
                },
                titleTextStyle: {
                    fontSize: 16
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart3'));

            chart.draw(data, options);
        }


        function drawChartPie() {

            var data = google.visualization.arrayToDataTable(pie_chart);

            var options = {
                title: 'Pengunjung Perpustakaan Bulan Ini',
                titleTextStyle: {
                    fontSize: 16
                }
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }
    </script>