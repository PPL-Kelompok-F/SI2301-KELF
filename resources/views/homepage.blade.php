<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BelajarIn - Fun Learning</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #fff8ec;
        }

        .btn-yellow {
            background: #ffd166;
            border: 2px solid #000;
            color: #000;
            font-weight: 600;
            border-radius: 12px;
        }

        .btn-yellow:hover {
            background: #ffcc55;
        }

        .hero-title {
            font-size: 42px;
            font-weight: 800;
            line-height: 1.2;
        }

        .soft-card {
            background: #ffe08a;
            border: 3px solid #000;
            border-radius: 18px;
            padding: 20px;
            height: 100%;
        }

        .navbar-brand {
            font-weight: 800;
        }

        .stat-box {
            background: white;
            border: 2px solid #000;
            border-radius: 12px;
            padding: 10px 20px;
            text-align: center;
        }

        .hero-img {
            border-radius: 20px;
            border: 4px solid #000;
        }

        .circle-bg {
            width: 380px;
            height: 380px;
            background: #ffe08a;
            border-radius: 50%;
            position: absolute;
            z-index: 0;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg px-4 py-3">
    <div class="container-fluid">

        <a class="navbar-brand d-flex align-items-center gap-2" href="#">
            <div style="width:30px;height:30px;background:#4dabf7;border-radius:8px;"></div>
            BelajarIn
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nav">

            <ul class="navbar-nav mx-auto gap-3">
            </ul>

            <div class="d-flex gap-2">
                <a href="{{ route('login') }}" class="btn btn-yellow">
                    Log In
                </a>
            </div>

        </div>

    </div>
</nav>

<!-- HERO -->
<section class="container py-5">
    <div class="row align-items-center g-5">

        <!-- LEFT -->
        <div class="col-lg-6">

            <h1 class="hero-title">
                Learning made <span style="color:#f4a300;">fun</span> and easy
            </h1>

            <p class="text-muted mt-3">
                Belajar jadi lebih seru seperti bermain!
                Anak-anak bisa belajar lewat quiz, gambar, dan latihan sederhana setiap hari.
            </p>

            <div class="d-flex gap-3 mt-4 flex-wrap">
                <a href="{{ route('login') }}" class="btn btn-yellow px-4 py-2">
                    Explore Courses
                </a>
                <a href="{{ route('login') }}" class="btn btn-light border border-dark px-4 py-2">
                    How it works
                </a>
            </div>

            <!-- STATS -->
            <div class="d-flex gap-3 mt-5 flex-wrap">

                <div class="stat-box">
                    <h5 class="mb-0 fw-bold">50K+</h5>
                    <small>Active Student</small>
                </div>

                <div class="stat-box">
                    <h5 class="mb-0 fw-bold">200+</h5>
                    <small>Teachers</small>
                </div>

                <div class="stat-box">
                    <h5 class="mb-0 fw-bold">4.9/5</h5>
                    <small>Rating</small>
                </div>

            </div>

        </div>

        <!-- RIGHT -->
        <div class="col-lg-6 position-relative d-flex justify-content-center">

            <div class="circle-bg"></div>

            <img
                src="https://images.unsplash.com/photo-1588072432836-e10032774350"
                class="img-fluid hero-img position-relative"
                style="max-width:420px;"
            >

        </div>

    </div>
</section>

<!-- FEATURES -->
<section class="container py-5">

    <div class="row g-4">

        <div class="col-md-4">
            <div class="soft-card">
                <h5 class="fw-bold">🎮 Interactive Lessons</h5>
                <p class="small mt-2">
                    Belajar sambil bermain dengan gambar dan latihan sederhana.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="soft-card">
                <h5 class="fw-bold">⭐ Daily Goals</h5>
                <p class="small mt-2">
                    Anak-anak jadi rajin belajar dengan target harian yang seru.
                </p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="soft-card">
                <h5 class="fw-bold">🏆 Earn Certificates</h5>
                <p class="small mt-2">
                    Dapatkan sertifikat setelah menyelesaikan quiz.
                </p>
            </div>
        </div>

    </div>

</section>

<!-- FOOTER -->
<footer class="text-center py-4 text-muted small">
    © {{ date('Y') }} BelajarIn. Fun Learning for Kids 🎉
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>