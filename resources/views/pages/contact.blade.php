@extends('layout.app')

@section('content')
    <!-- Contact Hero -->
    <section class="page-hero">
        <div class="container">
            <h1>Contactez-nous</h1>
            <p>Nous sommes là pour répondre à toutes vos questions concernant nos produits</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="contact-grid">
                <!-- Contact Form -->
                <div class="contact-form-container">
                    <h2 class="section-title">Envoyez-nous un message</h2>
                    <form class="contact-form">
                        <div class="form-group">
                            <label for="name">Nom complet *</label>
                            <input type="text" id="name" placeholder="Votre nom" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Adresse email *</label>
                            <input type="email" id="email" placeholder="votre@email.com" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="subject">Sujet *</label>
                            <select id="subject" required>
                                <option value="">Sélectionnez un sujet</option>
                                <option value="product">Question sur un produit</option>
                                <option value="order">Suivi de commande</option>
                                <option value="return">Retour/Échange</option>
                                <option value="other">Autre</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Message *</label>
                            <textarea id="message" rows="6" placeholder="Votre message..." required></textarea>
                        </div>
                        
                        <button type="submit" class="btn-primary">Envoyer le message</button>
                    </form>
                </div>
                
                <!-- Contact Info -->
                <div class="contact-info">
                    <h2 class="section-title">Nos Coordonnées</h2>
                    
                    <div class="contact-method">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h3>Email</h3>
                            <p>contact@petshop.com</p>
                            <p>support@petshop.com</p>
                        </div>
                    </div>
                    
                    <div class="contact-method">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <h3>Téléphone</h3>
                            <p>o5 23 45 67 89</p>
                            <p>Lundi - Vendredi : 9h-18h</p>
                        </div>
                    </div>
                    
                    <div class="contact-method">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h3>Adresse</h3>
                            <p>123 Rue des Animaux</p>
                            <p>9000 Tanger, Maroc</p>
                        </div>
                    </div>
                    
                    <div class="contact-method">
                        <div class="contact-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <h3>Horaires</h3>
                            <p>Service client : 9h-18h</p>
                            <p>Livraison : 7j/7</p>
                        </div>
                    </div>
                    
                    <div class="social-links">
                        <h3>Suivez-nous</h3>
                        <div class="social-icons">
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-tiktok"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="container">
            <h2 class="section-title">Questions Fréquentes</h2>
            <div class="faq-grid">
                <div class="faq-item">
                    <h3>Quels sont les délais de livraison ?</h3>
                    <p>Nos délais standards sont de 2-3 jours ouvrés en France métropolitaine. Les commandes passées avant 14h sont expédiées le jour même.</p>
                </div>
                <div class="faq-item">
                    <h3>Proposez-vous des échantillons ?</h3>
                    <p>Oui ! Nous offrons des échantillons de nos nouvelles formules sur demande. Contactez-nous pour en savoir plus.</p>
                </div>
                <div class="faq-item">
                    <h3>Quelle est votre politique de retour ?</h3>
                    <p>Nous acceptons les retours sous 30 jours pour les produits non ouverts. Les frais de retour sont à la charge du client.</p>
                </div>
                <div class="faq-item">
                    <h3>Vos produits sont-ils adaptés aux animaux sensibles ?</h3>
                    <p>Oui, nous proposons des gammes spécifiques pour les animaux ayant des sensibilités alimentaires. Consultez notre section "aliments hypoallergéniques".</p>
                </div>
            </div>
        </div>
    </section>
@endsection