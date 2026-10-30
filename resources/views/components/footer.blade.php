<!-- FOOTER -->
<footer class="site-footer">
    <div class="footer-container">
        <!-- Header Footer: Logo & Ikuti Kami -->
        <div class="footer-top">
            <div class="footer-brand">
                <img src="{{ asset('images/logo_tefa.png') }}" alt="Logo TEFA" class="footer-logo">
                <div class="footer-brand-text">
                    <h3>KATALOG TEFA</h3>
                    <p>SMKN 4 Tanjungpinang</p>
                </div>
            </div>

            <div class="footer-social">
                <span class="social-label">{{ __('messages.footer_follow') }}</span>
                <a href="https://instagram.com/katalog.skanfour" target="_blank" rel="noopener noreferrer" class="social-icon instagram" title="Instagram @katalog.skanfour">
                    <i class="fa-brands fa-instagram"></i>
                </a>
            </div>
        </div>

        <hr class="footer-divider">

        <!-- Body Footer: Menu / Link -->
        <div class="footer-grid">
            <!-- Kolom 1: Tentang TEFA -->
            <div class="footer-col">
                <h4>Katalog TEFA</h4>
                <p class="footer-about">
                    {{ __('messages.footer_tagline') }}
                </p>
            </div>

            <!-- Kolom 2: Navigasi Cepat -->
            <div class="footer-col">
                <h4>{{ __('messages.footer_navigation') }}</h4>
                <ul class="footer-links">
                    <li><a href="/">{{ __('messages.nav_home') }}</a></li>
                    <li><a href="/katalog?kategori=all">{{ __('messages.footer_catalog_link') }}</a></li>
                    <li><a href="/status">{{ __('messages.footer_status_link') }}</a></li>
                    <li><a href="/portofolio">{{ __('messages.footer_portfolio_link') }}</a></li>
                </ul>
            </div>

            <!-- Kolom 3: Hubungi Kami -->
            <div class="footer-col">
                <h4>{{ __('messages.footer_contact') }}</h4>
                <ul class="footer-contact-list">
                    <li>
                        <i class="fa-brands fa-whatsapp"></i>
                        <a href="https://wa.me/6281277805796" target="_blank" rel="noopener noreferrer">
                            +62 812-7780-5796
                        </a>
                    </li>
                    <li>
                        <i class="fa-regular fa-envelope"></i>
                        <a href="mailto:tefa5smkn4tpi@gmail.com">
                            tefa5smkn4tpi@gmail.com
                        </a>
                    </li>
                    <li>
                        <i class="fa-solid fa-headset"></i>
                        <a href="/customer-service">
                            Live {{ __('messages.customer_service') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <hr class="footer-divider-subtle">

        <!-- Bottom Copyright -->
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} TEFA SMKN 4 Tanjungpinang. {{ __('messages.footer_copyright') }}</p>
        </div>
    </div>
</footer>

