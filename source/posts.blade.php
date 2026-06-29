---
title: "LibreSign Blog - Digital Signature, Security and Open Source Insights"
description: "Read LibreSign's latest articles on digital signatures, document security, Nextcloud integrations, and open source software."
---
@extends('_layouts.main')

@section('body')
    <!-- ====== Banner Start ====== -->
    <section class="ud-page-banner">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-banner-content">
              <h1>{{ $page->t( "LibreSign Blog") }}</h1>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Banner End ====== -->

    <!-- ====== Blog Start ====== -->
    @include('_partials.post-list', [
      'sectionClass' => 'ud-blog-grids',
      'format'       => 'grid',
    ])
@endsection
