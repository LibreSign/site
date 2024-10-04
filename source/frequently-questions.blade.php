@extends('_layouts.main')

@section('body')
    <!-- ====== Princiapl Banner Start ====== -->
    <section class="ud-hero" id="home">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
            </div>
          </div>
        </div>
      </section>
      <!-- ====== Princiapl Banner End ====== -->

    <!-- ====== FAQ Start ====== -->
    <section id="faq" class="ud-faq">
        <div class="shape">
          <img src="{{ $page->baseUrl }}assets/images/faq/shape.svg" alt="shape" />
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="ud-section-title text-center mx-auto">
                <span>FAQ</span>
                <h2>{{ $page->t("Any Questions? Answered")}}</h2>
                <p>
                  {{ $page->t("LibreSign frequently asked questions")}}
                </p>
              </div>
            </div>
          </div>
  
          <div class="row">
            <div class="col-lg-6">
              <div class="ud-single-faq wow fadeInUp" data-aos-delay=".1s">
                <div class="accordion">
                  <button
                    class="ud-faq-btn collapsed"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseOne"
                  >
                    <span class="icon flex-shrink-0">
                      <i class="lni lni-chevron-down"></i>
                    </span>
                    <span>{{ $page->t("Why LibreSign?")}}</span>
                  </button>
                  <div id="collapseOne" class="accordion-collapse collapse">
                    <div class="ud-faq-body">
                      {{ $page->t("LibreSign allows documents to be signed securely and with legal validity, since the system generates hashing - an algorithm that ensures that the file has not been altered after being signed - as well as numbers and records the times of each signature carried out in the document. In this way, the system meets all the requirements of the GDPR - General Data Protection Law.")}}
                    </div>
                  </div>
                </div>
              </div>
              <div class="ud-single-faq wow fadeInUp" data-aos-delay=".15s">
                <div class="accordion">
                  <button
                    class="ud-faq-btn collapsed"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo"
                  >
                    <span class="icon flex-shrink-0">
                      <i class="lni lni-chevron-down"></i>
                    </span>
                    <span>{{ $page->t("What is electronic signature capture?")}}</span>
                  </button>
                  <div id="collapseTwo" class="accordion-collapse collapse">
                    <div class="ud-faq-body">
                      {{ $page->t("Electronic signature capture is a technology for signing electronic document files with a handwritten signature. The use of this technology allows for the elimination of the mailing, storage, filing, copying, and retrieval of paper documents. This will save your business time and money.")}}
                    </div>
                  </div>
                </div>
              </div>
              <div class="ud-single-faq wow fadeInUp" data-aos-delay=".2s">
                <div class="accordion">
                  <button
                    class="ud-faq-btn collapsed"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseThree"
                  >
                    <span class="icon flex-shrink-0">
                      <i class="lni lni-chevron-down"></i>
                    </span>
                    <span>
                      {{ $page->t("What are the key features of LibreCode signature pads?")}}
                    </span>
                  </button>
                  <div id="collapseThree" class="accordion-collapse collapse">
                    <div class="ud-faq-body">
                      {{ $page->t("File Creation, Signature with Digital Certificate, Signature Management, Document Management, Validation, API")}}
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="ud-single-faq wow fadeInUp" data-aos-delay=".1s">
                <div class="accordion">
                  <button
                    class="ud-faq-btn collapsed"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseFour"
                  >
                    <span class="icon flex-shrink-0">
                      <i class="lni lni-chevron-down"></i>
                    </span>
                    <span>
                      {{ $page->t("Is a digital signature the same as a digitized signature?")}}
                    </span>
                  </button>
                  <div id="collapseFour" class="accordion-collapse collapse">
                    <div class="ud-faq-body">
                      {{ $page->t("No. The digitized signature is the reproduction of the handwritten signature as an image using scanner-type. It does not guarantee the authorship and of the electronic document, as there is no association between the signer and the text, as it can be easily copied and inserted another document.")}}
                    </div>
                  </div>
                </div>
              </div>
              <div class="ud-single-faq wow fadeInUp" data-aos-delay=".15s">
                <div class="accordion">
                  <button
                    class="ud-faq-btn collapsed"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseFive"
                  >
                    <span class="icon flex-shrink-0">
                      <i class="lni lni-chevron-down"></i>
                    </span>
                    <span>
                      {{ $page->t("What is the name of the company that LibreSign was developed by?")}}
                    </span>
                  </button>
                  <div id="collapseFive" class="accordion-collapse collapse">
                    <div class="ud-faq-body">
                      {{ $page->t("LibreCode, a Brazilian cooperative of free software developers.")}}
                    </div>
                  </div>
                </div>
              </div>
              {{-- <div class="ud-single-faq wow fadeInUp" data-aos-delay=".2s">
                <div class="accordion">
                  <button
                    class="ud-faq-btn collapsed"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseSix"
                  >
                    <span class="icon flex-shrink-0">
                      <i class="lni lni-chevron-down"></i>
                    </span>
                    <span>Where and how to host this template?</span>
                  </button>
                  <div id="collapseSix" class="accordion-collapse collapse">
                    <div class="ud-faq-body">
                      Lorem Ipsum is simply dummy text of the printing and
                      typesetting industry. Lorem Ipsum has been the industry's
                      standard dummy text ever since the 1500s, when an unknown
                      printer took a galley of type and scrambled it to make a
                      type specimen book.
                    </div>
                  </div>
                </div>
              </div> --}}
            </div>
          </div>
        </div>
      </section>
      <!-- ====== FAQ End ====== -->

@endsection