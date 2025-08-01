<header id="site-header" class="site-header" role="banner">
    <div class="site-header__inner">
        <nav 
            id="site-navigation" 
            class="main-navigation container-fluid" 
            role="navigation" 
            aria-label="Primary Menu"
        >
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
                    <button 
                        class="menu-toggle" 
                        aria-controls="primary-menu-mobile" 
                        aria-expanded="false" 
                        aria-label="Toggle navigation menu" 
                        aria-haspopup="true"
                    >
                        <!-- Hamburger Icon -->
                        <svg 
                            width="24" 
                            height="24" 
                            viewBox="0 0 24 24" 
                            fill="none" 
                            xmlns="http://www.w3.org/2000/svg" 
                            aria-hidden="true" 
                            focusable="false"
                        >
                            <rect y="4" width="24" height="2" fill="currentColor"/>
                            <rect y="11" width="24" height="2" fill="currentColor"/>
                            <rect y="18" width="24" height="2" fill="currentColor"/>
                        </svg>
                    </button>

                </div>

                <!-- Desktop -->
                <div class="nav-logo text-center text-sm-start d-none d-lg-flex">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo col-sm-4" aria-label="Homepage">
                        <img class="mw-100 w-auto" src="<?php echo get_template_directory_uri(); ?>/assets/images/pw-logo.png" alt="Site Logo" />
                    </a>
                    <ul class="nav-list-desktop d-md-flex align-items-center col" id="primary-menu" role="menubar">
                        <li role="none"><a href="/precious-projects/" role="menuitem" tabindex="0">#PreciousProjects</a></li>
                        <li role="none"><a href="<?php echo esc_url( home_url( '/' ))?>#services" role="menuitem" tabindex="0">Services</a></li>
                        <li role="none"><a href="/reviews/" role="menuitem" tabindex="0">Reviews</a></li>
                        <li role="none"><a href="<?php echo esc_url( home_url( '/' ))?>#about-me" role="menuitem" tabindex="0">About Me</a></li>
                        <li role="none"><a href="<?php echo esc_url( home_url( '/' ))?>#staff" role="menuitem" tabindex="0">Staff</a></li>
						<li role="none"><a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" role="menuitem" tabindex="0">#PreciousBlogs</a></li>
                    </ul>
                </div>

                <!-- Menu Items Mobile -->
                <ul class="nav-list d-lg-none align-items-center" id="primary-menu-mobile" role="menu" aria-label="Mobile Primary Menu">
                    <li role="none"><a href="#services" role="menuitem" tabindex="0">Services</a></li>
                    <li role="none"><a href="/precious-projects/" role="menuitem" tabindex="0">#PreciousProjects</a></li>
                    <li role="none"><a href="/reviews/" role="menuitem" tabindex="0">Reviews</a></li>
                    <li role="none"><a href="#about-me" role="menuitem" tabindex="0">About Me</a></li>
					<li role="none"><a href="<?php echo get_permalink( get_option( 'page_for_posts' ) ); ?>" role="menuitem" tabindex="0">#PreciousBlogs</a></li>
                </ul>

            </div>
        </nav>
    </div>
</header>
