<?php

include '../pages/auth/koneksi.php';

// var_dump($_FILES);
if ($_POST['upload']) {
    $pendaftaran = $_POST['id_formulir'];
    // $id_asesmen    = $_POST['id_asesmen'];
    $ekstensi_diperbolehkan = array('pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png');
    $skj    = $_FILES['skj']['name'];
    $sksehat    = $_FILES['sksehat']['name'];
    $suratorangtua    = $_FILES['suratorangtua']['name'];
    $suratpakta    = $_FILES['suratpakta']['name'];
    $transkipnilai    = $_FILES['transkipnilai']['name'];
    $cv    = $_FILES['cv']['name'];
    $pelatihan    = $_FILES['pelatihan']['name'];
    $produk    = $_FILES['produk']['name'];
    $dokumen    = $_FILES['dokumen']['name'];
    // $x        = explode('.', $_FILES['produk']['name']);
    $ekstensi    = "pdf";
    // strtolower(end($x));
    $ukuran        = $_FILES['skj']['size'];
    $file_tmp    = $_FILES['skj']['tmp_name'];
    $file_tmp2    = $_FILES['sksehat']['tmp_name'];
    $file_tmp3   = $_FILES['suratorangtua']['tmp_name'];
    $file_tmp4    = $_FILES['suratpakta']['tmp_name'];
    $file_tmp5    = $_FILES['transkipnilai']['tmp_name'];
    $file_tmp6    = $_FILES['cv']['tmp_name'];
    $file_tmp7    = $_FILES['pelatihan']['tmp_name'];
    $file_tmp8    = $_FILES['produk']['tmp_name'];
    $file_tmp9    = $_FILES['dokumen']['tmp_name'];

    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        if ($ukuran < 104407000000) {
            // Lokasi Penempatan file
            $dirUpload = "../file_asesmen/";
            $linkskj = $dirUpload . $skj;
            $linksehat = $dirUpload . $sksehat;
            $linksuratorangtua = $dirUpload . $suratorangtua;
            $linksuratpakta = $dirUpload . $suratpakta;
            $linktranskipnilai = $dirUpload . $transkipnilai;
            $linkcv = $dirUpload . $cv;
            $linkpelatihan = $dirUpload . $pelatihan;
            $linkproduk = $dirUpload . $produk;
            $linkdokumen = $dirUpload . $dokumen;
            // Menyimpan file
            $terupload = move_uploaded_file($file_tmp, $linkskj);
            $terupload2 = move_uploaded_file($file_tmp2, $linksehat);
            $terupload3 = move_uploaded_file($file_tmp3, $linksuratorangtua);
            $terupload4 = move_uploaded_file($file_tmp4, $linksuratpakta);
            $terupload5 = move_uploaded_file($file_tmp5, $linktranskipnilai);
            $terupload6 = move_uploaded_file($file_tmp6, $linkcv);
            $terupload7 = move_uploaded_file($file_tmp7, $linkpelatihan);
            $terupload8 = move_uploaded_file($file_tmp8, $linkproduk);
            $terupload9 = move_uploaded_file($file_tmp9, $linkdokumen);
            if ($terupload) {
                $query    = mysqli_query($koneksi, "INSERT INTO asesmen VALUES(DEFAULT,$pendaftaran ,  '$ekstensi', '$linkskj', '$linksehat', '$linksuratorangtua', '$linksuratpakta', '$linktranskipnilai', '$linkcv','$linkpelatihan', '$linkproduk', '$linkdokumen')");
                if ($query) {
                    echo '<script type="text/javascript">
                    alert("FILE BERHASIL DI UPLOAD!");
                    window.location = "../pages/asesmen_simpan.php";
                 </script>';
                } else {
                    echo "FILE GAGAL DI UPLOAD!";
                }
            } else {
                echo "UKURAN FILE TERLALU BESAR!";
            }
        }
    } else {
        echo "EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN!";
    }
}
