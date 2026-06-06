<section class="{{ $sectionClass }}" data-aos="fade-up">
  <div class="container">
    @include('_partials.home.section-heading', [
      'title' => $title,
      'subtitle' => $subtitle ?? null,
    ])

    <div class="{{ $rowClass ?? 'row text-center justify-content-evenly gy-5 align-items-stretch' }}">
      @foreach ($items as $index => $item)
        @php
          $delay = $item['delay'] ?? ($index * 150);
          $itemColClass = $item['colClass'] ?? ($colClass ?? 'col-lg-4 col-md-6 d-flex');
          $cardClass = trim('ud-home-card ' . ($item['cardClass'] ?? ''));
          $iconAlt = $item['iconAlt'] ?? '';
          $actions = $item['actions'] ?? [];
        @endphp

        <div class="{{ $itemColClass }}" data-aos="fade-up" data-aos-delay="{{ $delay }}">
          <div class="{{ $cardClass }}">
            @if (!empty($item['title']))
              <div class="ud-home-card__header">
                <h5 class="ud-home-card__title">{{ $item['title'] }}</h5>
              </div>
            @endif

            @if (!empty($item['icon']))
              <div class="ud-home-card__icon">
                <img src="{{ $item['icon'] }}" alt="{{ $iconAlt }}" />
              </div>
            @endif

            @if (!empty($item['body']))
              <div class="ud-home-card__body">
                <p>{{ $item['body'] }}</p>
              </div>
            @endif

            @if (!empty($actions))
              <div class="ud-home-card__actions">
                @foreach ($actions as $action)
                  <a href="{{ $action['href'] }}" class="{{ $action['class'] ?? 'ud-main-btn' }}">
                    {{ $action['label'] }}
                  </a>
                @endforeach
              </div>
            @endif
          </div>
        </div>
      @endforeach
    </div>

    @if (!empty($sectionActions ?? []))
      <div class="ud-home-section__actions text-center mt-5">
        @foreach ($sectionActions as $action)
          <a href="{{ $action['href'] }}" class="{{ $action['class'] ?? 'ud-main-btn' }}">
            {{ $action['label'] }}
          </a>
        @endforeach
      </div>
    @endif
  </div>
</section>
