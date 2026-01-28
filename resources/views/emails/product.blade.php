<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Produit recommandé</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #4CAF50, #FF9800);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: white;
            padding: 30px;
            border: 1px solid #ddd;
        }
        .product-card {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            display: flex;
            gap: 20px;
            align-items: center;
        }
        .product-image {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            object-fit: cover;
        }
        .no-image {
            width: 100px;
            height: 100px;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            color: #6c757d;
        }
        .product-info h3 {
            margin: 0 0 10px 0;
            color: #4CAF50;
        }
        .category {
            background: #4CAF50;
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            display: inline-block;
            margin-bottom: 10px;
        }
        .price {
            font-size: 18px;
            font-weight: bold;
            color: #4CAF50;
        }
        .message-box {
            background: #e3f2fd;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #2196F3;
        }
        .footer {
            background: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-radius: 0 0 10px 10px;
            color: #666;
            font-size: 14px;
        }
        .btn {
            display: inline-block;
            background: #4CAF50;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🐾 PetShop - Produit Recommandé</h1>
        <p>Quelqu'un vous recommande ce produit !</p>
    </div>

    <div class="content">
        <p>Bonjour,</p>
        
        <p><strong>{{ $sender_name }}</strong> ({{ $sender_email }}) vous recommande ce produit de notre animalerie :</p>

        <div class="product-card">
            <div>
                @if($produit->image)
                    <img src="{{ $produit->image }}" alt="{{ $produit->nom }}" class="product-image">
                @else
                    <div class="no-image">📦</div>
                @endif
            </div>
            <div class="product-info">
                <h3>{{ $produit->nom }}</h3>
                <span class="category">{{ ucfirst($produit->categorie) }}</span>
                <div class="price">{{ number_format($produit->prix, 2, ',', ' ') }} DH</div>
                <p>{{ $produit->description }}</p>
            </div>
        </div>

        @if($message_content)
            <div class="message-box">
                <h4>💬 Message personnel :</h4>
                <p>{{ $message_content }}</p>
            </div>
        @endif

        <div style="text-align: center;">
            <a href="{{ url('/produit/' . $produit->id) }}" class="btn">
                Voir le produit
            </a>
        </div>

        <p>Découvrez tous nos produits pour animaux sur notre site !</p>
    </div>

    <div class="footer">
        <p>Cet email a été envoyé depuis PetShop</p>
        <p>© {{ date('Y') }} PetShop - Animalerie en ligne</p>
    </div>
</body>
</html>