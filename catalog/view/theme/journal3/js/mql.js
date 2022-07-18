// forEach polyfill
if (window.NodeList && !NodeList.prototype.forEach) {
	NodeList.prototype.forEach = Array.prototype.forEach;
}

(function () {
	if (Journal['isPhone']) {
		return;
	}

	var wrappers = ['search', 'cart', 'cart-content', 'logo', 'language', 'currency'];
	var documentClassList = document.documentElement.classList;

	function extractClassList() {
		return ['desktop', 'tablet', 'phone', 'desktop-header-active', 'mobile-header-active', 'mobile-menu-active'].filter(function (cls) {
			return documentClassList.contains(cls);
		});
	}

	function mqr(mqls, listener) {
		Object.keys(mqls).forEach(function (k) {
			mqls[k].addListener(listener);
		});

		listener();
	}

	function mobileMenu() {
		console.warn('mobile menu!');

		var element = document.querySelector('#main-menu');
		var wrapper = document.querySelector('.mobile-main-menu-wrapper');

		if (element && wrapper) {
			wrapper.appendChild(element);
		}

		var main_menu = document.querySelector('.main-menu');

		if (main_menu) {
			main_menu.classList.add('accordion-menu');
		}

		document.querySelectorAll('.main-menu .dropdown-toggle').forEach(function (element) {
			element.classList.remove('dropdown-toggle');
			element.classList.add('collapse-toggle');
			element.removeAttribute('data-toggle');
		});

		document.querySelectorAll('.main-menu .dropdown-menu').forEach(function (element) {
			element.classList.remove('dropdown-menu');
			element.classList.remove('j-dropdown');
			element.classList.add('collapse');
		});
	}

	function desktopMenu() {
		console.warn('desktop menu!');

		var element = document.querySelector('#main-menu');
		var wrapper = document.querySelector('.desktop-main-menu-wrapper');

		if (element && wrapper) {
			wrapper.insertBefore(element, document.querySelector('#main-menu-2'));
		}

		var main_menu = document.querySelector('.main-menu');

		if (main_menu) {
			main_menu.classList.remove('accordion-menu');
		}

		document.querySelectorAll('.main-menu .collapse-toggle').forEach(function (element) {
			element.classList.add('dropdown-toggle');
			element.classList.remove('collapse-toggle');
			element.setAttribute('data-toggle', 'dropdown');
		});

		document.querySelectorAll('.main-menu .collapse').forEach(function (element) {
			element.classList.add('dropdown-menu');
			element.classList.add('j-dropdown');
			element.classList.remove('collapse');
		});

		document.body.classList.remove('mobile-wrapper-open');
	}

	function mobileHeader() {
		console.warn('mobile header!');

		Object.keys(wrappers).forEach(function (k) {
			var element = document.querySelector('#' + wrappers[k]);
			var wrapper = document.querySelector('.mobile-' + wrappers[k] + '-wrapper');

			if (element && wrapper) {
				wrapper.appendChild(element);
			}

			if (wrappers[k] === 'cart-content') {
				if (element) {
					element.classList.remove('j-dropdown');
					element.classList.remove('dropdown-menu');
				}
			}
		});

		var search = document.querySelector('#search');
		var cart = document.querySelector('#cart');

		if (search && (Journal['searchStyle'] === 'full')) {
			search.classList.remove('full-search');
			search.classList.add('mini-search');
		}

		if (cart && (Journal['cartStyle'] === 'full')) {
			cart.classList.remove('full-cart');
			cart.classList.add('mini-cart')
		}
	}

	function desktopHeader() {
		console.warn('desktop header!');

		Object.keys(wrappers).forEach(function (k) {
			var element = document.querySelector('#' + wrappers[k]);
			var wrapper = document.querySelector('.desktop-' + wrappers[k] + '-wrapper');

			if (wrappers[k] === 'cart-content') {
				if (element) {
					element.classList.add('j-dropdown');
					element.classList.add('dropdown-menu');
					document.querySelector('#cart').appendChild(element);
				}
			} else {
				if (element && wrapper) {
					wrapper.appendChild(element);
				}
			}
		});

		var search = document.querySelector('#search');
		var cart = document.querySelector('#cart');

		if (search && (Journal['searchStyle'] === 'full')) {
			search.classList.remove('mini-search');
			search.classList.add('full-search');
		}

		if (cart && (Journal['cartStyle'] === 'full')) {
			cart.classList.remove('mini-cart');
			cart.classList.add('full-cart');
		}

		documentClassList.remove('mobile-cart-content-container-open');
		documentClassList.remove('mobile-main-menu-container-open');
		documentClassList.remove('mobile-overlay');
	}

	function moveElements(classList) {
		if (classList.includes('mobile-header-active')) {
			mobileHeader();
			mobileMenu();
		} else if (classList.includes('mobile-menu-active')) {
			desktopHeader();
			mobileMenu();
		} else {
			desktopHeader();
			desktopMenu();
		}
	}

	var mqls = {
		phone: window.matchMedia('(max-width: 768px)'),
		tablet: window.matchMedia('(max-width: 1024px)'),
		menu: window.matchMedia('(max-width: ' + Journal['mobileMenuOn'] + 'px)')
	};

	mqr(mqls, function () {
		var oldClassList = extractClassList();

		if (Journal['isDesktop']) {
			if (mqls.phone.matches) {
				documentClassList.remove('desktop');
				documentClassList.remove('tablet');
				documentClassList.add('mobile');
				documentClassList.add('phone');
			} else if (mqls.tablet.matches) {
				documentClassList.remove('desktop');
				documentClassList.remove('phone');
				documentClassList.add('mobile');
				documentClassList.add('tablet');
			} else {
				documentClassList.remove('mobile');
				documentClassList.remove('phone');
				documentClassList.remove('tablet');
				documentClassList.add('desktop');
			}

			if (documentClassList.contains('phone') || (documentClassList.contains('tablet') && Journal['mobileHeaderOn'] === 'tablet')) {
				documentClassList.remove('desktop-header-active');
				documentClassList.add('mobile-header-active');
			} else {
				documentClassList.remove('mobile-header-active');
				documentClassList.add('desktop-header-active');
			}
		}

		if (documentClassList.contains('desktop-header-active') && mqls.menu.matches) {
			documentClassList.add('mobile-menu-active');
		} else {
			documentClassList.remove('mobile-menu-active');
		}

		var newClassList = extractClassList();

		if (oldClassList.join(' ') !== newClassList.join(' ')) {
			if (documentClassList.contains('safari') && !documentClassList.contains('ipad') && navigator.maxTouchPoints && navigator.maxTouchPoints > 2) {
				window.fetch('index.php?route=journal3/journal3/device_detect', {
					method: 'POST',
					body: 'device=ipad',
					headers: {
						'Content-Type': 'application/x-www-form-urlencoded'
					}
				}).then(function (data) {
					return data.json();
				}).then(function (data) {
					if (data.response.reload) {
						window.location.reload();
					}
				});
			}

			if (document.readyState === 'loading') {
				document.addEventListener('DOMContentLoaded', function () {
					moveElements(newClassList);
				});
			} else {
				moveElements(newClassList);
			}
		}
	});

})();

(function () {
	var cookies = {};
	var style = document.createElement('style');
	var documentClassList = document.documentElement.classList;

	document.head.appendChild(style);

	document.cookie.split('; ').forEach(function (c) {
		var cc = c.split('=');
		cookies[cc[0]] = cc[1];
	});

	if (Journal['popup']) {
		for (var i in Journal['popup']) {
			if (!cookies['p-' + Journal['popup'][i]['c']]) {
				documentClassList.add('popup-open');
				documentClassList.add('popup-center');
				break;
			}
		}
	}

	if (Journal['notification']) {
		for (var i in Journal['notification']) {
			if (cookies['n-' + Journal['notification'][i]['c']]) {
				style.sheet.insertRule('.module-notification-' + Journal['notification'][i]['m'] + '{ display:none }');
			}
		}
	}

	if (Journal['headerNotice']) {
		for (var i in Journal['headerNotice']) {
			if (cookies['hn-' + Journal['headerNotice'][i]['c']]) {
				style.sheet.insertRule('.module-header_notice-' + Journal['headerNotice'][i]['m'] + '{ display:none }');
			}
		}
	}

	if (Journal['layoutNotice']) {
		for (var i in Journal['layoutNotice']) {
			if (cookies['ln-' + Journal['layoutNotice'][i]['c']]) {
				style.sheet.insertRule('.module-layout_notice-' + Journal['layoutNotice'][i]['m'] + '{ display:none }');
			}
		}
	}
})();
