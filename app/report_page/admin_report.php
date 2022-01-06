<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Admin</title>
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

        <h2 class="text-center my-3" style="border-top: 2px solid black;">Laporan Admin</h2>
        <table>
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th>Username</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                require_once "../database/Connection.php";
                $result = $conn->query("SELECT * FROM user_table");
                ?>
                <?php if ($result->num_rows) : ?>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td class="text-center"><?= $row['user_username']; ?></td>
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