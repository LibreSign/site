@extends('_layouts.main')

@section('body')
    <!-- ====== Banner Start ====== -->
    <section class="ud-page-banner">
        <div class="container">
        <div class="row">
            <div class="col-lg-12">
            <div class="ud-banner-content">
              <h1>{{ $page->name }}</h1>
              <h3>{{ $page->role }}</h3>
            </div>
            </div>
        </div>
        </div>
    </section>
    <!-- ====== Banner End ====== -->

    
    <section id="team" class="ud-team">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="ud-section-title mx-auto text-center">                
                <p>
                  {{ $page->bio }} 
                </p>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <div class="ud-single-team wow fadeInUp" data-aos-delay=".1s">
                <div class="ud-team-image-wrapper">  
                  <img
                    src="https://www.gravatar.com/avatar/{{$page->gravatar}}?size=170"
                    alt="{{ $page->name }}"
                    class="shape shape-1 mb-5"
                  />
                </div>
                @if($page->social)
                <ul class="ud-team-socials">
                  @foreach($page->social as $name => $url)
                  <li>
                    <a href="{{ $url }}">
                      <i class="lni lni-{{ $name }}-original"></i>
                    </a>
                  </li>
                  @endforeach
                </ul>
                @endif
              </div>
            </div>
          </div>
        </div>
      </section>  
@endsection