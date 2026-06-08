---
title: "LibreSign Team - The People Behind Open Source Electronic Signatures"
description: "Meet the LibreCode cooperative team behind LibreSign — dedicated to building free, transparent, and secure digital signature software."
---
@extends('_layouts.main')

@section('body')
  <section class="ud-page-banner">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="ud-banner-content">
            <h1>{{ $page->t("Meet the team") }}</h1>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ud-team-intro">
    <div class="container">
      <p class="ud-team-intro__subtitle">{{ $page->t("The people behind LibreSign") }}</p>
      <p class="ud-team-intro__description">{{ $page->t("We are a passionate cooperative team dedicated to building open source electronic signature software. We believe data sovereignty matters — our software is free, self-hostable, and privacy-first.") }}</p>
    </div>
  </section>

  <section class="ud-team-grid">
    <div class="container">
      <div class="row g-4 justify-content-center">
        @foreach($team as $member)
          @php
            $gravatar = str_starts_with($member->gravatar ?? '', '/')
              ? $page->baseUrl . $member->gravatar
              : 'https://www.gravatar.com/avatar/' . ($member->gravatar ?? '') . '?size=300';
          @endphp
          <div class="col-lg-4 col-md-6 d-flex">
            <article class="ud-team-card w-100">
              <div class="ud-team-card__header">
                <a href="{{ $member->getUrl() }}" class="ud-team-card__avatar-link" tabindex="-1" aria-hidden="true">
                  <img
                    src="{{ $gravatar }}"
                    alt="{{ $member->name }}"
                    class="ud-team-card__avatar"
                    width="120"
                    height="120"
                    loading="lazy"
                  >
                </a>
              </div>
              <div class="ud-team-card__body">
                <h2 class="ud-team-card__name">
                  <a href="{{ $member->getUrl() }}">{{ $member->name }}</a>
                </h2>
                @if($member->job_title ?? false)
                  <span class="ud-team-card__role">{{ $page->t($member->job_title) }}</span>
                @endif
                @if($member->bio ?? false)
                  <p class="ud-team-card__bio">{{ $member->bio }}</p>
                @endif
              </div>
              <div class="ud-team-card__footer">
              @if($member->social ?? false)
                  <ul class="ud-team-card__socials list-unstyled d-flex justify-content-center gap-2 mb-3">
                    @foreach($member->social as $network => $url)
                      <li>
                        <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $member->name }} {{ $page->t('on') }} {{ ucfirst($network) }}">
                          <i class="lni lni-{{ $network }}" aria-hidden="true"></i>
                        </a>
                      </li>
                    @endforeach
                  </ul>
                @endif
                <a href="{{ $member->getUrl() }}" class="ud-team-card__profile-link">{{ $page->t('View profile →') }}</a>
              </div>
            </article>
          </div>
        @endforeach
      </div>
    </div>
  </section>
@endsection
