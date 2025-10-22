<footer class="ud-footer wow fadeInUp" data-aos-delay=".15s">
    <div>
        <div class="container">
            <div class="row widgets">
                <div class="col-12 col-lg-4">
                    <div class="ud-widget">
                        <a href="{{ locale_url($page, '') }}" class="ud-footer-logo">
                            <img src="{{ $page->baseUrl }}assets/images/logo/logo.svg" alt="LibreSign" />
                        </a>
                        <p class="ud-widget-desc">
                            {{ $page->t("We create digital experiences for brands and companies by using technology.")}}
                        </p>
                        <ul class="ud-widget-socials">
                            <li>
                                <a target="_blank" href="https://github.com/LibreSign/libresign" title="{{ $page->t('LibreSign GitHub repository')}}">
                                    @include('_partials.social-icons', ['icon' => 'github'])
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://www.linkedin.com/company/libresign/" title="{{ $page->t('LibreSign LinkedIn page')}}">
                                    @include('_partials.social-icons', ['icon' => 'linkedin'])
                                </a>
                            </li>
                            <li>
                              <a target="_blank" href="https://t.me/LibreSign" title="{{ $page->t('LibreSign Telegram group')}}">
                                  @include('_partials.social-icons', ['icon' => 'telegram'])
                              </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://www.instagram.com/libresign/" title="{{ $page->t('LibreSign Instagram profile')}}">
                                    @include('_partials.social-icons', ['icon' => 'instagram'])
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="ud-widget">
                        <a id="coop-logo" target="_blank" href="https://www.somos.coop.br/" title="{{ $page->t('Page to national movement that valozie cooperative initiatives.')}}">
                            <img src="{{ $page->baseUrl }}assets/images/icon/somoscoop.png" alt="We areCoop">
                        </a>

                        <p id="copyright">&copy; {{ date('Y') }} LibreSign. {{ $page->t('All rights reserved.')}}</p>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg">
                    <div class="ud-widget">
                        <ul class="ud-widget-links">
                            <li>
                                <a href="{{ locale_url($page, 'solutions') }}">{{ $page->t("Solutions")}}</a>
                            </li>
                            <li>
                                <a href="{{ locale_url($page, 'features') }}">{{ $page->t("Features")}}</a>
                            </li>
                            <li>
                                <a href="{{ locale_url($page, 'pricing') }}">{{ $page->t("Plans and Pricing")}}</a>
                            </li>
                            <li>
                                <a href="{{ locale_url($page, 'about') }}">{{ $page->t("About")}}</a>
                            </li>
                            <li>
                                <a href="{{ locale_url($page, 'blog') }}">{{ $page->t("Blog")}}</a>
                            </li>
                            <li>
                                <a href="{{ locale_url($page, 'ebooks') }}">{{ $page->t("E-books library")}}</a>
                            </li>
                            <li>
                                <a href="{{ locale_url($page, 'newsletter') }}">{{ $page->t("Newsletter")}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg">
                    <div class="ud-widget">
                        <ul class="ud-widget-links">
                            <li>
                                <a href="{{ locale_url($page, 'success-stories') }}">{{ $page->t("Success stories")}}</a>
                            </li>
                            <li>
                                <a href="{{ locale_url($page, 'academy') }}">{{ $page->t("LibreSign Academy")}}</a>
                            </li>
                            <li>
                                <a href="{{ locale_url($page, 'cooperativism') }}">{{ $page->t("Cooperativism")}}</a>
                            </li>
                            <li>
                                <a href="{{ locale_url($page, 'sales') }}">{{ $page->t("Talk to sales")}}</a>
                            </li>
                            <li>
                                <a href="{{ locale_url($page, 'support') }}">{{ $page->t("Support")}}</a>
                            </li>
                            <li>
                                <a href="{{ locale_url($page, 'jobs') }}">{{ $page->t("Work with us")}}</a>
                            </li>
                            <li>
                                <a href="{{ locale_url($page, 'privacy') }}">{{ $page->t("Privacy Policy")}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-lg">
                    <div id="address">
                        <p>
                            {{ $page->t("Quinze de Novembro Street, 106, 3rd Floor, Room 309 - Centro") }} <br />
                            Niteroi - RJ
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ====== Back To Top Start ====== -->
    <a id="back-to-top" 
       class="back-to-top" 
       href="#" 
       role="button"
       aria-label="{{ $page->t('Back to top') }}"
       aria-hidden="true"
       tabindex="0">
        <i class="lni lni-chevron-up" aria-hidden="true"></i>
    </a>
    <!-- ====== Back To Top End ====== -->
    <div id="footer-contact" 
         class="" 
         role="button"
         aria-label="{{ $page->t('Contact sales team for a quote') }}"
         aria-hidden="true"
         tabindex="0">
        <div class="bubble">
            <p>{{ $page->t("How about an exclusive quote to sign up for LibreSign?") }}</p>
        </div>
        <div>
        <div class="image">
            <img src="{{ $page->baseUrl }}assets/images/footer/attendant.png" alt="{{ $page->t('Contact sales team') }}" />
            <div class="status" aria-hidden="true"></div>
        </div>
    </div>
</footer>
