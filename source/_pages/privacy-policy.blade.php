@extends('_layouts.main')

@section('body')
    <!-- ====== Banner Start ====== -->
    <section class="ud-page-banner">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-banner-content">
              <h1>{{ $page->t("Privacy policy",current_path_locale($page))}}</h1>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Banner End ====== -->

    <!-- ====== Blog Details Start ====== -->
    <section class="ud-blog-details">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="ud-blog-details-content">
              <h2 class="fs-2 fw-bold mb-4">{{ $page->t("LibreSign Privacy Notice") }}</h2>
              <h2 class="fs-2 fw-bold mb-3">{{ $page->t("Introduction") }}</h2>

              <p class="text-justify mb-3">
                {{$page->t("The LibreSign is documents signer free developed by LibreCode, cooperative of professional of IT. The LibreSign was thinked having to base  the security and the privacy of users.")}}
              </p>
              <p class="text-justify mb-3">
                {{$page->t("We establish this Privacy Notice to inform how the personal data collected through of the our contact form on website of LibreSign is treaties, protected and utilized.")}}
              </p>
              <p class="text-justify mb-3">
                {{ $page->t("It's worth pointing out that, the way how we treaties the users personal data eventually insert in solution LibreSign is described in LibreSign Use Term that you can access here: [link]")}}
              </p>
              <p class="text-justify mb-5">
                {{$page->t("This Notice is governed for norms of  General Data Protection Law (GDPL) by Brasil and General Data Protection Law (GDPL) by Europe Union, reflexeting our compromise in protect the privacy and the integration of users personal data.")}}
              </p>

              <h2 class="fs-2 fw-bold mb-3">{{ $page->t("Collect of Data") }}</h2>
              <p class="text-justify mb-3">
                {{$page->t('The LibreCode collect and treat the following personal data through of your website (www.libresign.coop):')}}
              </p>
              <ol class="fw-bold mb-3 ms-5">
                <li> - {{$page->t('Name')}}</li>
                <li> - {{$page->t('E-mail')}}</li>
                <li> - {{$page->t('Phone')}}</li>
              </ol>

              <p class="text-justify mb-3">
                {{ $page->t('These data is provided voluntarily by users when filling the contact form available on our website. The collect these data have how finality exclusive establish a communication channel efficient with the interested in our products and services.') }}
              </p>

              <p class="text-justify mb-5">
                {{ $page->t('When filling the registration form you agree with the treat of your data to publish of products of LibreCode. You can revoke your consent any time, just click on link available in communication or send an e-mail to: contato@librecode.coop.')}}
              </p>

              <h2 class="fs-2 fw-bold mb-3">{{ $page->t("Use of Data") }}</h2>
              <p class="text-justify mb-3">
                {{ $page->t('The personal data collected is used just to the following finalities:') }}
              </p>

              <ol class="fw-bold mb-3 ms-5">
                <li> - {{ $page->t('Answer of requests, doubts or users of comments') }}</li>
                <li> - {{ $page->t('Send communications that have been expressly requested by user ou that be pertinent to your manifested interest') }}</li>
                <li> - {{ $page->t('Register of attendance history') }}</li>
                <li> - {{ $page->t('For legal and/or regulatory purposes') }}</li>
              </ol>

              <p class="text-justify mb-5">
                {{ $page->t('The LibreCode is committed to not use the data collected to specific distincts finality above without the prev notification of the data holders.') }}
              </p>
              
            
              <h2 class="fs-2 fw-bold mb-3">{{ $page->t("Data Sharing") }}</h2>
              <p class="text-justify mb-5">
                {{ $page->t('The LibreCode not share, sell, rent or another way provides collected personal data to third parties, except when necessary to fulfill with legal obligations or with user express authorization.') }}
              </p>

              <h2 class="fs-2 fw-bold mb-3">{{ $page->t("Data Security") }}</h2>
              <p class="text-justify mb-5">
                {{ $page->t('We employ measures security technique and organizational to protected the personal data collected against accesses not authorized, undue changes, disclosure or destruction. Our commitment with security, include adoption of recommented pratics in terms of data protect. To know more about the security politic of LibreCode between in contact us.') }}
              </p>

              <h2 class="fs-2 fw-bold mb-3">{{ $page->t("Data Holders Rights") }}</h2>
              <p class="text-justify mb-3">
                {{ $page->t('According to art 18 of LGPD and the GDPR, users have the use to access, to correct, delete or to carry personal user data, beside can limit or if oppose to your treat when substantiated in the interest legitimate of  the controller.') }}
              </p>

              <p class="text-justify mb-5">
                {{ $page->t('To exercise your rights, the holders of data and/or your responsible should in to by way e-mail:  contato@librecode.coop') }}
              </p>

              <h2 class="fs-2 fw-bold mb-3">{{ $page->t("Changes of Privacy Politic") }}</h2>
              <p class="text-justify mb-5">
                {{ $page->t('LibreCode reserves the right to change this Privacy Policy any moment. The changes will be valid immediately after you publish on website. We recommend the periodic review this politic.') }}
              </p>

              <h2 class="fs-2 fw-bold mb-3">{{ $page->t("Contact") }}</h2>
              <p class="text-justify mb-3">
                {{ $page->t('To relative questions to our Privacy Politic any moment contact us by e-mail: contato@librecode.coop') }}
              </p>
              <p class="text-justify mb-5">
                {{ $page->t('This Privacy Politic was updated by last once on 08 april 2024.') }}
              </p>

            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Blog Details End ====== -->
@endsection