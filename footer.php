<?php $linkedin_url = 'https://www.linkedin.com/in/bijonlb/'; 
$email_address = 'bijonlb.dev@gmail.com';
$copyright_text = '&copy '.get_the_date('Y').' Precious Works'; ?>
    
    <footer class="site-footer mt-auto">
        <div class="container footer-container text-center">
            <div class="back-to-top-row row">
                <div class="col back-to-top-col text-end">
                    <a aria-label="go to top of page" 
                        href="#" 
                        title="button to go back to top">
                        <img 
                            class="social-icon"
                            src="<?php echo get_template_directory_uri() ?>/assets/images/chevron-up-filled.png"
                            alt="back-to-top-icon"
                            title="back-to-top-icon"
                        />
                    </a>
                </div>
            </div>
            <div class="row footer-content-row align-items-center">
                <div class="col-sm-4 copyright-col text-start">
                    <p  class="small-text">
                        <?php echo $copyright_text ?>
                    </p>
                </div>

                <div class="col-sm-4 logo-col">
                    <img 
                        src="<?php echo get_template_directory_uri() ?>/assets/images/pw_mark.png"
                        alt="email-icon"
                        title="email-icon"
                    />
                </div>
                <div class="col-sm-4 social-col text-end">
                    <?php include(locate_template('components/footer/social-icons.php')); ?>
                </div>
            </div>
        </div>
    </footer>
    <?php wp_footer(); ?>
    </body>
</html>