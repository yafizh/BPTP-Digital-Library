<?php require_once "header.php"; ?>

<script>
    let data_karyawan = [];
    let data_mahasiswa = [];
    let data_umum = [];
    window.onload = function() {
        const DAY_IN_INDONESIA = [
            "Minggu",
            "Senin",
            "Selasa",
            "Rabu",
            "Kamis",
            "Jumat",
            "Sabtu"
        ];
        $.ajax({
            url: `${(IS_DEVELOPMENT) ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL}web_service/index.php?request=postCustomQuery`,
            type: 'POST',
            data: {
                'query': `
                SELECT 
                    guest_profession, 
                    DATE(guest_come_date_time) AS guest_come_date,
                    DAYOFWEEK(guest_come_date_time) AS day 
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
                            data_karyawan.push({
                                "label": DAY_IN_INDONESIA[value[0].day-1],
                                "y": parseInt(karyawan)
                            });
                            data_umum.push({
                                "label": DAY_IN_INDONESIA[value[0].day-1],
                                "y": parseInt(umum)
                            });
                            data_mahasiswa.push({
                                "label": DAY_IN_INDONESIA[value[0].day-1],
                                "y": parseInt(siswa)
                            });
                        });
                    } else {
                        // website_guest_diagram_data.push(["1-1-2021", 0]);
                    }
                }

            },
        });


        var options = {
            // exportEnabled: true,
            animationEnabled: true,
            // title: {
            //     text: "Kunjungan 1 Minggu Terakhir"
            // },
            // subtitles: [{
            //     text: ""
            // }],
            axisY: {
                // title: "Pengunjung",
                suffix: " Orang",
                titleFontColor: "#000000",
                lineColor: "#4F81BC",
                labelFontColor: "#000000",
                tickColor: "#4F81BC"
            },
            // backgroundColor: "#198754",
            toolTip: {
                shared: true
            },
            legend: {
                cursor: "pointer",
                itemclick: toggleDataSeries
            },
            
            data: [{
                // lineColor: "white",
                // color: "red",
                    type: "line",
                    name: "Karyawan BPTP",
                    showInLegend: true,
                    // xValueFormatString: "MMM YYYY",
                    // yValueFormatString: "# Orang",
                    dataPoints: data_karyawan
                },
                {
                    // lineColor: "white",
                    type: "line",
                    name: "Mahasiswa",
                    // axisYType: "secondary",
                    showInLegend: true,
                    // xValueFormatString: "MMM YYYY",
                    // yValueFormatString: "# Orang",
                    dataPoints: data_mahasiswa
                },
                {
                    // lineColor: "white",
                    type: "line",
                    name: "Umum",
                    // axisYType: "secondary",
                    showInLegend: true,
                    // xValueFormatString: "MMM YYYY",
                    // yValueFormatString: "# Orang",
                    dataPoints: data_umum
                }
            ]
        };

        function toggleDataSeries(e) {
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            } else {
                e.dataSeries.visible = true;
            }
            e.chart.render();
        }

        $("#chartContainer").CanvasJSChart(options);

    }
</script>

<body class="text-white bg-success">
    <main>
        <section class="pt-5 text-center container">
            <div class="row py-lg-2">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-normal">GRAFIK KUNJUNGAN</h1>
                    <div class="d-flex gap-3 mt-3">
                        <a style="flex: 1; position:absolute; top:20px; left:20px;" href="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>visitor_attendance/" class="btn btn-lg btn-secondary fw-bold border-success text-white bg-success">
                            <i class="fas fa-home"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <div class="p-5 bg-white">
            <div id="chartContainer" class="album py-2" style="height: 370px; width: 100%;"></div>
        </div>
    </main>
    <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
</body>

</html>