@extends('_layouts.main')

@section('body')
  <section class="ud-page-banner">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="ud-banner-content">
            <h1>{{ $page->t("Our Team") }}</h1>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ud-team py-5">
    <div class="container">
      <div class="row g-4 justify-content-center">
        @foreach($team as $member)
          @php
            if (str_starts_with($member->gravatar ?? '', '/')) {
              $gravatar = $page->baseUrl . $member->gravatar;
            } else {
              $gravatar = 'https://www.gravatar.com/avatar/' . ($member->gravatar ?? '') . '?size=200';
            }
          @endphp
          <div class="col-lg-3 col-md-4 col-sm-6 d-flex">
            <article class="ud-single-team text-center w-100 d-flex flex-column">
              <a href="{{ $member->getUrl() }}" class="ud-team-image-wrapper d-block mb-3">
                <img
                  src="{{ $gravatar }}"
                  alt="{{ $member->name }}"
                  class="rounded-circle"
                  width="120"
                  height="120"
                  loading="lazy"
                />
              </a>
              <div class="ud-team-info flex-grow-1">
                <h2 class="ud-team-name h5 mb-1">
                  <a href="{{ $member->getUrl() }}">{{ $member->name }}</a>
                </h2>
                @if(!empty($member->role))
                  <p class="ud-team-role text-muted small mb-2">{{ $page->t($member->role) }}</p>
                @endif
                @if(!empty($member->bio))
                  <p class="ud-team-bio small">{{ $member->bio }}</p>
                @endif
              </div>
              @if(!empty($member->social))
                <ul class="ud-team-socials list-unstyled d-flex justify-content-center gap-2 mt-3">
                  @foreach($member->social as $network => $url)
                    <li>
                      <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $member->name }} on {{ ucfirst($network) }}">
                        <i class="lni lni-{{ $network }}" aria-hidden="true"></i>
                      </a>
                    </li>
                  @endforeach
                </ul>
              @endif
            </article>
          </div>
        @endforeach
      </div>
    </div>
  </section>
@endsection
