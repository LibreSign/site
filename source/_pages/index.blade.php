@extends('_layouts.main')

@section('body')
  <!-- ====== Hero Start ====== -->
    <section class="ud-hero" id="home">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-hero-content wow fadeInUp" data-wow-delay=".2s">
              <h1 class="ud-hero-title">
                {{ __($page, "The first free and open source web document signer", current_path_locale($page)) }}
              </h1>
              <p class="ud-hero-desc">
                {{ __($page,"Sign and monitor your documents with practicality, security and legal validity.",current_path_locale($page)) }}
              </p>
              {{-- <ul class="ud-hero-buttons">
                <li>
                  <a href="https://links.uideck.com/play-bootstrap-download" rel="nofollow noopener" target="_blank" class="ud-main-btn ud-white-btn">
                    Prices
                  </a>
                </li>
                <li>
                  <a href="https://github.com/uideck/play-bootstrap" rel="nofollow noopener" target="_blank" class="ud-main-btn ud-link-btn">
                    Learn More <i class="lni lni-arrow-right"></i>
                  </a>
                </li>
              </ul> --}}
            </div>
            <div class="ud-hero-image wow fadeInUp" data-wow-delay=".25s">
              <img src="{{ $page->baseUrl }}assets/images/print_main_screen.png" alt="print_main_screen" />
              <img
                src="{{ $page->baseUrl }}assets/images/dotted-shape.svg"
                alt="shape"
                class="shape shape-1"
              />
              <img
                src="{{ $page->baseUrl }}assets/images/dotted-shape.svg"
                alt="shape"
                class="shape shape-2"
              />
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Hero End ====== -->

    <!-- ====== Features Start ====== -->
    <section id="features" class="ud-features">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-section-title">
              <span>{{ __($page,"Features",current_path_locale($page))}}</span>
              <h2>{{ __($page,"Main Features",current_path_locale($page))}}</h2>
              <p>
                {{ __($page,"There are many variations of passages of Lorem Ipsum available but the majority have suffered alteration in some form.",current_path_locale($page)) }}
              </p>
            </div>
          </div>
        </div>
        <div class="row">
          @foreach ($page->getFromCategory('features') as $item)
            <div class="col-xl-3 col-lg-3 col-sm-6">
              <div class="ud-single-feature wow fadeInUp" data-wow-delay=".1s">
                <a href="{{ $item['url'] }}">
                  <div class="ud-feature-icon">
                    <i class="lni lni-gift"></i>
                  </div>
                  <div class="ud-feature-content">
                    <h3 class="ud-feature-title">{{ __($page,$item['title'],current_path_locale($page)) }}</h3></a>
                    <p class="ud-feature-desc">{{ __($page,$item['description'],current_path_locale($page)) }}</p>
                    <a class="ud-feature-link" href="{{ $item['url'] }}">{{ __($page,"Learn more",current_path_locale($page))}}</a>
                  </div>
                </a>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
    <!-- ====== Features End ====== -->

    <!-- ====== About Start ====== -->
    <section id="about" class="ud-about">
      <div class="container">
        <div class="ud-about-wrapper wow fadeInUp" data-wow-delay=".2s">
          <div class="ud-about-content-wrapper">
            <div class="ud-about-content">
              <span class="tag">{{ __($page,"About Us",current_path_locale($page))}}</span>
              <h2>{{ __($page,"The perfect tool to manage the signature flow of your documents",current_path_locale($page))}}</h2>
              <p>
                {{ __($page,"LibreSign is a web application for electronic signatures (e-Sign) developed by the LibreCode cooperative (Brazilian cooperative specialized in free software development). Its development began at the beginning of 2020, in the midst of the pandemic, when people and companies were migrating their physical documentation to digital, and then there was a need to develop a web solution that could offer the possibility of signing documents, contracts and proposals online with security and agility.",current_path_locale($page))}}
              </p>

              <p>
                {{ __($page,"We use PKI technology to generate digital certificate keys. LibreSign is open source (and always will be), which allows it to be audited and customized for various needs and integrated with any system and, of course, maintained by the community.",current_path_locale($page)) }}
              </p>
              {{-- <a href="javascript:void(0)" class="ud-main-btn">Learn More</a> --}}
            </div>
          </div>
          <div class="ud-about-image">
            <img src="{{ $page->baseUrl }}assets/images/about/about-image.svg" alt="about-image" />
          </div>
        </div>
      </div>
    </section>
    <!-- ====== About End ====== -->

    <!-- ====== Target Audience Start ====== -->
    <section id="target_audience" class="ud-about">
      <div class="container bg-white p-5 cards-one-below-the-other">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-section-title text-center mx-auto">
              <h3 class="card-title">{{ __($page,"Target Audience",current_path_locale($page))}}</h3>
            </div>
          </div>
        </div>
        <div class="row text-center">
          <div class="col-4 text-card">
            <div class="cards-target-audience">
              <h5 class="mb-3 text-white">{{ __($page,"Public Sector",current_path_locale($page))}}</h5>
              <p class="text-white">
                {{ __($page,"Optimize document management in the public sector with LibreSign. Our solution provides effective administration to handle specific government documentation, ensuring security, speed, and strict compliance with the General Data Protection Law (LGPD). Simplify bureaucratic processes, expedite document signing, and promote more efficient management with LibreSign for the public sector.",current_path_locale($page)) }}
              </p>
            </div>
          </div>
          <div class="col-4 text-card">
            <div class="cards-target-audience">
              <h5 class="mb-3 text-white">{{ __($page,"Education",current_path_locale($page))}}</h5>
              <p class="text-white">
                {{__($page,"LibreSign is the ideal choice for educational institutions looking to enhance their document processes with legal validity. Simplify the signing of contracts, authorizations, and other essential documents for academic administration. Promote effective document management, providing a streamlined and modern experience for students, teachers, and administrative staff.",current_path_locale($page))}}
              </p>
            </div>
          </div>
          <div class="col-4 text-card">
            <div class="cards-target-audience">
              <h5 class="mb-3 text-white">{{ __($page,"Private Companies",current_path_locale($page))}}</h5>
              <p class="text-white">
                {{ __($page,"Our electronic signature and document management solution streamline workflows, reducing time spent on manual processes. Achieve greater productivity, promote document security, and ensure compliance with the General Data Protection Law (LGPD), providing an agile experience for your clients and collaborators.",current_path_locale($page)) }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Target Audience End ====== -->

    {{-- <!-- ====== Pricing Start ====== -->
    <section id="pricing" class="ud-pricing">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="ud-section-title mx-auto text-center">
              <span>Pricing</span>
              <h2>Our Pricing Plans</h2>
              <p>
                There are many variations of passages of Lorem Ipsum available
                but the majority have suffered alteration in some form.
              </p>
            </div>
          </div>
        </div>

        <div class="row g-0 align-items-center justify-content-center">
          <div class="col-lg-4 col-md-6 col-sm-10">
            <div
              class="ud-single-pricing first-item wow fadeInUp"
              data-wow-delay=".15s"
            >
              <div class="ud-pricing-header">
                <h3>STARTING FROM</h3>
                <h4>$ 19.99/mo</h4>
              </div>
              <div class="ud-pricing-body">
                <ul>
                  <li>5 User</li>
                  <li>All UI components</li>
                  <li>Lifetime access</li>
                  <li>Free updates</li>
                  <li>Use on 1 (one) project</li>
                  <li>4 Months support</li>
                </ul>
              </div>
              <div class="ud-pricing-footer">
                <a href="javascript:void(0)" class="ud-main-btn ud-border-btn">
                  Purchase Now
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-10">
            <div
              class="ud-single-pricing active wow fadeInUp"
              data-wow-delay=".1s"
            >
              <span class="ud-popular-tag">POPULAR</span>
              <div class="ud-pricing-header">
                <h3>STARTING FROM</h3>
                <h4>$ 30.99/mo</h4>
              </div>
              <div class="ud-pricing-body">
                <ul>
                  <li>5 User</li>
                  <li>All UI components</li>
                  <li>Lifetime access</li>
                  <li>Free updates</li>
                  <li>Use on 1 (one) project</li>
                  <li>4 Months support</li>
                </ul>
              </div>
              <div class="ud-pricing-footer">
                <a href="javascript:void(0)" class="ud-main-btn ud-white-btn">
                  Purchase Now
                </a>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-10">
            <div
              class="ud-single-pricing last-item wow fadeInUp"
              data-wow-delay=".15s"
            >
              <div class="ud-pricing-header">
                <h3>STARTING FROM</h3>
                <h4>$ 70.99/mo</h4>
              </div>
              <div class="ud-pricing-body">
                <ul>
                  <li>5 User</li>
                  <li>All UI components</li>
                  <li>Lifetime access</li>
                  <li>Free updates</li>
                  <li>Use on 1 (one) project</li>
                  <li>4 Months support</li>
                </ul>
              </div>
              <div class="ud-pricing-footer">
                <a href="javascript:void(0)" class="ud-main-btn ud-border-btn">
                  Purchase Now
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Pricing End ====== --> --}}

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
              <h2>{{ __($page,"Any Questions? Answered",current_path_locale($page))}}</h2>
              <p>
                {{ __($page,"LibreSign frequently asked questions",current_path_locale($page))}}
              </p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-6">
            <div class="ud-single-faq wow fadeInUp" data-wow-delay=".1s">
              <div class="accordion">
                <button
                  class="ud-faq-btn collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseOne"
                >
                  <span class="icon flex-shrink-0">
                    <i class="lni lni-chevron-down"></i>
                  </span>
                  <span>{{ __($page,"Why LibreSign?",current_path_locale($page))}}</span>
                </button>
                <div id="collapseOne" class="accordion-collapse collapse">
                  <div class="ud-faq-body">
                    {{ __($page,"LibreSign allows documents to be signed securely and with legal validity, since the system generates hashing - an algorithm that ensures that the file has not been altered after being signed - as well as numbers and records the times of each signature carried out in the document. In this way, the system meets all the requirements of the LGPD - General Data Protection Law.",current_path_locale($page))}}
                  </div>
                </div>
              </div>
            </div>
            <div class="ud-single-faq wow fadeInUp" data-wow-delay=".15s">
              <div class="accordion">
                <button
                  class="ud-faq-btn collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#collapseTwo"
                >
                  <span class="icon flex-shrink-0">
                    <i class="lni lni-chevron-down"></i>
                  </span>
                  <span>{{ __($page,"What is electronic signature capture?",current_path_locale($page))}}</span>
                </button>
                <div id="collapseTwo" class="accordion-collapse collapse">
                  <div class="ud-faq-body">
                    {{ __($page,"Electronic signature capture is a technology for signing electronic document files with a handwritten signature. The use of this technology allows for the elimination of the mailing, storage, filing, copying, and retrieval of paper documents. This will save your business time and money.",current_path_locale($page))}}
                  </div>
                </div>
              </div>
            </div>
            <div class="ud-single-faq wow fadeInUp" data-wow-delay=".2s">
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
                    {{ __($page,"What are the key features of LibreCode signature pads?",current_path_locale($page))}}
                  </span>
                </button>
                <div id="collapseThree" class="accordion-collapse collapse">
                  <div class="ud-faq-body">
                    {{ __($page,"File Creation, Signature with Digital Certificate, Signature Management, Document Management, Validation, API",current_path_locale($page))}}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="ud-single-faq wow fadeInUp" data-wow-delay=".1s">
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
                    {{ __($page,"Is a digital signature the same as a digitized signature?",current_path_locale($page))}}
                  </span>
                </button>
                <div id="collapseFour" class="accordion-collapse collapse">
                  <div class="ud-faq-body">
                    {{ __($page,"No. The digitized signature is the reproduction of the handwritten signature as an image using scanner-type. It does not guarantee the authorship and of the electronic document, as there is no association between the signer and the text, as it can be easily copied and inserted another document.",current_path_locale($page))}}
                  </div>
                </div>
              </div>
            </div>
            <div class="ud-single-faq wow fadeInUp" data-wow-delay=".15s">
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
                    {{ __($page,"What is the name of the company that LibreSign was developed by?",current_path_locale($page))}}
                  </span>
                </button>
                <div id="collapseFive" class="accordion-collapse collapse">
                  <div class="ud-faq-body">
                    {{ __($page,"LibreCode, a Brazilian cooperative of free software developers.",current_path_locale($page))}}
                  </div>
                </div>
              </div>
            </div>
            {{-- <div class="ud-single-faq wow fadeInUp" data-wow-delay=".2s">
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

    <!-- ====== Contact Start ====== -->
    <section id="contact" class="ud-contact">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-xl-8 col-lg-7">
            <div class="ud-contact-content-wrapper">
              <div class="ud-contact-title">
                <span>{{ __($page,"CONTACT US",current_path_locale($page))}}</span>
                <h2>
                  {{ __($page,"Let’s talk about digitally signing your documents!",current_path_locale($page))}}
                </h2>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-lg-5">
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;" id="message"></div>
            <div
              class="ud-contact-form-wrapper wow fadeInUp"
              data-wow-delay=".2s"
            >
              <form class="ud-contact-form" id="WebToLeadForm" 
                name="WebToLeadForm">
                <div class="ud-form-group">
                  <label for="fullName">{{ __($page,"Full Name*",current_path_locale($page))}}</label>
                  <input
                    type="text"
                    name="name"
                    id="name"
                    placeholder="{{__($page,'Type your name',current_path_locale($page))}}"
                    required=""
                  />
                </div>
                <div class="ud-form-group">
                  <label for="email">Email*</label>
                  <input
                    type="email"
                    name="email"
                    id="email"
                    placeholder="example@yourmail.com"
                    required=""
                  />
                </div>
                <div class="ud-form-group">
                  <label for="phone_mobile">{{ __($page,'Phone',current_path_locale($page))}}</label>
                  <input
                    type="text"
                    name="phone_mobile"
                    id="phone_mobile"
                    placeholder="+885 1254 5211 552"
                  />
                </div>
                <div class="ud-form-group">
                  <label for="description">{{ __($page,"Message*",current_path_locale($page))}}</label>
                  <textarea
                    name="description"
                    id="description"
                    rows="1"
                    placeholder="{{__($page,'type your message here',current_path_locale($page))}}"
                    required=""
                  ></textarea>
                </div>
                <div class="ud-form-group">
                  <label for="message">{{ __($page,"Type the code below*",current_path_locale($page))}}</label>
                  <input type="text" name="codeImg" id="codeImg"
                    placeholder="{{__($page,'Type the code below',current_path_locale($page))}}" 
                    required/>
                </div>
                <div class="ud-form-group">
                  <img alt="Image with captcha text"
                    class="me-3 mb-3" 
                    id="captcha"
                  />
                  <button id="btnReload" type="button">
                    <img src="{{ $page->baseUrl }}assets/images/icon/reload.svg" 
                      alt="Button to reload characters captcha"
                      width="30px"
                    />
                  </button>
                  <script>
                    function contentLoad(url) {
                      return new Promise(function (resolve, reject) {
                        var http = new XMLHttpRequest();
                        http.withCredentials = true
                        http.open('GET', url);
                        http.responseType = 'blob';
                        http.onload = function () {
                          if (http.status === 200) {
                            resolve(http.response);
                          } else {
                            reject(new Error('Response didn\'t load successfully; error code:' + http.statusText));
                          }
                        };
                        http.onerror = function () {
                          reject(new Error('There was a network error.'));
                        };
                        http.send();
                      });
                    }

                    function loadImage(token) {
                      contentLoad('{{ $page->url_captcha }}?'+ token).then(function (response) {
                        var myImage = document.getElementById('captcha');
                        myImage.crossOrigin = "";
                        myImage.src = window.URL.createObjectURL(response);
                      }, function (Error) {
                        console.log(Error);
                      });
                    }
                    let token = new Date().getTime()
                    loadImage(token)

                    let reloadButton = document.getElementById("btnReload");
                    let captcha = document.getElementById("captcha");
                    let formCaptpcha = document.forms["WebToLeadForm"];

                    reloadButton.onclick = function () {
                        token = new Date().getTime()
                        loadImage(token)
                    };

                    formCaptpcha.addEventListener("submit", (e) =>  {
                      e.preventDefault();
                      
                      const http = new XMLHttpRequest()
                      http.withCredentials = true
                      http.open('POST', '{{ $page->form_url }}')
                      var form_data = new URLSearchParams(new FormData(formCaptpcha));

                      http.onreadystatechange = function receiveResponse() {

                        if (this.readyState == 4) {
                          if (this.status == 200) {
                            window.top.location.href = '{{ $page->baseUrl }}thank-you-contact'
                          } else {
                            let message = document.getElementById('message')
                            message.textContent = 'Invalid Captcha'
                            message.style.display = 'block'
                          }
                        }
                      };

                      http.send(form_data);
                    });
                  </script>

                  <button id="audioIcon" type="button">
                    <img src="{{ $page->baseUrl }}assets/images/icon/volume-high.svg" 
                      alt="Button to play characters captcha"
                      width="30px"
                    />
                  </button>
                  
                  <script>
                    let audio_icon = document.getElementById('audioIcon')

                    function sound(){
                      contentLoad('{{ $page->url_captcha_audio }}?'+ token).then(function (response) {
                          let audio = new Audio()
                          audio.src = window.URL.createObjectURL(response);
                          audio.play();
                      }, function (Error) {
                          console.log(Error);
                      });
                    }

                    audio_icon.addEventListener("click", sound)
                  </script>
                </div>
                <div class="ud-form-group mb-0">
                  <button type="submit" class="ud-main-btn">
                    {{ __($page,"Send Message",current_path_locale($page))}}
                  </button>
                </div>                
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Contact End ====== -->
@endsection