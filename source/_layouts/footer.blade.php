<footer class="ud-footer wow fadeInUp" data-aos-delay=".15s">
    <div>
        <div class="container">
            <div class="row widgets">
                <div class="col-12 col-lg-4">
                    <div class="ud-widget">
                        <a href="{{ locale_url($page, '') }}" class="ud-footer-logo" aria-label="{{ $page->t('LibreSign - Go to homepage') }}">
                            <img src="{{ $page->baseUrl }}assets/images/logo/logo.svg" alt="LibreSign" />
                        </a>
                        <p class="ud-widget-desc">
                            {{ $page->t("We create digital experiences for brands and companies by using technology.")}}
                        </p>
                        <nav aria-label="{{ $page->t('Social media links') }}">
                            <h3 class="visually-hidden">{{ $page->t("Follow us on social media") }}</h3>
                            <ul class="ud-widget-socials">
                                <li>
                                    <a target="_blank" 
                                       rel="noopener noreferrer"
                                       href="https://github.com/LibreSign/libresign" 
                                       aria-label="{{ $page->t('Visit our GitHub repository (opens in new tab)')}}">
                                        @include('_partials.social-icons', ['icon' => 'github'])
                                    </a>
                                </li>
                                <li>
                                    <a target="_blank" 
                                       rel="noopener noreferrer"
                                       href="https://www.linkedin.com/company/libresign/" 
                                       aria-label="{{ $page->t('Follow us on LinkedIn (opens in new tab)')}}">
                                        @include('_partials.social-icons', ['icon' => 'linkedin'])
                                    </a>
                                </li>
                                <li>
                                    <a target="_blank" 
                                       rel="noopener noreferrer"
                                       href="https://t.me/LibreSign" 
                                       aria-label="{{ $page->t('Join our Telegram group (opens in new tab)')}}">
                                        @include('_partials.social-icons', ['icon' => 'telegram'])
                                    </a>
                                </li>
                                <li>
                                    <a target="_blank" 
                                       rel="noopener noreferrer"
                                       href="https://www.instagram.com/libresign/" 
                                       aria-label="{{ $page->t('Follow us on Instagram (opens in new tab)')}}">
                                        @include('_partials.social-icons', ['icon' => 'instagram'])
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <div class="ud-widget">
                        <a id="coop-logo" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           href="https://www.somos.coop.br/" 
                           aria-label="{{ $page->t('Somos.Coop - National movement that values cooperative initiatives (opens in new tab)')}}">
                            <img src="{{ $page->baseUrl }}assets/images/icon/somoscoop.png" alt="Somos.Coop" aria-hidden="true">
                        </a>

                        <p id="copyright">&copy; {{ date('Y') }} LibreSign. {{ $page->t('All rights reserved.')}}</p>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg">
                    <nav class="ud-widget" aria-labelledby="footer-nav-1">
                        <h3 id="footer-nav-1" class="visually-hidden">{{ $page->t("Quick links") }}</h3>
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
                    </nav>
                </div>
                <div class="col-12 col-sm-6 col-lg">
                    <nav class="ud-widget" aria-labelledby="footer-nav-2">
                        <h3 id="footer-nav-2" class="visually-hidden">{{ $page->t("Resources and support") }}</h3>
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
                    </nav>
                </div>
                <div class="col-12 col-lg">
                    <div class="ud-widget ud-widget-address">
                        <h3 class="visually-hidden">{{ $page->t("Contact information") }}</h3>
                        <address id="address">
                            {{ $page->t("Quinze de Novembro Street, 106, 3rd Floor, Room 309 - Centro") }} <br />
                            Niteroi - RJ
                        </address>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ====== Back To Top Start ====== -->
    <a id="back-to-top" 
       class="back-to-top" 
       href="#top" 
       aria-label="{{ $page->t('Back to top') }}">
        <i class="lni lni-chevron-up" aria-hidden="true"></i>
    </a>
    <!-- ====== Back To Top End ====== -->
    <button id="footer-contact" 
            type="button"
            aria-label="{{ $page->t('Contact sales team for a quote') }}">
        <div class="bubble bubble-text">
            <p>{{ $page->t("How about an exclusive quote to sign up for LibreSign?") }}</p>
        </div>
        <div class="image-wrapper">
            <div class="image">
                <img src="{{ $page->baseUrl }}assets/images/footer/attendant.png" alt="" role="presentation" />
                <div class="status" aria-hidden="true"></div>
            </div>
        </div>
    </button>
</footer>
