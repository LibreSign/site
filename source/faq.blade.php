@extends('_layouts.main')

@section('body')

  <section class="ud-page-section--dark text-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-7">
          <h1 class="display-4 fw-bold text-white mb-3">
            {{ $page->t("Frequently Asked Questions") }}
          </h1>
          <p class="fs-5 text-white-50">
            {{ $page->t("Everything you need to know about LibreSign — open source, self-hosted, and built for digital sovereignty.") }}
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="ud-faq-page py-5" aria-labelledby="faq-page-heading">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <h2 id="faq-page-heading" class="visually-hidden">{{ $page->t("FAQ") }}</h2>
          <dl class="ud-faq-list">
            <div class="ud-faq-item">
              <dt>{{ $page->t('What is LibreSign?') }}</dt>
              <dd>{{ $page->t('LibreSign is an open source electronic signature application integrated with Nextcloud. It allows individuals and organizations to sign, request signatures on, and manage digital documents securely — without relying on proprietary third-party services.') }}</dd>
            </div>
            <div class="ud-faq-item">
              <dt>{{ $page->t('Is LibreSign free and open source?') }}</dt>
              <dd>{{ $page->t('Yes. LibreSign is released under the AGPL-3.0 license. The full source code is publicly available on GitHub. You are free to use, study, modify, and distribute the software according to the license terms.') }}</dd>
            </div>
            <div class="ud-faq-item">
              <dt>{{ $page->t('Does LibreSign work with Nextcloud?') }}</dt>
              <dd>{{ $page->t('Yes. LibreSign is a native Nextcloud application. It is installed directly into your Nextcloud instance and uses Nextcloud\'s users, storage, and authentication infrastructure. You can find it in the official Nextcloud App Store.') }}</dd>
            </div>
            <div class="ud-faq-item">
              <dt>{{ $page->t('Can LibreSign be self-hosted?') }}</dt>
              <dd>{{ $page->t('Yes. LibreSign is designed for self-hosting. You install it on your own servers or private cloud infrastructure, keeping full control over your data and signing workflows. No data is sent to external services.') }}</dd>
            </div>
            <div class="ud-faq-item">
              <dt>{{ $page->t('Who can use LibreSign?') }}</dt>
              <dd>{{ $page->t('LibreSign is suitable for individuals, small businesses, enterprises, government agencies, cooperatives, law firms, and any organization that needs to sign or collect digital signatures on documents while maintaining data sovereignty.') }}</dd>
            </div>
            <div class="ud-faq-item">
              <dt>{{ $page->t('What types of signatures does LibreSign support?') }}</dt>
              <dd>{{ $page->t('LibreSign supports simple electronic signatures, signatures with A1 digital certificates, and hybrid signature modes. It also supports sequential or parallel signing flows with multiple signers per document.') }}</dd>
            </div>
            <div class="ud-faq-item">
              <dt>{{ $page->t('How can I validate a signed document?') }}</dt>
              <dd>{{ $page->t('Each document signed with LibreSign includes a QR code that allows anyone to verify the authenticity and integrity of the signature without needing access to the system. A complete audit trail is also stored.') }}</dd>
            </div>
            <div class="ud-faq-item">
              <dt>{{ $page->t('Does LibreSign have an API?') }}</dt>
              <dd>{{ $page->t('Yes. LibreSign exposes a REST API that allows developers to integrate document signing workflows into their own applications and systems. Full API documentation is available through the Nextcloud OCS API Viewer.') }}</dd>
            </div>
            <div class="ud-faq-item">
              <dt>{{ $page->t('How can I contribute to LibreSign?') }}</dt>
              <dd>{{ $page->t('You can contribute by reporting bugs, improving documentation, translating the interface, developing new features, or sponsoring the project. Visit the GitHub repository or contact the LibreCode cooperative to learn how to get involved.') }}</dd>
            </div>
            <div class="ud-faq-item">
              <dt>{{ $page->t('How can my company or organization support LibreSign?') }}</dt>
              <dd>{{ $page->t('Organizations can support LibreSign through sponsorship, purchasing managed hosting plans from LibreCode, or contributing development resources. Sustainable funding helps ensure ongoing maintenance, security updates, and new features for the entire community.') }}</dd>
            </div>
          </dl>

          <div class="text-center mt-5 pt-3">
            <p class="mb-4">{{ $page->t('Still have questions? Our team is ready to help.') }}</p>
            <a href="{{ locale_url($page, 'contact-us') }}" class="btn ud-btn-solid-brand">
              {{ $page->t('Talk to Our Specialists') }}
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

@push('structured-data')
@verbatim
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "What is LibreSign?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "LibreSign is an open source electronic signature application integrated with Nextcloud. It allows individuals and organizations to sign, request signatures on, and manage digital documents securely — without relying on proprietary third-party services."
      }
    },
    {
      "@type": "Question",
      "name": "Is LibreSign free and open source?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Yes. LibreSign is released under the AGPL-3.0 license. The full source code is publicly available on GitHub. You are free to use, study, modify, and distribute the software according to the license terms."
      }
    },
    {
      "@type": "Question",
      "name": "Does LibreSign work with Nextcloud?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Yes. LibreSign is a native Nextcloud application. It is installed directly into your Nextcloud instance and uses Nextcloud's users, storage, and authentication infrastructure. You can find it in the official Nextcloud App Store."
      }
    },
    {
      "@type": "Question",
      "name": "Can LibreSign be self-hosted?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Yes. LibreSign is designed for self-hosting. You install it on your own servers or private cloud infrastructure, keeping full control over your data and signing workflows. No data is sent to external services."
      }
    },
    {
      "@type": "Question",
      "name": "Who can use LibreSign?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "LibreSign is suitable for individuals, small businesses, enterprises, government agencies, cooperatives, law firms, and any organization that needs to sign or collect digital signatures on documents while maintaining data sovereignty."
      }
    },
    {
      "@type": "Question",
      "name": "What types of signatures does LibreSign support?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "LibreSign supports simple electronic signatures, signatures with A1 digital certificates, and hybrid signature modes. It also supports sequential or parallel signing flows with multiple signers per document."
      }
    },
    {
      "@type": "Question",
      "name": "How can I validate a signed document?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Each document signed with LibreSign includes a QR code that allows anyone to verify the authenticity and integrity of the signature without needing access to the system. A complete audit trail is also stored."
      }
    },
    {
      "@type": "Question",
      "name": "Does LibreSign have an API?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Yes. LibreSign exposes a REST API that allows developers to integrate document signing workflows into their own applications and systems. Full API documentation is available through the Nextcloud OCS API Viewer."
      }
    },
    {
      "@type": "Question",
      "name": "How can I contribute to LibreSign?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "You can contribute by reporting bugs, improving documentation, translating the interface, developing new features, or sponsoring the project. Visit the GitHub repository at https://github.com/LibreSign/libresign or contact the LibreCode cooperative to learn how to get involved."
      }
    },
    {
      "@type": "Question",
      "name": "How can companies or governments support LibreSign?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Organizations can support LibreSign through sponsorship, purchasing managed hosting plans from LibreCode, or contributing development resources. Sustainable funding helps ensure ongoing maintenance, security updates, and new features for the entire community."
      }
    }
  ]
}
</script>
@endverbatim
@endpush

@endsection
