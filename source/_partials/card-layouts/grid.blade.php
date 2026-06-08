@php
  Carbon\Carbon::setLocale(current_path_locale($page));
@endphp

<div class="ud-single-blog">
  <div class="ud-blog-image">
    <a href="{{ $postUrl }}">
      <img src="{{ $post->cover_image }}" alt="">
    </a>
  </div>
  <div class="ud-blog-content">
    <span class="ud-blog-date"><time datetime="{{ Carbon\Carbon::createFromTimestamp($post->date)->toDateString() }}">{{ Carbon\Carbon::createFromTimestamp($post->date)->isoFormat('ll') }}</time></span>
    <h3 class="ud-blog-title">
      <a href="{{ $postUrl }}">{{ $page->t($post->title) }}</a>
    </h3>
    <p class="ud-blog-desc">{{ $page->t($post->description) }}</p>
  </div>
</div>
