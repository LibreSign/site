<footer class="ud-footer wow fadeInUp" data-aos-delay=".15s">
    <div>
        <div class="container">
            <div class="row widgets">
                <div class="col-12 col-lg-4">
                    <div class="ud-widget">
                        <a href="{{ locale_url($page, '') }}" class="ud-footer-logo" aria-label="{{ $page->t('LibreSign - Go to homepage') }}">
                            <img src="{{ $page->baseUrl }}assets/images/logo/logo.svg" alt="LibreSign">
                        </a>
                        <p class="ud-widget-desc">
                            {{ $page->t("Open source electronic signature integrated with Nextcloud. Self-hosted, secure, and built for organizations that value privacy and data sovereignty.")}}
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
                        <address id="address" class="ud-widget-address">
                            {{ $page->t("Quinze de Novembro Street, 106, 3rd Floor, Room 309 - Centro") }} <br>
                            Niteroi - RJ
                        </address>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg">
                    <nav class="ud-widget" aria-labelledby="footer-nav-product">
                        <h3 id="footer-nav-product" class="ud-widget-title">{{ $page->t("Product") }}</h3>
                        <ul class="ud-widget-links">
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
                                <a href="{{ locale_url($page, 'posts') }}">{{ $page->t("Blog")}}</a>
                            </li>
                            <li>
                                <a href="{{ locale_url($page, 'ebooks') }}">{{ $page->t("E-books")}}</a>
                            </li>
                            <li>
                                <a href="{{ locale_url($page, 'faq') }}">{{ $page->t("FAQ")}}</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-12 col-sm-6 col-lg">
                    <nav class="ud-widget" aria-labelledby="footer-nav-company">
                        <h3 id="footer-nav-company" class="ud-widget-title">{{ $page->t("Company") }}</h3>
                        <ul class="ud-widget-links">
                            <li>
                                <a href="{{ locale_url($page, 'contact-us') }}">{{ $page->t("Contact us")}}</a>
                            </li>
                            <li>
                                <a href="{{ locale_url($page, 'success-stories') }}">{{ $page->t("Success Stories")}}</a>
                            </li>
                            <li>
                                <a href="{{ locale_url($page, 'team') }}">{{ $page->t("Team")}}</a>
                            </li>
                            <li>
                                <a href="{{ locale_url($page, 'cooperatives') }}">{{ $page->t("Cooperatives")}}</a>
                            </li>
                            <li>
                                <a href="{{ locale_url($page, 'privacy-policy') }}">{{ $page->t("Privacy Policy")}}</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-12 col-sm-6 col-lg">
                    <nav class="ud-widget" aria-labelledby="footer-nav-open-source">
                        <h3 id="footer-nav-open-source" class="ud-widget-title">{{ $page->t("Open Source") }}</h3>
                        <ul class="ud-widget-links">
                            <li>
                                <a href="https://github.com/LibreSign/libresign" target="_blank" rel="noopener noreferrer">{{ $page->t("GitHub Repository")}}</a>
                            </li>
                            <li>
                                <a href="https://docs.libresign.coop" target="_blank" rel="noopener noreferrer">{{ $page->t("Documentation")}}</a>
                            </li>
                            <li>
                                <a href="https://github.com/LibreSign/libresign/issues" target="_blank" rel="noopener noreferrer">{{ $page->t("Report an issue")}}</a>
                            </li>
                            <li>
                                <a href="https://github.com/LibreSign/libresign/blob/main/CONTRIBUTING.md" target="_blank" rel="noopener noreferrer">{{ $page->t("How to contribute")}}</a>
                            </li>
                            <li>
                                <a href="https://apps.nextcloud.com/apps/libresign" target="_blank" rel="noopener noreferrer">{{ $page->t("Nextcloud App Store")}}</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

</footer>
<!-- ====== Back To Top Start ====== -->
<a id="back-to-top"
   class="back-to-top"
   href="#top"
   aria-label="{{ $page->t('Back to top') }}">
    <i class="lni lni-chevron-up" aria-hidden="true"></i>
</a>
<!-- ====== Back To Top End ====== -->
<div id="footer-contact"
     role="button"
     tabindex="0"
     data-contact-url="https://wa.me/552120422073?text=Ol%C3%A1%2C%20quero%20um%20or%C3%A7amento%20do%20LibreSign"
     aria-label="{{ $page->t('Contact sales team for a quote') }}">
    <div class="bubble bubble-text">
        <p>{{ $page->t("How about an exclusive quote to sign up for LibreSign?") }}</p>
    </div>
    <div class="image-wrapper">
        <div class="image">
            <img src="{{ $page->baseUrl }}assets/images/footer/attendant.png" alt="" aria-hidden="true">
            <div class="status" aria-hidden="true"></div>
        </div>
    </div>
</div>
