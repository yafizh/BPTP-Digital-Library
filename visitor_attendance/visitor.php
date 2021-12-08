<?php require_once "header.php"; ?>

<body class="bg-success text-white">
    <div class="container">
        <main class="mt-5 ps-5 pe-5">
            <div class="py-3">
                <h3 class="fw-bold">
                    <span>
                        <a class="text-white" href="index.php"><i class="fas fa-arrow-left me-3"></i></a>
                    </span>Grafik Pengunjung
                </h3>
                <hr>
            </div>
            <div class="p-5 bg-white">
                <div id="chartContainer" class="album py-2" style="height: 370px; width: 100%;"></div>
            </div>
        </main>
    </div>
    <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>

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
            title: {
                text: "Kunjungan 1 Minggu Terakhir di Perpustakaan BPTP KALSEL"
            },
            subtitles: [{
                text: ""
            }],
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
</body>

</html>