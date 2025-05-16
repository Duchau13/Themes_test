<?php

function mytheme_register_menus()
{
    register_nav_menus(array(
        'main-menu' => __('Menu Chính', 'ten-theme'),
        'footer-menu' => __('Menu Chân Trang', 'ten-theme'),
    ));
}
add_action('init', 'mytheme_register_menus');


function mytheme_enqueue_homepage_css()
{
    if (is_page_template('homepage.php')) {
        wp_enqueue_style(
            'homepage-css',
            get_template_directory_uri() . '/assets/css/homepage.css',
            [],
            filemtime(get_template_directory() . '/assets/css/homepage.css')
        );
        wp_enqueue_script(
            'homepage-js',
            get_template_directory_uri() . '/assets/js/homepage.js',
            [],
            filemtime(get_template_directory() . '/assets/js/homepage.js'),
            true // true = load ở footer
        );
    }
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_homepage_css');


add_theme_support('post-thumbnails');




function register_travel_post_type()
{
    $labels = array(
        'name' => 'Travel',
        'singular_name' => 'Travel',
        'menu_name' => 'Travels',
        'name_admin_bar' => 'Travel',
        'add_new' => 'Thêm mới',
        'add_new_item' => 'Thêm mới Travel',
        'new_item' => 'Travel mới',
        'edit_item' => 'Chỉnh sửa Travel',
        'view_item' => 'Xem Travel',
        'all_items' => 'Tất cả Travel',
        'search_items' => 'Tìm kiếm Travel',
        'not_found' => 'Không tìm thấy.',
        'not_found_in_trash' => 'Không tìm thấy trong thùng rác.',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'travel'),
        'show_in_rest' => true, // hỗ trợ Gutenberg
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_position' => 5,
        'menu_icon' => 'dashicons-palmtree',
        'taxonomies' => array('category'), // Cho phép dùng category mặc định
    );

    register_post_type('travel', $args);
}
add_action('init', 'register_travel_post_type');

function register_travel_taxonomy()
{
    $labels = array(
        'name' => 'Loại Travel',
        'singular_name' => 'Loại Travel',
        'search_items' => 'Tìm loại',
        'all_items' => 'Tất cả loại',
        'parent_item' => 'Loại cha',
        'parent_item_colon' => 'Loại cha:',
        'edit_item' => 'Chỉnh sửa loại',
        'update_item' => 'Cập nhật loại',
        'add_new_item' => 'Thêm loại mới',
        'new_item_name' => 'Tên loại mới',
        'menu_name' => 'Loại Travel',
    );

    $args = array(
        'hierarchical' => true, // true nếu giống category, false nếu giống tag
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'rewrite' => array('slug' => 'travel-type'),
        'show_in_rest' => true, // hỗ trợ Gutenberg
    );

    register_taxonomy('travel_type', array('travel'), $args);
}
add_action('init', 'register_travel_taxonomy');


add_action('wp_ajax_load_travel_posts', 'load_travel_posts_callback');
add_action('wp_ajax_nopriv_load_travel_posts', 'load_travel_posts_callback');

function load_travel_posts_callback()
{
    // Kiểm tra dữ liệu gửi qua AJAX
    if (!isset($_POST['query'])) {
        wp_send_json_error('No query data provided.');
        wp_die();
    }

    // Decode dữ liệu JSON
    $args = json_decode(stripslashes($_POST['query']), true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        wp_send_json_error('Invalid JSON data: ' . json_last_error_msg());
        wp_die();
    }

    // Thêm debug để kiểm tra $args
    error_log('AJAX Args: ' . print_r($args, true));

    $travel_query = new WP_Query($args);

    ob_start();
    if ($travel_query->have_posts()):
        while ($travel_query->have_posts()):
            $travel_query->the_post();
            $travel_info = get_field('infomation_travel');
            $price = isset($travel_info['price']) ? $travel_info['price'] : '';
            $address = isset($travel_info['address']) ? $travel_info['address'] : '';
            $rating = isset($travel_info['rating']) ? $travel_info['rating'] : 5.0;
            $categories = get_the_terms(get_the_ID(), 'travel_type');
            $category_slugs = $categories ? implode(',', array_map(function ($cat) {
                return $cat->slug; }, $categories)) : '';
            ?>
            <div class="travel-card" data-categories="<?php echo esc_attr($category_slugs); ?>">
                <div class="travel-image">
                    <?php if (has_post_thumbnail()): ?>
                        <?php the_post_thumbnail('large', array('class' => 'travel-thumbnail')); ?>
                    <?php endif; ?>
                    <?php if ($rating): ?>
                        <div class="travel-rating">
                            <span class="star-icon">★</span>
                            <span class="rating-value"><?php echo number_format((float) $rating, 1); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="travel-content">
                    <h3 class="travel-title"><?php the_title(); ?></h3>
                    <div class="travel-excerpt">
                        <?php
                        $excerpt = get_the_excerpt();
                        echo wp_trim_words($excerpt, 15, '...see more');
                        ?>
                    </div>
                    <div class="travel-meta__container">
                        <div class="travel-meta">
                            <?php if ($address): ?>
                                <div class="travel-address"><?php echo esc_html($address); ?></div>
                            <?php endif; ?>
                            <?php if ($price): ?>
                                <div class="travel-price">
                                    <span class="price-value">$<?php echo esc_html($price); ?></span>
                                    <span class="price-text">x 12 Interest free</span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <a href="<?php the_permalink(); ?>" class="see-more-btn">See More</a>
                    </div>
                </div>
            </div>
            <?php
        endwhile;
        wp_reset_postdata();
    else: ?>
        <div class="no-travels">No travel destinations found.</div>
    <?php endif;
    echo ob_get_clean();
    wp_die();
}