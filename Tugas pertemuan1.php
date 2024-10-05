<!DOCTYPE html>
<html>
<head>
    <style>
       body {
            font-family: Arial, sans-serif;
            background-image: url('https://png.pngtree.com/background/20220728/original/pngtree-batik-mega-mendung-picture-image_1848909.jpg'); /* Mengganti seluruh background Batik Mega mendung */
            background-size: cover; /* Agar gambar menutupi seluruh background */
            background-position: center; /* Untuk menempatkan gambar di tengah */
            background-repeat: no-repeat; /* Mencegah pengulangan gambar */
            color: #ffffff; /* Warna teks */
    }

        h1 {
            text-align: center;
            color: white; /* Mengubah warna judul menjadi hitam */
        }
        .form-container {
            max-width: 400px;
            margin: 0 auto;
            background-color: rgba(52, 98, 167, 0.9); /* Warna latar belakang form */
            padding: 45px;
            border-radius: 5px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #ffffff; /* Mengubah warna label menjadi putih */
        }
        input[type="text"], input[type="number"] {
            width: 85%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        input[type="submit"] {
            background-color: #28a745; /* Warna tombol */
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            
        }
        input[type="submit"]:hover {
            background-color: #218838; /* Warna tombol saat hover */
        }
        .result {
            text-align: center;
            margin-top: 18px; /* Menambahkan jarak antara form dan hasil */
            font-size: 17px;
            font-weight: bold;
            color: #ffffff;
            
        }

    </style>
</head>
<head>
    <title>Hitung Diskon Belanja</title>
</head>
<body>
    <div class="form-container">
        <h1>Selamat Datang Di Toko Batik Dima</h1>
        <form method="POST" action="">
            <label>Nama Pelanggan</label>
            <input type="text" name="napeng" placeholder="Masukkan Nama Pelanggan" required>

            <label>Apakah pembeli member? </label>
            <input type="text" name="is_member" placeholder="Masukkan 'ya' atau 'tidak'" required>

            <label>Total Belanja</label>
            <input type="number" name="total_belanja" step="0.01" placeholder="Masukkan Jumlah Total Belanja" required min="0">

            <input type="submit" name="submit" value="Hitung Total " > 
        </form>

        <?php
        // Fungsi untuk menghitung total pembelian setelah diskon
        function hitung_total_pembelian($napeng, $is_member, $total_belanja) {
            $diskon = 0.0; // Default tanpa diskon

            // Logika untuk member
            if ($is_member) {
                if ($total_belanja >= 500000) {
                    $diskon = 0.10; // Diskon 10% jika belanja >= 500.000
                } elseif ($total_belanja >= 300000) {
                    $diskon = 0.05; // Diskon 5% jika belanja >= 300.000
                } else {
                    $diskon = 0.10; // Diskon 10% jika belanja < 300.000
                }
            } 
            // Logika untuk non-member
            else {
                if ($total_belanja >= 500000) {
                    $diskon = 0.10; // Diskon 10% jika belanja >= 500.000
                }
                // Jika belanja < 500.000, tidak ada diskon
            }

            // Hitung total setelah diskon
            $total_setelah_diskon = $total_belanja - ($total_belanja * $diskon);
            return [$total_setelah_diskon, $diskon];
        }

        // Cek apakah form sudah disubmit
        if (isset($_POST['submit'])) {
            $napeng = $_POST['napeng'];  // Nama pelanggan
            $is_member = strtolower($_POST['is_member']) === 'ya';
            $total_belanja = (float)$_POST['total_belanja'];

            // Hitung total setelah diskon
            list($total_bayar, $diskon) = hitung_total_pembelian($napeng, $is_member, $total_belanja);

            // Tampilkan hasil
            echo "<div class='result'>";
            echo "Nama Pelanggan: " . htmlspecialchars($napeng) . "<br>";
            echo "Total Bayar   : " . number_format($total_belanja) . "<br>";
            echo "Mendapatkan Diskon: " . number_format($diskon * 100, 0) . "%<br>";
            echo "Total Keseluruhan: Rp " . number_format($total_bayar, 2, ',', '.') . "<br>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
