<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>RSHP UNAIR</title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <header>
        <div class="navbar navbar-blue">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('struktur') }}">Struktur Organisasi</a></li>
                <li><a href="{{ route('layanan') }}">Layanan Umum</a></li>
                <li><a href="{{ route('about') }}">Visi  Misi dan Tujuan</a></li>
            </ul>
        </div>
        <img class="logo_rshp" src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNIVERSITAS-AIRLANGGA-scaled.webp" alt="Logo RSHP">
        <div class="navbar navbar-orange">
            <ul>
                <li><a href="#layanan_umum">Cyber Campus</a></li>
                <li><a href="#struktur_organisasi.php">FKH UNAIR</a></li>
                <li><a href="home.php">UNAIR</a></li>
            </ul>
        </div>
    </header>
    <body>
        <div class="about">
            <div>
                <a href="#" class="btn btn-yellow">PENDAFTARAN ONLINE</a><br>
                <p>
                    Rumah Sakit Hewan Pendidikan Universitas Airlangga berinovasi untuk selalu meningkatkan kualitas pelayanan, 
                    maka dari itu Rumah Sakit Hewan Pendidikan Universitas Airlangga mempunyai fitur pendaftaran online 
                    yang mempermudah untuk mendaftarkan hewan kesayangan anda.
                </p>
                <a href="#" class="btn btn-blue">INFORMASI JADWAL DOKTER JAGA</a>
            </div>
            <video controls autoplay">
                <source src="media/video.mp4" type="video/mp4">

                    Your browser does not support the video tag.
            </video>
        </div>
    </main>

    <footer>
        <div class="footer">
            <div class="footer footer-copyright">
                <p>
                    Copyright 2024 Universitas Airlangga. All Rights Reserved
                </p>
            </div>
            <div class="footer footer-nama">
                <p>
                    RUMAH SAKIT HEWAN PENDIDIKAN <br>
                    GEDUNG RS HEWAN PENDIDIKAN <br>
                    rshp@fkh.unair.ac.id <br>
                    Telp : 031 5927832 <br>
                    Kampus C Universitas Airlangga <br>
                    Surabaya 60115, Jawa Timur
                </p>
            </div>
        </div>
    </footer>
</html>