<?php
$logo_url = get_field('logo');
$footer_introduce = get_field('footer_introduce');
$text_introduce = $footer_introduce['text_introduce'] ?? '';
$contacts = $footer_introduce['contact'] ?? [];
?>

<footer class="footer">
    <div class="footer-container">
        <!-- Cột 1: Logo và Giới thiệu -->
        <div class="footer-column footer-brand">
            <div class="footer-logo">
                <?php if ($logo_url): ?>
                    <img src="<?php echo esc_url($logo_url); ?>" alt="TraviLog Logo">
                <?php else: ?>
                    <h3>TraviLog</h3>
                <?php endif; ?>
            </div>
            <p class="footer-introduce"><?php echo esc_html($text_introduce); ?></p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>

        <!-- Cột 2-4: Menu -->
        <?php
        $locations = get_nav_menu_locations();

        $footer_menu = [];
        
        if ( isset( $locations['footer-menu'] ) ) {
            $menu_id = $locations['footer-menu']; // ID của menu được gán vào vị trí 'footer-menu'
            $footer_menu = wp_get_nav_menu_items( $menu_id );
        }
        // var_dump(value: $footer_menu);
        $menu_columns = ['Product', 'Company', 'Support'];
        $menu_items_by_parent = [];

        if ($footer_menu) {
            foreach ($footer_menu as $item) {
                if ($item->menu_item_parent == 0) {
                    $menu_items_by_parent[$item->title] = [];
                }
            }

            foreach ($footer_menu as $item) {
                if ($item->menu_item_parent != 0) {
                    $parent_id = $item->menu_item_parent;
                    $parent_item = array_filter($footer_menu, fn($m) => $m->ID == $parent_id);
                    $parent_item = reset($parent_item);
                    if ($parent_item && isset($menu_items_by_parent[$parent_item->title])) {
                        $menu_items_by_parent[$parent_item->title][] = $item;
                    }
                }
            }

            foreach ($menu_columns as $column) {
                if (isset($menu_items_by_parent[$column])) {
                    echo '<div class="footer-column">';
                    echo '<h4 class="footer-title">' . esc_html($column) . '</h4>';
                    echo '<ul class="footer-links">';
                    foreach ($menu_items_by_parent[$column] as $item) {
                        echo '<li><a href="' . esc_url($item->url) . '">' . esc_html($item->title) . '</a></li>';
                    }
                    echo '</ul>';
                    echo '</div>';
                }
            }
        }
        ?>

        <!-- Cột 5: Contact -->
        <div class="footer-column footer-contact">
            <h4 class="footer-title">Contact us</h4>
            <ul class="footer-links">
                <?php if ($contacts): ?>
                    <?php foreach ($contacts as $contact): ?>
                        <?php
                        $contact_info = $contact['contact_info'];
                        $icon = $contact_info['icon'] ?? '';
                        $info = $contact_info['infomation'] ?? '';
                        // Kiểm tra nếu $icon là mảng (image array) thì lấy URL
                        $icon_url = is_array($icon) && isset($icon['url']) ? $icon['url'] : (is_string($icon) ? $icon : '');
                        ?>
                        <li>
                            <?php if ($icon_url): ?>
                                <img src="<?php echo esc_url($icon_url); ?>" alt="Icon" class="contact-icon">
                            <?php endif; ?>
                            <span><?php echo esc_html($info); ?></span>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="footer-bottom-container">
            <p class="copyright">Copyright © <?php echo date('Y'); ?></p>
            <div class="footer-bottom-links">
                <a href="#">All Rights Reserved</a>
                <a href="#">Terms and Conditions</a>
                <a href="#">Privacy Policy</a>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>

<script>
    document.querySelector('.mobile-menu-toggle').addEventListener('click', function () {
        document.querySelector('.nav-menu').classList.toggle('active');
    });
</script>

</html>