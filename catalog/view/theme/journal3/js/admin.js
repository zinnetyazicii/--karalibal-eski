$(window).on('load', function () {
	// Grid dimensions
	$('.grid-col').mouseover(function () {
		var $this = $(this);

		if (!$this.attr('data-dimensions')) {
			$this.attr('data-dimensions', $this.width() + ' x ' + $this.height() + ' (Admin Only)');
		}
	});

	// Mail test
	$('.route-journal3-mail .btn-primary').on('click', function (e) {
		e.preventDefault();

		var $this = $(this);

		$.ajax({
			url: 'index.php?route=journal3/mail/test',
			type: 'post',
			dataType: 'json',
			data: $this.closest('form').serialize(),
			beforeSend: function () {
				$this.button('loading');
			},
			complete: function () {
				$this.button('reset');
			},
			success: function (json) {
				alert(JSON.stringify(json, null, 2));
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(thrownError + '\r\n' + xhr.statusText + '\r\n' + xhr.responseText);
			}
		})
	});
});
