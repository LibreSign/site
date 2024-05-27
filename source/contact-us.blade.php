@extends('_layouts.main')

@section('body')
    <section class="ud-hero" id="home">
        <div class="container">
        <div class="row">
            <div class="col-lg-12">
            <div class="ud-hero-content wow fadeInUp" data-aos-delay=".2s">
                <h1 class="ud-hero-title">
                {{ $page->t('Contact') }}
                </h1>
                <p class="ud-hero-desc">
                {{ $page->t('Fill in the fields below with your data') }}
                </p>
            </div>
            </div>
        </div>
        </div>
    </section>

    <!-- ====== Contact Start ====== -->
    <section id="contact" class="ud-contac mt-5">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-xl-8 col-lg-7">
              <div class="ud-contact-content-wrapper">
                <div class="ud-contact-title">
                  <h2>{{ $page->t("Let’s talk about digitally signing your documents!")}}</h2>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-5">
              <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;" id="message"></div>
              <div
                class="ud-contact-form-wrapper wow fadeInUp"
                data-aos-delay=".2s"
              >
                <form class="ud-contact-form" id="WebToLeadForm"
                  name="WebToLeadForm">
                  <div class="ud-form-group">
                    <label for="fullName">{{ $page->t("Full Name")}} *</label>
                    <input
                      type="text"
                      name="name"
                      id="name"
                      placeholder="{{$page->t('Type your name')}}"
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
                    <label for="phone_mobile">{{ $page->t('Phone')}}</label>
                    <input
                      type="text"
                      name="phone_mobile"
                      id="phone_mobile"
                      placeholder="+885 1254 5211 552"
                    />
                  </div>
                  <div class="ud-form-group">
                    <label for="description">{{ $page->t("Message")}} *</label>
                    <textarea
                      name="description"
                      id="description"
                      rows="1"
                      placeholder="{{$page->t('Type your message here')}}"
                      required=""
                    ></textarea>
                  </div>
                  <div class="ud-form-group">
                    <label for="message">{{ $page->t("Type the code below")}} *</label>
                    <input type="text" name="codeImg" id="codeImg"
                      placeholder="{{$page->t('Type the code below')}}"
                      required/>
                  </div>
                  <div class="ud-form-group">
                    <img alt="{{ $page->t('Image with captcha text') }}"
                      class="me-3 mb-3"
                      id="captcha"
                    />
                    <button id="btnReload" type="button">
                      <img src="{{ $page->baseUrl }}assets/images/icon/reload.svg"
                        alt="{{ $page->t( 'Button to reload characters captcha') }}"
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
                              window.top.location.href = 'thank-you-contact'
                            } else {
                              let message = document.getElementById('message')
                              message.textContent = '{{ $page->t( 'Invalid Captcha') }}'
                              message.style.display = 'block'
                            }
                          }
                        };
  
                        http.send(form_data);
                      });
                    </script>
  
                    <button id="audioIcon" type="button">
                      <img src="{{ $page->baseUrl }}assets/images/icon/volume-high.svg"
                        alt="{{ $page->t( 'Button to play characters captcha') }}"
                        width="30px"
                      />
                    </button>
  
                    <script>
                      let audio_icon = document.getElementById('audioIcon')
  
                      function sound(){
                        contentLoad('{{ $page->url_captcha_audio }}?'+ token + '&lang={{ current_path_locale($page) }}').then(function (response) {
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
                      {{ $page->t("Send Message")}}
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