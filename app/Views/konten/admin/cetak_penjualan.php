<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .border-table {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            border-collapse: collapse;
            font-size: 12;
            width: 100%;
        }

        .border-table th {
            border: 1 solid #000;
            font-weight: bold;
            background-color: #e1e1e1;

        }

        .border-table td {
            border: 1 solid #000;
        }

        .caption {
            font-weight: bold;
            font-size: 14;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            margin-bottom: 20px;

        }

        .number {
            text-align: right;
        }
    </style>

</head>

<body>


    <caption class="caption">
        MADANI BACKERY & CAKE <br>
        Laporan Penjualan Produk <br>
        Per periode <?= tanggal_indonesia($tglawal); ?> s/d <?= tanggal_indonesia($tglakhir); ?>
    </caption>
    <hr>
    <br>
    <table class="border-table">
        <thead>
            <th>Tanggal</th>
            <th>ID</th>
            <th>Pelanggan</th>
            <th>Item</th>
            <th>Qty</th>
            <th>Harga</th>
            <th>Jumlah</th>
        </thead>
        <tbody>
            <?php $total = 0; ?>
            <?php foreach ($result as $row) :
            ?>
                <tr>
                    <td><?= $row['transaction_time']; ?></td>
                    <td><?= $row['no_nota']; ?></td>
                    <td><?= $row['customer']; ?></td>
                    <td><?= $row['nm_produk']; ?></td>
                    <td style="text-align: center;"><?= $row['qty']; ?></td>
                    <td class="number"><?= rupiah($row['harga']); ?></td>
                    <td class="number"><?= rupiah($row['total']); ?></td>

                    <?php $total += $row['total'];
                    ?>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="6" style="font-weight: bold; text-align: center">Total Bayar</td>
                <td colspan="1" style="font-weight:bold ;" class="number"><?= rupiah($total); ?></td>
            </tr>
        </tbody>
    </table>
</body>

<?php
function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
function tanggal_indonesia($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );

    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}
function bulan($bulan)
{
    switch ($bulan) {
        case 1:
            $bulan = "Januari";
            break;
        case 2:
            $bulan = "Februari";
            break;
        case 3:
            $bulan = "Maret";
            break;
        case 4:
            $bulan = "April";
            break;
        case 5:
            $bulan = "Mei";
            break;
        case 6:
            $bulan = "Juni";
            break;
        case 7:
            $bulan = "Juli";
            break;
        case 8:
            $bulan = "Agustus";
            break;
        case 9:
            $bulan = "September";
            break;
        case 10:
            $bulan = "Oktober";
            break;
        case 11:
            $bulan = "November";
            break;
        case 12:
            $bulan = "Desember";
            break;
    }
    return $bulan;
} ?>

</html>