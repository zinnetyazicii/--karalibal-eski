$('script[type="text/javascript/defer"]').each(function () {
	$(this).after($('<script type="text/javascript"/>').text($(this).clone().text())).remove()
});
