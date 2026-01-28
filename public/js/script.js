document.addEventListener('DOMContentLoaded', function() {
    // Mobile menu toggle
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function() {
            navMenu.classList.toggle('active');
        });
    }
    
    // Close mobile menu when clicking outside
    document.addEventListener('click', function(event) {
        if (!event.target.closest('.navbar')) {
            navMenu.classList.remove('active');
        }
    });
    
    // Newsletter form
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const emailInput = newsletterForm.querySelector('input[type="email"]');
            if (emailInput.value) {
                alert('Merci pour votre inscription à notre newsletter !');
                emailInput.value = '';
            }
        });
    }
    
    // Add to cart buttons
    const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
    const cartCount = document.querySelector('.cart-count');
    
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            let currentCount = parseInt(cartCount.textContent);
            cartCount.textContent = currentCount + 1;
            
            // Animation
            cartCount.style.transform = 'scale(1.5)';
            setTimeout(() => {
                cartCount.style.transform = 'scale(1)';
            }, 300);
            
            // Update localStorage
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            cart.push(productId);
            localStorage.setItem('cart', JSON.stringify(cart));
            
            alert('Produit ajouté au panier !');
        });
    });
    
    // Quantity selector
    const quantitySelectors = document.querySelectorAll('.quantity-selector');
    quantitySelectors.forEach(selector => {
        const minusBtn = selector.querySelector('.minus');
        const plusBtn = selector.querySelector('.plus');
        const qtyInput = selector.querySelector('.qty-input');
        
        minusBtn.addEventListener('click', function() {
            let currentValue = parseInt(qtyInput.value);
            if (currentValue > 1) {
                qtyInput.value = currentValue - 1;
            }
        });
        
        plusBtn.addEventListener('click', function() {
            let currentValue = parseInt(qtyInput.value);
            let maxValue = parseInt(qtyInput.getAttribute('max')) || 99;
            if (currentValue < maxValue) {
                qtyInput.value = currentValue + 1;
            }
        });
        
        qtyInput.addEventListener('change', function() {
            let value = parseInt(this.value);
            let minValue = parseInt(this.getAttribute('min')) || 1;
            let maxValue = parseInt(this.getAttribute('max')) || 99;
            
            if (value < minValue) this.value = minValue;
            if (value > maxValue) this.value = maxValue;
        });
    });
    
    // Initialize cart count from localStorage
    if (cartCount) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        cartCount.textContent = cart.length;
    }
});

// Delete confirmation function
function confirmDelete(productId, productName) {
    if (confirm(`Êtes-vous sûr de vouloir supprimer le produit "${productName}" ?`)) {
        // Create and submit delete form
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/produits/${productId}`;
        
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        
        const tokenInput = document.createElement('input');
        tokenInput.type = 'hidden';
        tokenInput.name = '_token';
        tokenInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        form.appendChild(methodInput);
        form.appendChild(tokenInput);
        document.body.appendChild(form);
        form.submit();
    }
}