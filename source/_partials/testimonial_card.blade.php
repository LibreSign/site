<section class="section_testimonial">
    <p class="title-testimonial text-center mt-3">{{ $page->t('Testimonials') }}</p>
    <h2 class="text-center mb-5">{{ $page->t('What our customers says') }}</h2>
    <button class="pre-btn"><img src="{{ $page->baseUrl }}assets/images/arrow.png" alt="{{$page->t('Go back pagination of testimonials')}}"></button>
    <button class="nxt-btn"><img src="{{ $page->baseUrl }}assets/images/arrow.png" alt="{{$page->t('Show more testimonials of the caroseul')}}"></button>
    <div class="testimonial-container">
        @foreach($page->testimonials as $itens => $topics)
            <div class="testimonial-card">
                <div class="testimonial_color_stars">
                    <i class="lni lni-star-fill"></i>
                    <i class="lni lni-star-fill"></i>
                    <i class="lni lni-star-fill"></i>
                    <i class="lni lni-star-fill"></i>
                    <i class="lni lni-star-fill"></i>
                </div>           
                <div class="testimonial-info">
                    <p class="text-justify">{{ $page->t($topics->comment) }}</p>
                    <h6 class="testimonial-brand">{{ $topics->author }}</h6>
                </div>
            </div>
        @endforeach       
    </div>
</section>

<script>
    const productContainers = [...document.querySelectorAll('.testimonial-container')];
    const nxtBtn = [...document.querySelectorAll('.nxt-btn')];
    const preBtn = [...document.querySelectorAll('.pre-btn')];

    productContainers.forEach((item, i) => {
        let containerDimensions = item.getBoundingClientRect();
        let containerWidth = containerDimensions.width;

        nxtBtn[i].addEventListener('click', () => {
            item.scrollLeft += containerWidth;
        })

        preBtn[i].addEventListener('click', () => {
            item.scrollLeft -= containerWidth;
        })
    })
</script>