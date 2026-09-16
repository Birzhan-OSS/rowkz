document.addEventListener('DOMContentLoaded', function() {
    // Инициализация корзины
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    
    // Обновление счетчика корзины
    function updateCartCount() {
        const count = cart.reduce((total, item) => total + item.quantity, 0);
        document.getElementById('cart-count').textContent = count;
    }
    
    // Обновление отображения корзины
    function updateCartDisplay() {
        const cartContent = document.getElementById('cart-content');
        const cartTotal = document.getElementById('cart-total');
        const cartTotalDiv = document.querySelector('.cart-total');
        const checkoutBtn = document.getElementById('checkout-btn');
        
        if (cart.length === 0) {
            cartContent.innerHTML = `
                <div class="cart-empty">
                    <i class="bi bi-cart-x" style="font-size: 3rem; color: #ccc;"></i>
                    <p>Ваша корзина пуста</p>
                </div>
            `;
            cartTotalDiv.classList.add('d-none');
            checkoutBtn.classList.add('d-none');
        } else {
            let html = '';
            
            cart.forEach((item, index) => {
                html += `
                    <div class="cart-item">
                        <img src="${item.image}" alt="${item.title}">
                        <div class="cart-item-details">
                            <div class="cart-item-title">${item.title}</div>
                            <div class="cart-item-price">Цена по запросу</div>
                        </div>
                        <div class="cart-item-quantity">
                            <button class="quantity-btn" onclick="updateQuantity(${index}, -1)">-</button>
                            <span>${item.quantity}</span>
                            <button class="quantity-btn" onclick="updateQuantity(${index}, 1)">+</button>
                        </div>
                        <button class="btn btn-sm btn-danger" onclick="removeFromCart(${index})">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                `;
            });
            
            cartContent.innerHTML = html;
            cartTotal.textContent = 'Цена по запросу';
            cartTotalDiv.classList.remove('d-none');
            checkoutBtn.classList.remove('d-none');
        }
        
        updateCartCount();
    }
    
    // Добавление товара в корзину
    window.addToCart = function(postId, title, price, image) {
        const existingItem = cart.find(item => item.postId === postId);
        
        if (existingItem) {
            existingItem.quantity++;
        } else {
            cart.push({
                postId: postId,
                title: title,
                price: price,
                image: image,
                quantity: 1
            });
        }
        
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartCount();
        
        // Показываем уведомление
        showNotification('Товар добавлен в корзину');
    };
    
    // Обновление количества товара
    window.updateQuantity = function(index, change) {
        cart[index].quantity += change;
        
        if (cart[index].quantity <= 0) {
            cart.splice(index, 1);
        }
        
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartDisplay();
    };
    
    // Удаление товара из корзины
    window.removeFromCart = function(index) {
        cart.splice(index, 1);
        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartDisplay();
    };
    
    // Показ уведомления
    function showNotification(message) {
        const notification = document.createElement('div');
        notification.className = 'alert alert-success position-fixed top-0 start-50 translate-middle-x mt-3';
        notification.style.zIndex = '9999';
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }
    
    // Инициализация при загрузке страницы
    updateCartCount();
    
    // Обновление корзины при открытии модального окна
    document.getElementById('cartModal').addEventListener('show.bs.modal', function() {
        updateCartDisplay();
    });
});