<header id="header" class="header fixed-top">

  <div class="branding d-flex align-items-cente">

    <div class="container position-relative d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="../assets/img/visionvoicelogo.png" alt="">


      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.php" class="active">Home<br></a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#services">Services</a></li>
       
          <li><a href="#faq">FAQ</a></li>

          <li><a href="#contact">Contact</a></li>
          <li>
            <a href="{{ route('apply') }}">
              <button class="applybtn">
                Apply Now
                <svg fill="currentColor" viewBox="0 0 24 24" class="icon">
                  <path
                    clip-rule="evenodd"
                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                    fill-rule="evenodd"></path>
                </svg>
              </button></a>
          </li>
          <li>
            <a href="{{ route('login') }}">
              <button class=" applybtn">
                Log in
                <svg fill="currentColor" viewBox="0 0 24 24" class="icon">
                  <path
                    clip-rule="evenodd"
                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                    fill-rule="evenodd"></path>
                </svg>
              </button></a>
          </li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>

  </div>

</header>