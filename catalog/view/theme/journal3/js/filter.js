function journal_filter_url() {
	var f = {};

	$('input[data-filter-trigger]:checked, select[data-filter-trigger]').each(function () {
		var $this = $(this);

		var name = 'f' + $this.attr('name');
		var value = $this.val().trim();

		f[name] = f[name] || [];
		f[name].push(value);
	});

	if ($('.filter-price').length) {
		var min = $('.filter-price-min').data('min');
		var max = $('.filter-price-max').data('max');
		var from = parseInt($('.filter-price-min').val(), 10);
		var to = parseInt($('.filter-price-max').val(), 10);

		if (((from !== '') && (from !== min)) || ((to !== '') && (to !== max))) {
			f['fmin'] = [from];
			f['fmax'] = [to];
		}
	}

	var url = [];

	$.each(f, function (k, v) {
		url.push(k + '=' + v.join(Journal['filterUrlValuesSeparator'] || ','));
	});

	url = url.join('&');

	if (!url) {
		return Journal['filterBase'];
	}

	if (Journal['filterBase'].indexOf('?') === -1) {
		return Journal['filterBase'] + '?' + url;
	}

	return Journal['filterBase'] + '&' + url;
}

function journal_filter_price_slider() {
	$('.filter-price .range-slider input').ionRangeSlider({
		type: 'double',
		min: $('.filter-price-min').data('min'),
		max: $('.filter-price-max').data('max'),
		from: $('.filter-price-min').val(),
		to: $('.filter-price-max').val(),
		onFinish: function (data) {
			$('.filter-price-min').val(data.from);
			$('.filter-price-max').val(data.to).trigger('blur');
		},
		prettify: function (value) {
			if (Journal['currency_left']) {
				return accounting.formatMoney(value, Journal['currency_left'], 0, Journal['currency_thousand'], Journal['currency_decimal'], '%s%v');
			}

			return accounting.formatMoney(value, Journal['currency_right'], 0, Journal['currency_thousand'], Journal['currency_decimal'], '%v%s');
		}
	});
}

function journal_filter(url, opts) {
	opts = opts || {};

	var source = opts.source;
	var updateHistory = opts.updateHistory;

	try {
		var u = new URL(url);

		u.host = window.location.host;
		u.hostname = window.location.hostname;
		u.protocol = window.location.protocol;

		url = u.toString();
	} catch (e) {
	}

	if (updateHistory !== false && window.history && window.history.pushState) {
		var state = { Title: document.title, Url: url };

		window.history.pushState(state, state.Title, state.Url);
	}

	if (Journal.infiniteScrollInstance) {
		Journal.infiniteScrollInstance.destroy();
	}

	$.ajax({
		url: url,
		dataType: 'html',
		beforeSend: function () {
			var $slider = $('.filter-price .range-slider input');

			if ($slider.length && $slider.data('ionRangeSlider')) {
				$slider.data('ionRangeSlider').destroy();
			}

			$('[data-toggle="tooltip"]').tooltip('hide');

			loader('.container > .row', true);
		},
		complete: function () {
			loader('.container > .row', false);

			if (Journal['filterScrollTop'] || (source === 'pagination')) {
				$('html, body').animate({ scrollTop: 0 }, 700);
			}
		},
		success: function (response) {
			var $response = $(response);

			Journal['filterCollapsed'] = {};

			$('.module-filter .module-item .panel-heading a').each(function () {
				var $this = $(this);
				Journal['filterCollapsed'][$this.data('filter')] = $this.hasClass('collapsed');
			});

			$('.module-filter').replaceWith($response.find('.module-filter'));
			$('.main-products-wrapper').replaceWith($response.find('.main-products-wrapper'));
			$('#input-sort, #input-limit').removeAttr('onchange');

			var $panel_group = $('.panel-group');

			$panel_group.on('show.bs.collapse', function (e) {
				$(e.target).parent().addClass('panel-active');
				$(e.target).parent().removeClass('panel-collapsed');
			});

			$panel_group.on('hide.bs.collapse', function (e) {
				$(e.target).parent().removeClass('panel-active');
				$(e.target).parent().addClass('panel-collapsing');
			});

			$panel_group.on('hidden.bs.collapse', function (e) {
				$(e.target).parent().removeClass('panel-collapsing');
				$(e.target).parent().addClass('panel-collapsed');
			});

			Object.keys(Journal['filterCollapsed']).forEach(function (key) {
				var $collapse = $($('.module-filter .module-item .panel-heading a[data-filter="' + key + '"]').attr('href'));

				if (Journal['filterCollapsed'][key] === true) {
					$collapse.collapse('hide');
				}

				if (Journal['filterCollapsed'][key] === false) {
					$collapse.collapse('show');
				}
			});

			Journal.lazyLoadInstance && Journal.lazyLoadInstance.update();

			journal_filter_price_slider();
			journal_enable_stepper();
			journal_enable_countdown();

			if (Journal.infiniteScrollInstance) {
				$('.ias-trigger').remove();
				setTimeout(function () {
					Journal.infiniteScrollInstance.reinitialize();
				}, 100);
			}
		}
	});
}

jQuery(function ($) {
	// price slider
	journal_filter_price_slider();

	// handle price change
	var old;

	$(document).delegate('.filter-price-min, .filter-price-max', 'focus', function (e) {
		old = e.target.value;
	});

	$(document).delegate('.filter-price-min, .filter-price-max', 'blur keydown', function (e) {
		if ((e.type === 'keydown' && e.keyCode === 13) || (e.type === 'focusout')) {
			var value = e.target.value.trim();

			if ($.isNumeric(value) && (old !== value)) {
				journal_filter(journal_filter_url());

				return false;
			}
		}
	});

	// handle filters changes
	$(document).delegate('[data-filter-trigger]', 'change', function () {
		journal_filter(journal_filter_url());

		return false;
	});

	// handle pagination changes
	$(document).delegate('.pagination a', 'click', function () {
		journal_filter($(this).attr('href'), { source: 'pagination' });

		return false;
	});

	// handle sort and limit changes
	$('#input-sort, #input-limit').removeAttr('onchange');

	$(document).delegate('#input-sort, #input-limit', 'change', function () {
		journal_filter($(this).val());

		return false;
	});

	// handle back button
	$(window).on('popstate', function (e) {
		// journal_filter(window.location.href, { updateHistory: false });
		window.location.reload();
	});

	// handle reset button
	$(document).delegate('.reset-filter', 'click', function () {
		journal_filter(Journal['filterBase']);
	});
});
