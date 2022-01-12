<?php
require_once "../database/Connection.php";
require_once "../../app/utils/helper.php";
$year_month = $_POST['year-month'];
$year = explode("-", $year_month)[0];
$month = explode("-", $year_month)[1];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Koleksi Terbaru Bulan <?= MONTH_IN_INDONESIA[$month - 1] . ' ' . $year; ?></title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        table {
            width: 100%;
        }

        .text-center {
            text-align: center;
        }

        #kop {
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div id="kop" class="d-flex justify-content-center gap-5">
            <img src="../../assets/logo.png" height="150" alt="">
            <div class="text-center" style="flex: 1;">
                <h2>
                    Balai Pengkajian Teknologi Pertanian
                    <br>
                    Kalimantan Selatan
                </h2>
                <p>
                    Alamat: Jl. Panglima Batur No.4, Loktabat Utara, Kec. Banjarbaru Utara, Kota Banjar Baru, Kalimantan Selatan 70711
                    <br>
                    Nomor Telepon: (0511) 4772346
                </p>
            </div>
        </div>

        <h2 class="text-center my-3" style="border-top: 2px solid black;">Laporan Koleksi Terbaru Bulan <?= MONTH_IN_INDONESIA[$month - 1] . ' ' . $year; ?></h2>
        <table>
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th>Judul</th>
                    <th>ISBN</th>
                    <th>Pengarang</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $result = $conn->query("SELECT * FROM new_book_collection_view WHERE MONTH(book_new_collection_date)='$month' AND YEAR(book_new_collection_date)='$year'");
                ?>
                <?php if ($result->num_rows) : ?>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td><?= $row['book_title']; ?></td>
                            <td class="text-center"><?= $row['book_isbn']; ?></td>
                            <td class="text-center"><?= $row['book_author']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php endif; ?>
                <?php $result->free_result(); ?>
            </tbody>
        </table>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>