<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="{{ url('/') }}"><img src="<?PHP echo asset('assets/img/logo.png') ?>" alt="" /></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars ml-1"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav text-uppercase ml-auto">
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ url('/') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/terms-and-conditions') }}">Terms & Conditions</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/privacy-policy') }}">Privacy Policy</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('/contact') }}">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('hospital/register') }}">Register</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('user/login') }}">Login</a></li>
            </ul>
        </div>
    </div>
</nav>