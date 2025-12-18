@extends('_layouts.main')

@section('body')
  <!-- ====== About Hero Start ====== -->
  <section class="ud-about-hero">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="about-hero-content">
            <h1 class="about-hero-title">
              {{ $page->t("Technology, People, and Free Software.") }}
            </h1>
            <p class="about-hero-desc">
              {{ $page->t("Learn the story of a cooperative of specialists in free software development that was born to bring more freedom and security to your digital world.") }}
            </p>
            <div class="about-hero-buttons">
              <a href="{{ locale_url($page, 'contact-us') }}" class="ud-main-btn">
                {{ $page->t('Talk to Our Specialists') }}
              </a>
              <a href="{{ locale_url($page, 'pricing') }}" class="ud-secondary-btn">
                {{ $page->t('View All Plans') }}
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ====== About Hero End ====== -->

  <!-- ====== About Story Start ====== -->
  <section class="ud-about-story">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="about-story-header">
            <h2>{{ $page->t("The Perfect Tool for a World in Transformation.") }}</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="about-story-content">
            <p>
              {{ $page->t("LibreSign is a web application for electronic signatures (e-Sign) developed by the LibreCode cooperative. Its story began in early 2020, in the midst of a global pandemic, when the need to digitize documents became crucial for people and companies in a safe and agile way. It was from this context of urgency that our mission emerged: to develop a web solution that offers the possibility of signing and managing contracts and proposals online with total security and agility, without giving up freedom and control.") }}
            </p>
            <p>
              {{ $page->t("This mission translates into our commitment to free software. As an open source solution, LibreSign presents itself with the freedom to audit, customize, and scale the platform according to your needs. Our philosophy is that transparency and collaboration generate a more robust and reliable security, resulting in continuous innovation in a platform that has nothing to hide.") }}
            </p>
            <p>
              {{ $page->t("We believe that trust is the pillar of any digital relationship. That is why each signature and each process in our platforms are protected with end-to-end encryption technology, with total traceability. The result is a tool that not only solves your document management challenges, but becomes a strategic partner for your business, simplifying your routine and elevating your document management capacity with total security.") }}
            </p>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="about-timeline">
            <div class="timeline-item">
              <div class="timeline-icon">
                <img src="{{ $page->baseUrl }}assets/images/icon/about/physical-docs.svg" alt="" />
              </div>
              <div class="timeline-content">
                <h3>01</h3>
                <h4>{{ $page->t("The Beginning: The Era of Physical Documents.") }}</h4>
                <p>
                  {{ $page->t("Before digital transformation, document management was synonymous with bureaucratic processes, risks of loss, and wasted time.") }}
                </p>
              </div>
            </div>
            <div class="timeline-item">
              <div class="timeline-icon">
                <img src="{{ $page->baseUrl }}assets/images/icon/about/transformation-need.svg" alt="" />
              </div>
              <div class="timeline-content">
                <h3>02</h3>
                <h4>{{ $page->t("The Need for Transformation.") }}</h4>
                <p>
                  {{ $page->t("From 2020, in an emergency context, the search for safe and agile solutions for signing and managing documents remotely became unavoidable.") }}
                </p>
              </div>
            </div>
            <div class="timeline-item">
              <div class="timeline-icon">
                <img src="{{ $page->baseUrl }}assets/images/icon/about/complete-management.svg" alt="" />
              </div>
              <div class="timeline-content">
                <h3>03</h3>
                <h4>{{ $page->t("The Future: Complete Digital Management.") }}</h4>
                <p>
                  {{ $page->t("It was from this scenario that LibreSign was born, a tool that unites the freedom of free software with the security of electronic signature, transforming end-to-end document management.") }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ====== About Story End ====== -->

  <!-- ====== About Values Start ====== -->
  <section class="ud-about-values">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="about-values-header">
            <h2>{{ $page->t("What Makes Us Unique: The Power of a Cooperative and the Freedom of Free Software.") }}</h2>
          </div>
        </div>
      </div>
      <div class="row justify-content-center gy-5">
        <div class="col-lg-6 col-md-6">
          <div class="value-card">
            <div class="value-icon">
              <img src="{{ $page->baseUrl }}assets/images/icon/about/cooperative.svg" alt="" />
            </div>
            <h3>{{ $page->t("Why a cooperative?") }}</h3>
            <p>
              {{ $page->t("We are a digital cooperative of free software specialists, with over 25 years of cooperative decisions made transparently and democratically. Our members are partners and benefit from business growth, which unites us in a common goal: delivering the best solution for you. For us, partnership is more important than profit.") }}
            </p>
          </div>
        </div>
        <div class="col-lg-6 col-md-6">
          <div class="value-card">
            <div class="value-icon">
              <img src="{{ $page->baseUrl }}assets/images/icon/about/free-software.svg" alt="" />
            </div>
            <h3>{{ $page->t("Why free software (FLOSS)?") }}</h3>
            <p>
              {{ $page->t("A free license software like LibreSign is built collaboratively. Thousands of specialists test, correct, and continuously improve it. This ensures 100% auditable code, allowing immediate identification of any flaw. The transparency of our code is your security and innovation guarantee constantly.") }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ====== About Values End ====== -->

  <!-- ====== About Team Start ====== -->
  <section class="ud-about-team">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="team-image">
            <img src="{{ $page->baseUrl }}assets/images/about/team-photo.jpg" alt="{{ $page->t('LibreCode team') }}" />
          </div>
        </div>
        <div class="col-lg-6">
          <div class="team-content">
            <h2>{{ $page->t("The Team that Builds Trust.") }}</h2>
            <p>
              {{ $page->t("Meet the people behind the technology. We are a team of specialists passionate about creating solutions that unite security and freedom for the digital world.") }}
            </p>
            <blockquote class="team-quote">
              <p>
                {{ $page->t("It's not just about using technology, but about how it can make life more connected and human. That's what moves us.") }}
              </p>
              <footer>
                <div class="quote-author">
                  <img src="{{ $page->baseUrl }}assets/images/about/daiane-alves.jpg" alt="{{ $page->t('Daiane Alves') }}" />
                  <div class="author-info">
                    <strong>{{ $page->t("Daiane Alves") }}</strong>
                    <span>{{ $page->t("President of LibreCode") }}</span>
                  </div>
                </div>
              </footer>
            </blockquote>
            <div class="team-cta">
              <a href="{{ locale_url($page, 'team') }}" class="ud-main-btn">
                {{ $page->t('Our Complete Story') }}
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ====== About Team End ====== -->

  <!-- ====== About CTA Start ====== -->
  <section class="ud-about-cta">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="about-cta-content">
            <h2>{{ $page->t("A Story of Trust, Made for the Future.") }}</h2>
            <p>
              {{ $page->t("Join a community that values collaboration, security, and innovation. Let's build a more transparent digital future together.") }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ====== About CTA End ====== -->

  @include('_partials/contact_form')
@endsection
