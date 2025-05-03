<header id="site-header" class="site-header" role="banner">
    <div class="site-header__inner">
  <nav id="site-navigation" class="main-navigation container-fluid" role="navigation" aria-label="Primary Menu">
        <div class="row align-items-center justify-content-between">


        <div class="d-flex d-lg-none mobile-nav align-items-center">
            <div class="nav-logo-mobile text-center d-block d-lg-none">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" aria-label="Homepage">
                <img class="mw-100 w-auto" src="<?php echo get_template_directory_uri(); ?>/assets/images/pw_mark.png" alt="Site Logo" />
                </a>
            </div>
            <div class="mobile-button">
                <a class="pw-solid-button header-button" href="mailto:bijonlb.dev@gmail.com">Contact Me</a>
            </div>
            <!-- Mobile Toggle Button -->
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" aria-label="Toggle navigation">
                ☰
            </button>
        </div>


        <!-- Desktop -->
        <div class="nav-logo text-center text-sm-start d-none d-lg-flex">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo col-sm-4" aria-label="Homepage">
            <img class="mw-100 w-auto" src="<?php echo get_template_directory_uri(); ?>/assets/images/pw-logo.png" alt="Site Logo" />
            </a>
             <ul class="nav-list-desktop d-md-flex align-items-center col" id="primary-menu">
                <li><a href="#work">Work</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#reviews">Reviews</a></li>
                <li><a href="#about-me">About Me</a></li>
                <li><a href="#staff">Staff</a></li>
                <li><a class="pw-solid-button header-button" href="mailto:bijonlb.dev@gmail.com">Contact Me</a></li>
            </ul>
        </div>

        <!-- Menu Items Mobile -->
        <ul class="nav-list d-lg-none align-items-center" id="primary-menu-mobile">
            <li><a href="#services">Services</a></li>
            <li><a href="#work">Work</a></li>
            <li><a href="#reviews">Reviews</a></li>
            <li><a href="#about-me">About Me</a></li>
        </ul>
        </div>
    </nav>
    </div>
</header>
