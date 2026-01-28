<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <!-- Section 1: Logo et description -->
            <div class="footer-section">
                <div class="logo">
                    <i class="fas fa-paw"></i>
                    <h3>PetShop</h3>
                </div>
                <p>{{ $footer_data['description'] ?? 'Nourriture premium et accessoires pour le bien-être de vos animaux de compagnie.' }}</p>
                
                <!-- Coordonnées -->
                @if(isset($footer_data['contact_info']))
                <div class="footer-contact">
                    <p><i class="fas fa-map-marker-alt"></i> {{ $footer_data['contact_info']['address'] ?? '123 Rue des Animaux, 75015 Paris' }}</p>
                    <p><i class="fas fa-phone"></i> {{ $footer_data['contact_info']['phone'] ?? '+33 1 23 45 67 89' }}</p>
                    <p><i class="fas fa-envelope"></i> {{ $footer_data['contact_info']['email'] ?? 'contact@petshop.com' }}</p>
                </div>
                @endif
                
                <!-- Moyens de paiement -->
                <div class="payment-methods">
                    <h4>Moyens de paiement</h4>
                    <div class="payment-icons">
                        <i class="fab fa-cc-visa" title="Visa"></i>
                        <i class="fab fa-cc-mastercard" title="Mastercard"></i>
                        <i class="fab fa-cc-paypal" title="PayPal"></i>
                        <i class="fab fa-cc-apple-pay" title="Apple Pay"></i>
                        <i class="fab fa-cc-amex" title="American Express"></i>
                    </div>
                </div>
            </div>
            
            <!-- Section 2: Catégories -->
            <div class="footer-section">
                <h4>Nos Catégories</h4>
                <ul>
                    @php
                        $categories = $footer_data['categories'] ?? [
                            ['name' => 'Pour Chiens', 'url' => route('produits.categorie', ['cat' => 'chiens']), 'count' => 5],
                            ['name' => 'Pour Chats', 'url' => route('produits.categorie', ['cat' => 'chats']), 'count' => 5],
                            ['name' => 'Pour Oiseaux', 'url' => route('produits.categorie', ['cat' => 'oiseaux']), 'count' => 3],
                            ['name' => 'Pour Rongeurs', 'url' => route('produits.categorie', ['cat' => 'rongeurs']), 'count' => 3],
                            ['name' => 'Pour Poissons', 'url' => route('produits.categorie', ['cat' => 'poissons']), 'count' => 3],
                        ];
                    @endphp
                    
                    @foreach($categories as $category)
                    <li>
                        <a href="{{ $category['url'] }}">
                            <i class="fas fa-chevron-right"></i> {{ $category['name'] }}
                            @if(isset($category['count']))
                            <span class="count-badge">{{ $category['count'] }}</span>
                            @endif
                        </a>
                    </li>
                    @endforeach
                </ul>
                
                <!-- Horaires d'ouverture -->
                @if(isset($footer_data['opening_hours']))
                <div class="opening-hours">
                    <h4>Horaires</h4>
                    <ul>
                        @foreach($footer_data['opening_hours'] as $day => $hours)
                        <li>
                            <span class="day">{{ $day }}:</span>
                            <span class="hours">{{ $hours }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
            
            <!-- Section 3: Liens rapides -->
            <div class="footer-section">
                <h4>Liens Rapides</h4>
                <ul>
                    @php
                        $quick_links = $footer_data['quick_links'] ?? [
                            ['name' => 'À Propos', 'url' => route('about'), 'icon' => 'fas fa-info-circle'],
                            ['name' => 'Contact', 'url' => route('contact'), 'icon' => 'fas fa-envelope'],
                            ['name' => 'Livraison', 'url' => '#', 'icon' => 'fas fa-shipping-fast'],
                            ['name' => 'Retours & Échanges', 'url' => '#', 'icon' => 'fas fa-exchange-alt'],
                            ['name' => 'FAQ', 'url' => '#', 'icon' => 'fas fa-question-circle'],
                            ['name' => 'Conditions Générales', 'url' => '#', 'icon' => 'fas fa-file-contract'],
                            ['name' => 'Politique de confidentialité', 'url' => '#', 'icon' => 'fas fa-shield-alt'],
                        ];
                    @endphp
                    
                    @foreach($quick_links as $link)
                    <li>
                        <a href="{{ $link['url'] }}">
                            <i class="{{ $link['icon'] ?? 'fas fa-chevron-right' }}"></i> {{ $link['name'] }}
                        </a>
                    </li>
                    @endforeach
                </ul>
                
                <!-- Certifications -->
                @if(isset($footer_data['certifications']))
                <div class="certifications">
                    <h4>Nos Certifications</h4>
                    <div class="certification-badges">
                        @foreach($footer_data['certifications'] as $certification)
                        <div class="certification-badge" title="{{ $certification['title'] }}">
                            <i class="{{ $certification['icon'] }}"></i>
                            <span>{{ $certification['name'] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            
            <!-- Section 4: Newsletter et réseaux sociaux -->
            <div class="footer-section">
                <h4>Newsletter</h4>
                <p>{{ $footer_data['newsletter_text'] ?? 'Inscrivez-vous pour recevoir nos offres spéciales et actualités' }}</p>
                
                <form class="newsletter-form" id="newsletter-form">
                    @csrf
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Votre adresse email" required>
                        <button type="submit" class="btn-newsletter">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" id="newsletter-consent" required>
                        <label for="newsletter-consent">
                            J'accepte de recevoir la newsletter
                        </label>
                    </div>
                    <div class="newsletter-message" id="newsletter-message"></div>
                </form>
                
                <!-- Réseaux sociaux -->
                <div class="social-links">
                    <h4>Suivez-nous</h4>
                    @php
                        $social_links = $footer_data['social_links'] ?? [
                            ['platform' => 'Facebook', 'url' => '#', 'icon' => 'fab fa-facebook-f', 'color' => '#1877F2'],
                            ['platform' => 'Instagram', 'url' => '#', 'icon' => 'fab fa-instagram', 'color' => '#E4405F'],
                            ['platform' => 'Twitter', 'url' => '#', 'icon' => 'fab fa-twitter', 'color' => '#1DA1F2'],
                            ['platform' => 'Pinterest', 'url' => '#', 'icon' => 'fab fa-pinterest-p', 'color' => '#BD081C'],
                            ['platform' => 'YouTube', 'url' => '#', 'icon' => 'fab fa-youtube', 'color' => '#FF0000'],
                            ['platform' => 'TikTok', 'url' => '#', 'icon' => 'fab fa-tiktok', 'color' => '#000000'],
                        ];
                    @endphp
                    
                    <div class="social-icons">
                        @foreach($social_links as $social)
                        <a href="{{ $social['url'] }}" 
                           class="social-icon" 
                           title="{{ $social['platform'] }}"
                           style="background-color: {{ $social['color'] }}"
                           target="_blank"
                           rel="noopener noreferrer">
                            <i class="{{ $social['icon'] }}"></i>
                        </a>
                        @endforeach
                    </div>
                </div>
                
                <!-- Applications mobiles -->
                @if(isset($footer_data['mobile_apps']))
                <div class="mobile-apps">
                    <h4>Téléchargez notre app</h4>
                    <div class="app-badges">
                        @foreach($footer_data['mobile_apps'] as $app)
                        <a href="{{ $app['url'] }}" class="app-badge">
                            <i class="{{ $app['icon'] }}"></i>
                            <div class="app-info">
                                <span class="app-name">{{ $app['name'] }}</span>
                                <span class="app-platform">{{ $app['platform'] }}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
        
        <!-- Ligne de séparation -->
        <div class="footer-divider"></div>
        
        <!-- Section bas de footer -->
        <div class="footer-bottom">
            <div class="footer-bottom-left">
                <p>&copy; {{ date('Y') }} {{ $footer_data['company_name'] ?? 'PetShop' }}. Tous droits réservés.</p>
                <p class="footer-siret">
                    @if(isset($footer_data['legal_info']))
                    SIRET: {{ $footer_data['legal_info']['siret'] ?? '' }} | 
                    TVA: {{ $footer_data['legal_info']['vat'] ?? '' }} | 
                    RCS: {{ $footer_data['legal_info']['rcs'] ?? '' }}
                    @endif
                </p>
            </div>
            
            <div class="footer-bottom-right">
                <!-- Langue / Devise -->
                <div class="footer-selectors">
                    <select id="language-selector" class="footer-select">
                        <option value="fr" selected>Français</option>
                        <option value="en">English</option>
                        <option value="es">Español</option>
                        <option value="de">Arabe</option>
                    </select>
                    
                    
                </div>
                
                <!-- Liens légaux -->
                <div class="legal-links">
                    @php
                        $legal_links = $footer_data['legal_links'] ?? [
                            ['name' => 'Mentions légales', 'url' => '#'],
                            ['name' => 'CGV', 'url' => '#'],
                            ['name' => 'CGU', 'url' => '#'],
                            ['name' => 'Politique cookies', 'url' => '#'],
                            ['name' => 'Plan du site', 'url' => '#'],
                        ];
                    @endphp
                    
                    @foreach($legal_links as $link)
                    <a href="{{ $link['url'] }}" class="legal-link">{{ $link['name'] }}</a>
                    @if(!$loop->last)<span class="separator">|</span>@endif
                    @endforeach
                </div>
            </div>
        </div>
        
        <!-- Retour en haut -->
        <button id="back-to-top" class="back-to-top">
            <i class="fas fa-chevron-up"></i>
        </button>
    </div>
</footer>