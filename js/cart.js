/* Корзина (заявка) и оформление: товары хранятся в localStorage, заявка отправляется на сервер. */
document.addEventListener('DOMContentLoaded', function () {
	const STORAGE_KEY = 'cart';
	const modalEl = document.getElementById('cartModal');
	if (!modalEl) return;

	function load() {
		try { return JSON.parse(localStorage.getItem(STORAGE_KEY)) || []; } catch (e) { return []; }
	}
	function save() {
		try { localStorage.setItem(STORAGE_KEY, JSON.stringify(cart)); } catch (e) { /* приватный режим */ }
	}
	let cart = load();

	const esc = (s) => String(s == null ? '' : s).replace(/[&<>"']/g, (c) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));

	const $ = (sel) => modalEl.querySelector(sel);
	const cartContent = document.getElementById('cart-content');
	const cartTotalDiv = $('.cart-total');
	const checkoutBtn = document.getElementById('checkout-btn');
	const form = document.getElementById('rk-checkout-form');
	const btnBack = $('[data-role="back"]');
	const btnSubmit = $('[data-role="submit"]');
	const btnClose = $('[data-role="close"]');
	const formError = $('[data-form-error]');

	function updateCartCount() {
		const count = cart.reduce((total, item) => total + (item.quantity || 0), 0);
		document.querySelectorAll('#cart-count').forEach((el) => { el.textContent = count; });
	}

	function setStep(step) {
		modalEl.querySelectorAll('[data-pane]').forEach((p) => { p.hidden = p.dataset.pane !== step; });
		modalEl.querySelectorAll('.rk-step').forEach((s) => s.classList.toggle('is-active', s.dataset.step === step));
		const hasItems = cart.length > 0;
		checkoutBtn.classList.toggle('d-none', !(step === 'cart' && hasItems));
		cartTotalDiv.classList.toggle('d-none', !(step === 'cart' && hasItems));
		btnBack.hidden = step !== 'form';
		btnSubmit.hidden = step !== 'form';
		btnClose.textContent = step === 'done' ? 'Закрыть' : 'Продолжить выбор';
		btnClose.hidden = step === 'form';
		if (step === 'form') setTimeout(() => form.elements.name.focus(), 50);
	}

	function renderCart() {
		if (cart.length === 0) {
			cartContent.innerHTML = '<div class="cart-empty"><i class="bi bi-bag-x"></i><p>В заявке пока нет товаров</p></div>';
		} else {
			cartContent.innerHTML = cart.map((item, index) => `
				<div class="cart-item">
					${item.image ? `<img src="${esc(item.image)}" alt="">` : '<span class="cart-item-noimg"></span>'}
					<div class="cart-item-details">
						<div class="cart-item-title">${esc(item.title)}</div>
						<div class="cart-item-price">Цена по запросу</div>
					</div>
					<div class="cart-item-quantity" role="group" aria-label="Количество">
						<button type="button" class="quantity-btn" data-qty="-1" data-index="${index}" aria-label="Меньше">−</button>
						<span>${Number(item.quantity) || 1}</span>
						<button type="button" class="quantity-btn" data-qty="1" data-index="${index}" aria-label="Больше">+</button>
					</div>
					<button type="button" class="cart-item-remove" data-remove="${index}" aria-label="Удалить"><i class="bi bi-x-lg"></i></button>
				</div>`).join('');
		}
		updateCartCount();
	}

	cartContent.addEventListener('click', (e) => {
		const q = e.target.closest('[data-qty]');
		const r = e.target.closest('[data-remove]');
		if (q) window.updateQuantity(Number(q.dataset.index), Number(q.dataset.qty));
		if (r) window.removeFromCart(Number(r.dataset.remove));
	});

	window.addToCart = function (postId, title, price, image) {
		const existing = cart.find((item) => item.postId === postId);
		if (existing) {
			existing.quantity = Math.min(99, existing.quantity + 1);
		} else {
			cart.push({ postId: postId, title: title, price: price, image: image, quantity: 1 });
		}
		save();
		updateCartCount();
		showToast('Товар добавлен в заявку');
	};

	window.updateQuantity = function (index, change) {
		if (!cart[index]) return;
		cart[index].quantity = Math.min(99, cart[index].quantity + change);
		if (cart[index].quantity <= 0) cart.splice(index, 1);
		save();
		renderCart();
		setStep('cart');
	};

	window.removeFromCart = function (index) {
		cart.splice(index, 1);
		save();
		renderCart();
		setStep('cart');
	};

	function showToast(message) {
		const toast = document.createElement('div');
		toast.className = 'rk-toast';
		toast.setAttribute('role', 'status');
		toast.innerHTML = '<i class="bi bi-check2-circle"></i> ' + esc(message) +
			' <button type="button" class="rk-toast__link">Открыть</button>';
		toast.querySelector('button').addEventListener('click', () => {
			window.bootstrap && window.bootstrap.Modal.getOrCreateInstance(modalEl).show();
			toast.remove();
		});
		document.body.appendChild(toast);
		requestAnimationFrame(() => toast.classList.add('is-visible'));
		setTimeout(() => { toast.classList.remove('is-visible'); setTimeout(() => toast.remove(), 300); }, 3200);
	}

	function clearErrors() {
		form.querySelectorAll('.is-invalid').forEach((el) => el.classList.remove('is-invalid'));
		formError.hidden = true;
	}
	function showFieldError(name, message) {
		const input = form.elements[name];
		const box = form.querySelector(`[data-error="${name}"]`);
		if (input) input.classList.add('is-invalid');
		if (box) box.textContent = message;
	}
	function validate() {
		clearErrors();
		let ok = true;
		const name = form.elements.name.value.trim();
		const phone = form.elements.phone.value.replace(/\D/g, '');
		const email = form.elements.email.value.trim();
		if (name.length < 2) { showFieldError('name', 'Укажите имя.'); ok = false; }
		if (phone.length < 10 || phone.length > 15) { showFieldError('phone', 'Укажите телефон в формате +7 700 000 00 00.'); ok = false; }
		if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { showFieldError('email', 'Укажите корректный email.'); ok = false; }
		if (!ok) { const first = form.querySelector('.is-invalid'); first && first.focus(); }
		return ok;
	}

	checkoutBtn.addEventListener('click', () => setStep('form'));
	btnBack.addEventListener('click', () => setStep('cart'));

	form.addEventListener('submit', (e) => {
		e.preventDefault();
		if (!validate() || !window.rkCheckout) return;
		const body = new URLSearchParams({
			action: 'rk_checkout',
			nonce: window.rkCheckout.nonce,
			name: form.elements.name.value.trim(),
			phone: form.elements.phone.value.trim(),
			email: form.elements.email.value.trim(),
			comment: form.elements.comment.value.trim(),
			website: form.elements.website.value,
			items: JSON.stringify(cart.map((i) => ({ id: i.postId, qty: i.quantity })))
		});
		btnSubmit.disabled = true;
		btnSubmit.textContent = 'Отправляем…';
		fetch(window.rkCheckout.ajaxUrl, { method: 'POST', credentials: 'same-origin', body: body })
			.then((r) => r.json().catch(() => ({ success: false, data: { message: 'Ошибка сервера.' } })))
			.then((res) => {
				if (res.success) {
					modalEl.querySelector('[data-order-number]').textContent = res.data.order ? '№' + res.data.order : '—';
					cart = [];
					save();
					renderCart();
					form.reset();
					setStep('done');
				} else {
					const d = res.data || {};
					Object.entries(d.fields || {}).forEach(([k, v]) => showFieldError(k, v));
					formError.textContent = d.message || 'Не удалось отправить заявку.';
					formError.hidden = false;
				}
			})
			.catch(() => {
				formError.textContent = 'Нет связи с сервером. Проверьте интернет и попробуйте ещё раз.';
				formError.hidden = false;
			})
			.finally(() => {
				btnSubmit.disabled = false;
				btnSubmit.textContent = 'Отправить заявку';
			});
	});

	modalEl.addEventListener('show.bs.modal', () => {
		cart = load();
		renderCart();
		clearErrors();
		setStep('cart');
	});

	window.addEventListener('storage', (e) => { if (e.key === STORAGE_KEY) { cart = load(); updateCartCount(); } });
	updateCartCount();
});
