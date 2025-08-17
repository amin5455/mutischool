<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi-School Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            scroll-behavior: smooth;
        }
        .hero {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('/hero2.jpg') center 1%/cover no-repeat;
            color: white;
            padding: 120px 0;
        }
        .section-title {
            font-weight: 700;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .pricing-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            transition: all 0.3s;
        }
        .pricing-card:hover {
            box-shadow: 0 5px 25px rgba(0,0,0,0.1);
            transform: translateY(-5px);
        }
        .navbar-brand img {
    height: 50px;      /* fit navbar height */
    width: auto;       /* keep aspect ratio */
    display: block;    /* remove inline spacing */
    padding: 0;        /* no padding inside container */
    margin: 0;         /* no margin */
}

    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">MultiSchoolSys</a>
        <!-- <a class="navbar-brand fw-bold" href="#"><img src="sss.png" alt=""></a> -->

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="#advantages">Advantages</a></li>
                <li class="nav-item"><a class="nav-link" href="#pricing">Pricing</a></li>
                <li class="nav-item"><a class="nav-link" href="#security">Security</a></li>
                <li class="nav-item"><a class="nav-link" href="#how-to-use">How to Use</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                @auth
                    <li class="nav-item"><a class="nav-link btn btn-success text-white px-3" href="{{ url('/dashboard') }}">Dashboard</a></li>
                @else
                    <li class="nav-item"><a class="nav-link btn btn-primary text-white px-3" href="{{ route('login') }}">Login</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero text-center">
    <div class="container">
        <h1 class="display-4 fw-bold">Manage Multiple Schools with Ease</h1>
        <p class="lead mt-3">All-in-one platform for schools, teachers, students, and parents.</p>
        <a href="{{ route('register') }}" class="btn btn-primary btn-lg mt-4">Get Started</a>

    </div>
</section>

<!-- Advantages Section -->
<section id="advantages" class="py-5">
    <div class="container text-center">
        <h2 class="section-title">Advantages</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <i class="bi bi-speedometer2 fs-1 text-primary"></i>
                <h5 class="mt-3">Fast & Efficient</h5>
                <p>Manage all school operations in one dashboard.</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-people fs-1 text-success"></i>
                <h5 class="mt-3">Multi-User Access</h5>
                <p>Separate portals for admin, teachers, parents, and students.</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-bar-chart fs-1 text-warning"></i>
                <h5 class="mt-3">Reports & Analytics</h5>
                <p>Generate attendance, results, and fee reports instantly.</p>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Section -->
<section id="pricing" class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="section-title">Pricing</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="pricing-card p-4">
                    <h4>Starter</h4>
                    <p class="fs-2 fw-bold">$10<span class="fs-6">/month</span></p>
                    <ul class="list-unstyled">
                        <li>Up to 1 School</li>
                        <li>Basic Reports</li>
                        <li>Email Support</li>
                    </ul>
                    <a href="#" class="btn btn-outline-primary mt-3">Choose Plan</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="pricing-card p-4 border-primary border-2">
                    <h4>Professional</h4>
                    <p class="fs-2 fw-bold">$30<span class="fs-6">/month</span></p>
                    <ul class="list-unstyled">
                        <li>Up to 5 Schools</li>
                        <li>Advanced Reports</li>
                        <li>Priority Support</li>
                    </ul>
                    <a href="#" class="btn btn-primary mt-3">Choose Plan</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="pricing-card p-4">
                    <h4>Enterprise</h4>
                    <p class="fs-2 fw-bold">$50<span class="fs-6">/month</span></p>
                    <ul class="list-unstyled">
                        <li>Unlimited Schools</li>
                        <li>Custom Features</li>
                        <li>Dedicated Manager</li>
                    </ul>
                    <a href="#" class="btn btn-outline-primary mt-3">Choose Plan</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Security Section -->
<section id="security" class="py-5">
    <div class="container text-center">
        <h2 class="section-title">Security</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <i class="bi bi-lock fs-1 text-danger"></i>
                <h5 class="mt-3">Data Protection</h5>
                <p>All data is encrypted and securely stored.</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-shield-check fs-1 text-primary"></i>
                <h5 class="mt-3">Role-based Access</h5>
                <p>Only authorized users can access specific data.</p>
            </div>
            <div class="col-md-4">
                <i class="bi bi-cloud-arrow-up fs-1 text-success"></i>
                <h5 class="mt-3">Daily Backups</h5>
                <p>Your data is backed up every day for safety.</p>
            </div>
        </div>
    </div>
</section>

<!-- How to Use Section -->
<section id="how-to-use" class="py-5 bg-light">
    <div class="container text-center">
        <h2 class="section-title">How to Use</h2>
        <div class="row g-4">
            <div class="col-md-3">
                <i class="bi bi-person-plus fs-1 text-primary"></i>
                <h6 class="mt-3">1. Sign Up</h6>
            </div>
            <div class="col-md-3">
                <i class="bi bi-building fs-1 text-success"></i>
                <h6 class="mt-3">2. Add Schools</h6>
            </div>
            <div class="col-md-3">
                <i class="bi bi-journal-text fs-1 text-warning"></i>
                <h6 class="mt-3">3. Manage Classes</h6>
            </div>
            <div class="col-md-3">
                <i class="bi bi-graph-up-arrow fs-1 text-danger"></i>
                <h6 class="mt-3">4. Generate Reports</h6>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-5">
    <div class="container text-center">
        <h2 class="section-title">Contact Us</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Your Name">
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Your Email">
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" rows="4" placeholder="Your Message"></textarea>
                    </div>
                    <button class="btn btn-primary w-100">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3">
    <p class="mb-0">&copy; {{ date('Y') }} MultiSchoolSys. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</body>
</html>
