<?php
/*
Template Name: Homepage
*/
get_header();

wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css', array(), '8.0.0');
wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js', array(), '8.0.0', true);
wp_enqueue_script('custom-scripts', get_template_directory_uri() . '/js/custom-scripts.js', array('swiper-js'), '1.0.0', true);

wp_localize_script('custom-scripts', 'ajax_object', array(
    'ajax_url' => admin_url('admin-ajax.php')
));
?>

<div class="homepage-sections">
    <?php
    if (have_rows('section_container')):
        while (have_rows('section_container')):
            the_row();
            $layout = get_row_layout();

            if ($layout === 'hero_section'):
                $image = get_sub_field('image');
                $sub_title = get_sub_field('sub_title');
                $icon_subtitle = get_sub_field('icon_subtitle');
                $title = get_sub_field('title');
                $description = get_sub_field('description');
                $button_start = get_sub_field('button_started');
                $button_watch = get_sub_field('button_watch');
                $banner_bottom = get_sub_field('banner_bottom');
                ?>
                <section class="hero-section">
                    <div class="hero-container">
                        <div class="hero-content">
                            <p class="section-subtitle subtitle_hero-section">
                                <?php echo esc_html($sub_title); ?>
                                <?php if ($icon_subtitle): ?>
                                    <span class="subtitle-icon">
                                        <?php
                                        $icon_url = is_array($icon_subtitle) && isset($icon_subtitle['url']) ? $icon_subtitle['url'] : (is_string($icon_subtitle) ? $icon_subtitle : '');
                                        $icon_alt = is_array($icon_subtitle) && isset($icon_subtitle['alt']) ? $icon_subtitle['alt'] : 'Subtitle Icon';
                                        if ($icon_url): ?>
                                            <img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($icon_alt); ?>">
                                        <?php endif; ?>
                                    </span>
                                <?php endif; ?>
                            </p>
                            <h1 class="section-title"><?php echo apply_filters('the_content', $title); ?></h1>
                            <p class="section-description"><?php echo esc_html($description); ?></p>
                            <div class="hero-buttons">
                                <?php if ($button_start): ?>
                                    <a href="<?php echo esc_url($button_start['url']); ?>" class="btn btn-start"><?php echo esc_html($button_start['title']); ?></a>
                                <?php endif; ?>
                                <?php if ($button_watch): ?>
                                    <a href="<?php echo esc_url($button_watch['url']); ?>" class="btn btn-watch"><?php echo esc_html($button_watch['title']); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="hero-image">
                            <?php
                            $image_url = is_array($image) && isset($image['url']) ? $image['url'] : (is_string($image) ? $image : '');
                            $image_alt = is_array($image) && isset($image['alt']) ? $image['alt'] : 'Hero Image';
                            if ($image_url): ?>
                                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if ($banner_bottom): ?>
                        <div class="hero-banner-bottom">
                            <?php
                            $banner_bottom_url = is_array($banner_bottom) && isset($banner_bottom['url']) ? $banner_bottom['url'] : (is_string($banner_bottom) ? $banner_bottom : '');
                            $banner_bottom_alt = is_array($banner_bottom) && isset($banner_bottom['alt']) ? $banner_bottom['alt'] : 'Banner';
                            if ($banner_bottom_url): ?>
                                <img src="<?php echo esc_url($banner_bottom_url); ?>" alt="<?php echo esc_attr($banner_bottom_alt); ?>">
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </section>
                <?php

            elseif ($layout === 'section_introduce'):
                $sub_title = get_sub_field('sub_title');
                $title = get_sub_field('title');
                $description = get_sub_field('description');
                ?>
                <section class="introduce-section">
                    <div class="introduce-container">
                        <div class="section-header">
                            <?php if ($sub_title): ?><p class="section-subtitle"><?php echo esc_html($sub_title); ?></p><?php endif; ?>
                            <?php if ($title): ?><h2 class="section-title"><?php echo esc_html($title); ?></h2><?php endif; ?>
                            <?php if ($description): ?><p class="section-description"><?php echo esc_html($description); ?></p><?php endif; ?>
                        </div>
                        <?php if (have_rows('item_introduce')): ?>
                            <div class="introduce-items">
                                <?php $counter = 0; while (have_rows('item_introduce') && $counter < 3): the_row(); $counter++; $item = get_sub_field('item'); ?>
                                    <div class="introduce-item">
                                        <div class="introduce-item-image-container">
                                            <?php
                                            $item_image_url = is_array($item['image']) && isset($item['image']['url']) ? $item['image']['url'] : (is_string($item['image']) ? $item['image'] : '');
                                            $item_image_alt = is_array($item['image']) && isset($item['image']['alt']) ? $item['image']['alt'] : 'Item Image';
                                            if ($item_image_url): ?>
                                                <img src="<?php echo esc_url($item_image_url); ?>" alt="<?php echo esc_attr($item_image_alt); ?>" class="introduce-item-image">
                                            <?php endif; ?>
                                        </div>
                                        <h3 class="introduce-item-title"><?php echo esc_html($item['title']); ?></h3>
                                        <p class="introduce-item-description"><?php echo esc_html($item['description']); ?></p>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>
                <?php

            elseif ($layout === 'slider_travel'):
                $sub_title = get_sub_field('sub_title');
                $title = get_sub_field('title');
                ?>
                <section class="travel-slider-section">
                    <div class="container">
                        <div class="section-header">
                            <?php if ($sub_title): ?><p class="travel-section-subtitle"><?php echo esc_html($sub_title); ?></p><?php endif; ?>
                            <?php if ($title): ?><h2 class="travel-section-title"><?php echo esc_html($title); ?></h2><?php endif; ?>
                        </div>
                        <div class="slider-controls">
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                        <div class="travel-slider swiper-container">
                            <div class="swiper-wrapper">
                                <?php
                                $args = array('post_type' => 'travel', 'posts_per_page' => 9, 'post_status' => 'publish');
                                $travel_query = new WP_Query($args);
                                if ($travel_query->have_posts()):
                                    while ($travel_query->have_posts()): $travel_query->the_post();
                                        $travel_info = get_field('infomation_travel');
                                        $price = isset($travel_info['price']) ? $travel_info['price'] : '';
                                        $address = isset($travel_info['address']) ? $travel_info['address'] : '';
                                        $rating = isset($travel_info['rating']) ? $travel_info['rating'] : 5.0;
                                        ?>
                                        <div class="swiper-slide travel-card">
                                            <div class="travel-image">
                                                <?php if (has_post_thumbnail()): ?>
                                                    <?php the_post_thumbnail('large', array('class' => 'travel-thumbnail')); ?>
                                                <?php endif; ?>
                                                <?php if ($rating): ?>
                                                    <div class="travel-rating">
                                                        <span class="star-icon">★</span>
                                                        <span class="rating-value"><?php echo number_format((float)$rating, 1); ?></span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="travel-content">
                                                <h3 class="travel-title"><?php the_title(); ?></h3>
                                                <div class="travel-excerpt">
                                                    <?php echo wp_trim_words(get_the_excerpt(), 15, '...see more'); ?>
                                                </div>
                                                <div class="travel-meta__container">
                                                    <div class="travel-meta">
                                                        <?php if ($address): ?><div class="travel-address"><?php echo esc_html($address); ?></div><?php endif; ?>
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
                                    <?php endwhile; wp_reset_postdata();
                                else: ?>
                                    <div class="no-travels">No travel destinations found.</div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </section>
                <?php

            elseif ($layout === 'dream_section'):
                $sub_title = get_sub_field('sub_title');
                $title = get_sub_field('title');
                $description = get_sub_field('description');
                $banner = get_sub_field('banner');
                ?>
                <section class="dream-section">
                    <div class="dream-container">
                        <div class="dream-banner">
                            <?php
                            $banner_url = is_array($banner) && isset($banner['url']) ? $banner['url'] : (is_string($banner) ? $banner : '');
                            $banner_alt = is_array($banner) && isset($banner['alt']) ? $banner['alt'] : 'Dream Banner';
                            if ($banner_url): ?>
                                <img src="<?php echo esc_url($banner_url); ?>" alt="<?php echo esc_attr($banner_alt); ?>">
                            <?php endif; ?>
                        </div>
                        <div class="dream-content">
                            <?php if ($sub_title): ?><p class="section-subtitle"><?php echo esc_html($sub_title); ?></p><?php endif; ?>
                            <?php if ($title): ?><h2 class="section-title"><?php echo esc_html($title); ?></h2><?php endif; ?>
                            <?php if ($description): ?><p class="section-description"><?php echo esc_html($description); ?></p><?php endif; ?>
                            <?php if (have_rows('infomation_items')): ?>
                                <div class="dream-items">
                                    <?php while (have_rows('infomation_items')): the_row(); $item = get_sub_field('item'); ?>
                                        <div class="dream-item">
                                            <h3 class="dream-item-content"><?php echo esc_html($item['content']); ?></h3>
                                            <p class="dream-item-description"><?php echo esc_html($item['description']); ?></p>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
                <?php

            elseif ($layout === 'section_travel'):
                $section_travel = get_sub_field('section_travel');
                $sub_title = get_sub_field('sub_title');
                $title = get_sub_field('title');
                ?>
                <section class="travel-section">
                    <div class="travel-container">
                        <div class="section-header-container">
                            <div class="section-header">
                                <?php if ($sub_title): ?><p class="section-subtitle"><?php echo esc_html($sub_title); ?></p><?php endif; ?>
                                <?php if ($title): ?><h2 class="section-title"><?php echo esc_html($title); ?></h2><?php endif; ?>
                            </div>
                            <div class="travel-categories">
                                <ul class="category-list">
                                    <?php
                                    $categories = get_categories(array('taxonomy' => 'travel_type', 'hide_empty' => 0));
                                    foreach ($categories as $category): ?>
                                        <li class="category-item" data-category="<?php echo esc_attr($category->slug); ?>">
                                            <?php echo esc_html($category->name); ?>
                                        </li>
                                    <?php endforeach; ?>
                                    <li class="category-item active category-see-all" data-category="all">See all</li>
                                </ul>
                            </div>
                        </div>
                        <div class="travel-posts">
                            <?php
                            $args = array('post_type' => 'travel', 'posts_per_page' => 6, 'post_status' => 'publish', 'orderby' => 'date', 'order' => 'DESC');
                            $travel_query = new WP_Query($args);
                            if ($travel_query->have_posts()):
                                while ($travel_query->have_posts()): $travel_query->the_post();
                                    $travel_info = get_field('infomation_travel');
                                    $price = isset($travel_info['price']) ? $travel_info['price'] : '';
                                    $address = isset($travel_info['address']) ? $travel_info['address'] : '';
                                    $rating = isset($travel_info['rating']) ? $travel_info['rating'] : 5.0;
                                    $categories = get_the_terms(get_the_ID(), 'travel_type');
                                    $category_slugs = $categories ? implode(',', array_map(function($cat) { return $cat->slug; }, $categories)) : '';
                                    ?>
                                    <div class="travel-card" data-categories="<?php echo esc_attr($category_slugs); ?>">
                                        <div class="travel-image">
                                            <?php if (has_post_thumbnail()): ?>
                                                <?php the_post_thumbnail('large', array('class' => 'travel-thumbnail')); ?>
                                            <?php endif; ?>
                                            <?php if ($rating): ?>
                                                <div class="travel-rating">
                                                    <span class="star-icon">★</span>
                                                    <span class="rating-value"><?php echo number_format((float)$rating, 1); ?></span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="travel-content">
                                            <h3 class="travel-title"><?php the_title(); ?></h3>
                                            <div class="travel-excerpt">
                                                <?php echo wp_trim_words(get_the_excerpt(), 15, '...see more'); ?>
                                            </div>
                                            <div class="travel-meta__container">
                                                <div class="travel-meta">
                                                    <?php if ($address): ?><div class="travel-address"><?php echo esc_html($address); ?></div><?php endif; ?>
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
                                <?php endwhile; wp_reset_postdata();
                            else: ?>
                                <div class="no-travels">No travel destinations found.</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
                <?php

            elseif ($layout === 'experience_section'):
                $sub_title = get_sub_field('sub_title');
                $title = get_sub_field('title');
                $description = get_sub_field('description');
                $banner = get_sub_field('banner');
                ?>
                <section class="dream-section">
                    <div class="dream-container">
                        <div class="dream-content">
                            <?php if ($sub_title): ?><p class="section-subtitle"><?php echo esc_html($sub_title); ?></p><?php endif; ?>
                            <?php if ($title): ?><h2 class="section-title"><?php echo esc_html($title); ?></h2><?php endif; ?>
                            <?php if ($description): ?><p class="section-description"><?php echo esc_html($description); ?></p><?php endif; ?>
                            <?php if (have_rows('infomation_items')): ?>
                                <div class="experience-items">
                                    <?php while (have_rows('infomation_items')): the_row(); $item = get_sub_field('item'); ?>
                                        <div class="experience-item">
                                            <h3 class="experience-item-content"><?php echo esc_html($item['content']); ?></h3>
                                            <p class="experience-item-description"><?php echo esc_html($item['description']); ?></p>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="dream-banner">
                            <?php
                            $banner_url = is_array($banner) && isset($banner['url']) ? $banner['url'] : (is_string($banner) ? $banner : '');
                            $banner_alt = is_array($banner) && isset($banner['alt']) ? $banner['alt'] : 'Dream Banner';
                            if ($banner_url): ?>
                                <img src="<?php echo esc_url($banner_url); ?>" alt="<?php echo esc_attr($banner_alt); ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
                <?php

            elseif ($layout === 'section_form'):
                $background_image = get_sub_field('background_image');
                $title = get_sub_field('title');
                $description = get_sub_field('description');
                $placeholder_form = get_sub_field('placeholder_form');
                $icon_submit = get_sub_field('icon_submit');
                ?>
                <section class="form-section" style="background-image: url('<?php echo esc_url(is_array($background_image) && isset($background_image['url']) ? $background_image['url'] : $background_image); ?>');">
                    <div class="form-container">
                        <div class="form-content">
                            <?php if ($title): ?><h2 class="section-title"><?php echo esc_html($title); ?></h2><?php endif; ?>
                            <?php if ($description): ?><p class="section-description"><?php echo esc_html($description); ?></p><?php endif; ?>
                            <div class="form-wrapper">
                                <div class="form-input-group">
                                    <input type="text" class="form-input" placeholder="<?php echo esc_attr($placeholder_form); ?>" />
                                    <button type="submit" class="form-submit">
                                        <?php
                                        $icon_submit_url = is_array($icon_submit) && isset($icon_submit['url']) ? $icon_submit['url'] : (is_string($icon_submit) ? $icon_submit : '');
                                        $icon_submit_alt = is_array($icon_submit) && isset($icon_submit['alt']) ? $icon_submit['alt'] : 'Submit Icon';
                                        if ($icon_submit_url): ?>
                                            <img src="<?php echo esc_url($icon_submit_url); ?>" alt="<?php echo esc_attr($icon_submit_alt); ?>">
                                        <?php endif; ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <?php
            endif;
        endwhile;
    endif;
    ?>
</div>

<?php
get_footer();
?>