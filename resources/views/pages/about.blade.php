@extends('layout.app')

@section('content')
    <!-- About Hero -->
    <section class="page-hero">
        <div class="container">
            <h1>À Propos de PetShop</h1>
            <p>Notre histoire, nos valeurs et notre engagement envers le bien-être animal</p>
        </div>
    </section>

    <!-- Our Story -->
    <section class="about-section">
        <div class="container">
            <div class="about-content">
                <h2 class="section-title">Notre Histoire</h2>
                <p>
                    Fondée en 2023 par des passionnés d'animaux, <strong>PetShop</strong> est née d'une simple conviction : 
                    nos compagnons méritent une alimentation de qualité, adaptée à leurs besoins spécifiques.
                </p>
                <p>
                    Après avoir constaté le manque de transparence dans l'industrie de la nourriture pour animaux, 
                    nous avons décidé de créer une marque qui privilégie la qualité, la naturalité et l'éthique.
                </p>
                <p>
                    Aujourd'hui, nous sommes fiers de proposer une gamme complète de produits soigneusement sélectionnés, 
                    tous testés et approuvés par des professionnels de la santé animale.
                </p>
            </div>
            <div class="about-image">
                <div class="image-placeholder">
                    <i class="fas fa-paw"></i>
                    <p>Notre équipe et nos compagnons</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Values -->
    <section class="values-section">
        <div class="container">
            <h2 class="section-title">Nos Valeurs</h2>
            <div class="values-grid">
                <div class="value-card">
                    <h3><i class="fas fa-heart"></i> Bien-être Animal</h3>
                    <p>Nous plaçons la santé et le bonheur des animaux au centre de toutes nos décisions.</p>
                </div>
                <div class="value-card">
                    <h3><i class="fas fa-leaf"></i> Durabilité</h3>
                    <p>Nos emballages sont 100% recyclables et nous favorisons les ingrédients locaux.</p>
                </div>
                <div class="value-card">
                    <h3><i class="fas fa-graduation-cap"></i> Transparence</h3>
                    <p>Nous détaillons tous les ingrédients de nos produits, sans secrets ni cachoteries.</p>
                </div>
                <div class="value-card">
                    <h3><i class="fas fa-hands-helping"></i> Communauté</h3>
                    <p>Nous soutenons les refuges locaux et participons à des programmes d'adoption.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Team -->
    <section class="team-section">
        <div class="container">
            <h2 class="section-title">Notre Engagement</h2>
            <div class="commitment">
                <div class="commitment-item">
                    <i class="fas fa-check-circle"></i>
                    <p>Tous nos produits sont certifiés sans OGM</p>
                </div>
                <div class="commitment-item">
                    <i class="fas fa-check-circle"></i>
                    <p>Ingrédients sourcés de manière responsable</p>
                </div>
                <div class="commitment-item">
                    <i class="fas fa-check-circle"></i>
                    <p>Formules développées avec des vétérinaires</p>
                </div>
                <div class="commitment-item">
                    <i class="fas fa-check-circle"></i>
                    <p>Emballages écologiques et recyclables</p>
                </div>
            </div>
        </div>
    </section>
@endsection