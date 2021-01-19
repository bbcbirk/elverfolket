
</section> <!-- /Content -->
<footer class="site-footer">
    <section class="site-footer-content">
        <div class="row">
            <div class="column">
                <nav class="site-nav footer-nav">
                    <?php 
                    $args = array(
                        'theme_location' => 'footer'
                    );
                    ?>
                    <?php wp_nav_menu(  $args ); ?>
                </nav>
            </div>
            <div class="column">
                <!-- Social Links widget -->
                <?php dynamic_sidebar('contactarea'); ?>
            </div>
            <div class="column">
                <!-- Social Links widget -->
                <?php dynamic_sidebar('socialarea'); ?>
                <p ><?php bloginfo('name'); ?> - &copy; <?php echo date('Y'); ?></p>
            </div>
        </div>
        
    </section>
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>