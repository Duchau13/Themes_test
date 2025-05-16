document.addEventListener('DOMContentLoaded', function () {
    // Khởi tạo Swiper cho travel-slider
    if (document.querySelector('.travel-slider')) {
        const travelSwiper = new Swiper('.travel-slider', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            slidesPerGroup: 1,
            navigation: {
                prevEl: '.swiper-button-prev',
                nextEl: '.swiper-button-next',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                    slidesPerGroup: 1,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                    slidesPerGroup: 1,
                }
            }
        });
    }

    // Xử lý lọc category cho travel-section
    const categoryItems = document.querySelectorAll('.category-item');
    const travelPosts = document.querySelector('.travel-posts');

    if (categoryItems && travelPosts) {
        categoryItems.forEach(item => {
            item.addEventListener('click', function () {
                categoryItems.forEach(i => i.classList.remove('active'));
                this.classList.add('active');

                const category = this.getAttribute('data-category');

                // Load 6 posts mới nhất theo category qua AJAX
                let args = {
                    'post_type': 'travel',
                    'posts_per_page': 6,
                    'post_status': 'publish',
                    'orderby': 'date',
                    'order': 'DESC',
                };
                if (category !== 'all') {
                    args['tax_query'] = [{
                        'taxonomy': 'travel_type',
                        'field': 'slug',
                        'terms': category,
                    }];
                }

                fetch(ajax_object.ajax_url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'action=load_travel_posts&query=' + encodeURIComponent(JSON.stringify(args)),
                })
                    .then(response => response.text())
                    .then(html => {
                        travelPosts.innerHTML = html;
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    }
});