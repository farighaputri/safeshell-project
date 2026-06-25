<?php
$submitted = false;
$nama = '';
$email = '';
$alasan = '';

// Atur zona waktu ke Asia/Jakarta agar konsisten
date_default_timezone_set('Asia/Jakarta');

// Hitung tanggal mulai dan selesai periode volunteer
$startDate = date('d F Y');
$endDate = date('d F Y', strtotime('+3 month'));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = htmlspecialchars($_POST['nama']); // Amankan input
    $email = htmlspecialchars($_POST['email']); // Amankan input
    $alasan = htmlspecialchars($_POST['alasan']); // Amankan input
    $submitted = true;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Safe Shell Volunteer</title>
  <style>
    /* Reset and base styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    body {
      background-color: #1c3b2c;
      color: white;
      overflow-x: hidden; /* Mencegah scroll horizontal */
    }

    /* === Header Styles === */
    header {
      width: 100%;
      padding: 20px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #1c3b2c;
      z-index: 100;
      position: relative;
    }

    header .logo {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    header .logo img {
      width: 50px;
      height: 50px;
      border-radius: 100%;
    }

    header nav a {
      margin: 0 15px;
      text-decoration: none;
      color: #d4d4d4;
    }

    header .btn {
        background-color: #cde596;
        color: #000;
        padding: 8px 16px;
        border-radius: 6px;
        text-decoration: none;
    }

    .container {
      width: auto;
      padding: 2rem 40px;
    }

    h1, h2 {
      color: #fff;
    }

    .section {
      margin-bottom: 3rem;
    }
    
    .hero-volunteer-content {
        display: flex;
        align-items: center;
        gap: 2rem;
        margin-top: 0; 
        flex-wrap: wrap;
    }

    .hero-volunteer-text {
        flex: 1;
        min-width: 300px;
    }

    /* [CSS BARU] Mengatur jarak di dalam blok teks yang sudah disatukan */
    .hero-volunteer-text h1 {
        margin-bottom: 0.25rem; /* Jarak dari judul ke slogan */
    }
    .hero-volunteer-text em {
        display: block; /* Pastikan slogan punya baris sendiri */
        margin-bottom: 1rem; /* Jarak dari slogan ke paragraf */
        font-style: italic;
    }
    .hero-volunteer-text p {
        margin-top: 0;
    }

    .hero-volunteer-image {
        flex: 1;
        min-width: 300px;
        text-align: right;
    }

    .hero-volunteer-image img {
      width: 100%;
      border-radius: 12px;
      height: auto;
      max-width: 400px;
    }

    .card-grid {
      display: flex;
      justify-content: space-between;
      gap: 1rem;
      margin-top: 2rem;
    }

    .card {
      background-color: #B4D4A5;
      border-radius: 12px;
      padding: 1rem;
      text-align: center;
      color: #1E3B34;
      flex: 1;
    }

    .card img {
      width: 100%;
      border-radius: 8px;
      height: 180px;
      object-fit: cover;
      margin-bottom: 0.5rem;
    }

    .cta-section {
      background-image: url('assets/foto2.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      padding: 60px 20px;
      text-align: center;
      color: white;
      position: relative;
      margin-top: 3rem; 
    }

    .cta-section::before {
      content: "";
      position: absolute;
      inset: 0;
      background-color: rgba(0, 0, 0, 0.65);
      z-index: 0;
      border-radius: inherit;
    }

    .cta-section h2,
    .cta-section p,
    .cta-section button {
      position: relative;
      z-index: 1;
    }

    .register-button {
      display: inline-block;
      margin-top: 20px;
      background-color: #cde596;
      color: #000;
      padding: 10px 20px;
      border-radius: 50px;
      font-weight: bold;
      border: none;
      cursor: pointer;
      font-size: 1rem;
    }

    .form-container {
      background-color: #26483C;
      padding: 2rem;
      border-radius: 12px;
      margin: 2rem auto; 
      display: none; 
      text-align: left;
      max-width: 600px; 
    }
    
    .form-container.active {
        display: block;
    }

    .form-container label {
        display: block;
        margin-bottom: 0.5rem;
        color: #fff;
    }

    .form-container input, .form-container textarea {
      width: 100%;
      padding: 0.75rem;
      margin-top: 0.5rem;
      margin-bottom: 1.5rem;
      border-radius: 8px;
      border: none;
      box-sizing: border-box;
      background-color: #355A4E;
      color: #fff;
    }

    .form-container textarea {
        resize: vertical;
    }

    .form-container button[type="submit"] {
      padding: 0.75rem 1.5rem;
      border: none;
      background-color: #B4D4A5;
      color: #1E3B34;
      font-weight: bold;
      font-size: 1rem;
      border-radius: 8px;
      cursor: pointer;
      display: block;
      margin: 1rem auto 0 auto;
    }

    .confirmation-section {
        background-color: #B4D4A5;
        padding: 2rem;
        color: #1E3B34;
        text-align: center;
        border-radius: 12px;
        margin: 2rem auto;
        max-width: 600px;
        display: none;
    }

    .confirmation-section h3 {
        font-size: 1.5em;
        margin-bottom: 1rem;
    }

    .confirmation-section p {
        margin-bottom: 0.8rem;
        line-height: 1.5;
    }
    
    .confirmation-section .tombol-kembali-utama {
        width: 100%;
        padding: 15px;
        background-color: #1e3a34;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 1.1em;
        font-weight: bold;
        cursor: pointer;
        margin-top: 20px;
        text-decoration: none;
        display: inline-block;
    }

    footer {
        background-color: #1c3b2c;
        padding: 30px 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        font-size: 16px;
        color: white;
    }

    .footer-text {
        max-width: 400px;
    }
    
    .footer-text a, .footer-text a:visited {
        color: blue;
        text-decoration: none;
    }

    .supported-by {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .supported-by img {
        margin-top: 10px;
        height: 50px;
    }

    @media (max-width: 768px) {
      header, footer {
        flex-direction: column;
        align-items: center;
        text-align: center;
      }
      header nav { margin-top: 10px; }
      .footer-text, .supported-by { width: 100%; margin-bottom: 1rem; }
      .supported-by { align-items: center; }
      .container { padding: 2rem 20px; }
      .hero-volunteer-content { flex-direction: column; align-items: center; }
      .hero-volunteer-text, .hero-volunteer-image { text-align: center; width: 100%; min-width: unset; }
    }
  </style>
</head>
<body>

<header>
    <div class="logo">
        <img src="assets/safeshell bg putih bulet.png" alt="Logo Safe Shell" />
        <div><strong>Safe Shell</strong><br />Pulau Derawan</div>
    </div>
    <nav>
        <a href="home.html">Beranda</a>
        <a href="volunteer.php">Volunteer</a>
        <a href="donasi.html">Donasi</a>
        <a href="staff.html">Staff</a>
    </nav>
</header>

<div id="introSection">
    <div class="container">
        <div class="section">
            <div class="hero-volunteer-content">
                <div class="hero-volunteer-text">
                    <h1>Safe Shell Volunteer</h1>
                    <em>Bersama membuat rumah nyaman untuk penyu</em>
                    <p>
                      Safe Shell adalah pusat konservasi penyu yang berfokus pada pelestarian spesies penyu laut melalui program penetasan, edukasi, dan partisipasi publik. Kami percaya bahwa menjaga penyu bukan hanya tugas, tapi ahli setiap ingin berperan bagi siapa saja untuk terlibat langsung dalam aksi pelestarian laut.
                    </p>
                </div>
                <div class="hero-volunteer-image">
                    <img src="assets/foto1.jpg" alt="Volunteer with Turtle">
                </div>
            </div>
        </div>

        <h2 style="text-align: center; font-style: italic; color: #B4D4A5;">Bersama, lebih baik</h2>

        <div class="card-grid">
            <div class="card">
                <img src="assets/daria.jpg" alt="Tukik">
                <p>Bersama membuat rumah nyaman untuk penyu</p>
            </div>
            <div class="card">
                <img src="assets/zene.jpg" alt="Pantai">
                <p>Mengajak relawan untuk terlibat langsung dalam kegiatan konservasi.</p>
            </div>
            <div class="card">
                <img src="assets/morgann.jpg" alt="Lepas Tukik">
                <p>Membantu proses penetasan hingga pelepasan tukik ke laut.</p>
            </div>
        </div>
    </div> 
    <div class="cta-section">
      <h2>Daftar Volunteer Safe Shell</h2>
      <p>Mau terlibat langsung dalam upaya pelestarian penyu?<br>Yuk, jadi bagian dari keluarga Safe Shell!</p>
      <button type="button" class="register-button" onclick="showVolunteerForm()">DAFTAR DISINI!</button>
    </div>
</div>

<div class="form-container" id="volunteerFormSection">
    <h2 style="text-align:center; margin-bottom: 2rem;">Formulir Pendaftaran Volunteer</h2>
    <form method="post" action="volunteer.php">
        <label for="nama">Nama Lengkap</label>
        <input type="text" id="nama" name="nama" required>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
        <label for="alasan">Alasan ingin menjadi volunteer</label>
        <textarea id="alasan" name="alasan" rows="4" required></textarea>
        <button type="submit">DAFTAR SEKARANG</button>
    </form>
</div>

<div class="confirmation-section" id="confirmationSection">
  <h3>Terima kasih, <?= htmlspecialchars($nama) ?>!</h3>
  <p>Kamu telah berhasil mendaftar sebagai volunteer Safe Shell.</p>
  <p>Periode kegiatan: <strong><?= $startDate ?> sampai <?= $endDate ?></strong></p>
  <p>Kami akan menghubungi kamu lebih lanjut melalui email: <strong><?= htmlspecialchars($email) ?></strong></p>
  <a href="volunteer.php" class="tombol-kembali-utama">Kembali Ke Halaman Utama</a>
</div>

<footer>
    <div class="footer-text">
      <p>Safe Shell<br><b>Ruang Aman Untuk Penyu</b></p>
      <p><strong>___________</strong></p><br>
      <p>Kontak Kami <br>📧 <a href="mailto:safeshell@gmail.com">safeshell@gmail.com</a></p>
    </div>
    <div class="supported-by">
      <p>Didukung oleh:</p>
      <img src="assets/kopikala logo putih.png" alt="Logo Kopikala" />
    </div>
</footer>

<script>
    function showVolunteerForm() {
        document.getElementById('introSection').style.display = 'none';
        document.getElementById('volunteerFormSection').style.display = 'block';
        document.getElementById('confirmationSection').style.display = 'none';
    }

    <?php if ($submitted): ?>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('introSection').style.display = 'none';
        document.getElementById('volunteerFormSection').style.display = 'none';
        document.getElementById('confirmationSection').style.display = 'block';
    });
    <?php endif; ?>
</script>

</body>
</html>
