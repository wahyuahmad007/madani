<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Nota</title>

    <style>
        * {
            margin: 0;
            padding: 3px;
            font-family: monospace;

        }

        .border-table {
            border-collapse: collapse;
            text-align: center;
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
            font-family: Arial, Helvetica, sans-serif;
            border-bottom: 1px solid;
        }
    </style>
</head>

<body>
    <table style=" width:100%;">
        <table class="caption" style="  width:100%;">

            <tr>
                <td width="30px" ;> <img src="<?= base_url(); ?>/lib/res/logo.jpeg" style=" width: 80px; height:auto; ">
                </td>
                <td>
                    <span style="line-height: 1.6; font-size:14px; ">
                        CV. MADANI BAKERY & CAKE
                        <br> Jl.Kirigo Dito Dk.Semampir
                        <br>
                        Ds.Tragung Kandeman Batang
                    </span>
                </td>
            </tr>
        </table>

        <table width="100%">
            <tr>
                <td width=150px;>Tanggal</td>
                <td>:</td>
                <td><?=$histori['transaction_time']; ?></td>
            </tr>
            <tr>
                <td>Nama Pelanggan</td>
                <td width=4px;>:</td>
                <td><?= $histori['customer']; ?></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td><?= $histori['alamat']; ?></td>
            </tr>
            <tr>
                <td>Telp</td>
                <td>:</td>
                <td><?= $histori['no_telp']; ?></td>
            </tr>
        </table>
        <br>
        <table class="border-table">
            <thead>
                <th>No</th>
                <th>Item </th>
                <th>Harga</th>
                <th>Jumlah </th>
                <th>Sub Total</th>
            </thead>
            <tbody>



                <?php $subtotal = 0;
                $no = 1; ?>
                <?php foreach ($result as $value) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $value['nm_produk'] ?></td>
                        <td><?= rupiah($value['harga']) ?></td>
                        <td><?= $value['qty'] ?></td>
                        <td><?= rupiah($value['total']) ?></td>

                    </tr>
                    <?php $subtotal += $value['total'] ?>
                <?php endforeach; ?>
                <tr>
                    <td colspan=4; class="txt-left">Sub Total</td>
                    <td><?= rupiah($subtotal) ?></td>
                </tr>


            </tbody>
        </table>
        <br>
        <tr>
            <td colspan="4" align="center" ;>* Terima Kasih Atas Kunjungan Anda *</td>

        </tr>
    </table>
</body>
<?php
function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}
function tgl_indo($tgl)
{
    $tanggal = substr($tgl, 8, 2);
    $bulan = getBulan(substr($tgl, 5, 2));
    $tahun = substr($tgl, 0, 4);

    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}

function getBulan($bln)
{
    switch ($bln) {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}
?>

</html>