<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div id="navigation-container" class="container">
        <a class="navbar-brand main-text" href="/">Ti&Lily Events Management</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto" >
            <li class="nav-item">
              <a class="nav-link" href="{{route('termsAndConditions')}}">Terms & Conditions</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('shopIndex')}}">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('about')}}">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('gallery')}}">Gallery</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('contact')}}">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('dashboard')}}">Dashboard</a>
            </li>
            <!-- use blade template if function to check if the user is logged in 
                this is achieved using the Auth Class object and check() method -->
            @if(Auth::check())
                <li class="nav-item">
                    <form method="POST" action="{{route('logout')}}" id="logout-form-test">@csrf</form>
                    <!-- logout from the form using JavaScript to submit the post form -->
                    <a class="nav-link" href="#" onclick="document.getElementById('logout-form-test').submit();">Logout</a>
                </li>
                
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{route('login')}}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('register')}}">Register</a>
                </li>
            @endif
          </ul>
        </div>
    </div>
</nav>