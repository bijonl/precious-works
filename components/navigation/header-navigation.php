<header id="site-header" class="site-header" role="banner">
    <div class="site-header__inner">
        <nav id="site-navigation" class="main-navigation container" role="navigation" aria-label="Primary Menu">
            <div class="row align-items-center">
                <ul class="nav-list d-flex align-items-center">
                    <!-- Left Links -->
                    <li class="col"><a href="#services">Services</a></li>
                    <li class="col"><a href="#work">Work</a></li>

                    <!-- Logo in the center -->
                    <li class="nav-logo col-sm-2 text-center">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" aria-label="Homepage">
                            <img class="mw-100 w-auto" src="<?php echo get_template_directory_uri(); ?>/assets/images/pw-logo.png" alt="Site Logo" />
                        </a>
                    </li>

                    <!-- Right Links -->
                    <li class="col text-end"><a href="#reviews">Reviews</a></li>
                    <li class="col text-end"><a href="#about-me">About Me</a></li>
                </ul>
            </div>
        </nav>

        <!-- Optional: Mobile menu toggle -->
        <!-- <button class="menu-toggle" aria-controls="site-navigation" aria-expanded="false">
            <span class="screen-reader-text">Toggle navigation</span>
        </button> -->
    </div>
</header>
