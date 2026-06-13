@extends('_layouts.main')

@section('body')
  <section class="ud-page-banner">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="ud-banner-content">
            <h1>{{ $page->name }}</h1>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ud-team-profile">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-9 col-lg-11">
          <div class="ud-team-profile__card">
            <div class="row g-5 align-items-center">

              <div class="col-lg-4 ud-team-profile__avatar-col text-center">
                @php
                  $gravatar = str_starts_with($page->gravatar ?? '', '/')
                    ? $page->baseUrl . $page->gravatar
                    : 'https://www.gravatar.com/avatar/' . ($page->gravatar ?? '') . '?size=360';
                @endphp
                <img
                  src="{{ $gravatar }}"
                  alt="{{ $page->name }}"
                  class="ud-team-profile__avatar mb-4"
                  width="180"
                  height="180"
                >
                @if($page->job_title ?? false)
                  <span class="ud-team-profile__role d-block mb-3">{{ $page->t($page->job_title) }}</span>
                @endif
                @if($page->social ?? false)
                  <ul class="list-unstyled d-flex justify-content-center gap-3">
                    @foreach($page->social as $network => $url)
                      <li>
                        <a
                          href="{{ $url }}"
                          target="_blank"
                          rel="noopener noreferrer"
                          class="ud-team-profile__social-link"
                          aria-label="{{ $page->name }} {{ $page->t('on') }} {{ ucfirst($network) }}"
                        >
                          <i class="lni lni-{{ $network }}" aria-hidden="true"></i>
                        </a>
                      </li>
                    @endforeach
                  </ul>
                @endif
              </div>

              <div class="col-lg-8">
                <h2 class="ud-team-profile__name">{{ $page->name }}</h2>
                <p class="ud-team-profile__bio">{{ $page->bio }}</p>
                <a href="{{ locale_url($page, 'team') }}" class="ud-team-profile__back">
                  ← {{ $page->t('Back to team') }}
                </a>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
