@extends('_layouts.main')

@section('body')
  <section class="ud-ps-svg-page">
    <div class="ud-ps-svg-page__inner">
      <img
        src="{{ $page->baseUrl }}assets/images/solutions/public-sector-home.svg"
        alt="{{ $page->t('Página Setor Público') }}"
        class="ud-ps-svg-page__image"
        loading="eager"
        decoding="async"
      />
    </div>
  </section>

@endsection
