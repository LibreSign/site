@extends('_layouts.main')

@section('body')
  <section class="ud-page-banner">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="ud-banner-content">
            <h1>{{ $page->t("E-books") }}</h1>
          </div>
        </div>
      </div>
    </div>
  </section>

  @include('_partials.post-list', [
    'sectionClass' => 'ud-blog-grids',
    'format'       => 'blog',
    'category'     => 'ebook',
  ])
@endsection
