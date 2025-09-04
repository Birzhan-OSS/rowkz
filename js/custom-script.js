jQuery(document).ready(function ($) {
	// Show the first section by default
	$('#section-1').css('display', 'block');

	$('.step').on('click', function () {
		// Remove active class from all steps
		$('.step').removeClass('active');
		// Add active class to the clicked step
		$(this).addClass('active');

		// Get the step number
		var step = $(this).data('step');
		// Hide all sections
		$('.section').css('display', 'none');
		// Show the corresponding section
		$('#section-' + step).css('display', 'block');
	});
});

const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

$(function () {
	// Owl Carousel
	var owl = $(".owl-carousel");
	owl.owlCarousel({
		items: 3,
		margin: 10,
		loop: true,
		nav: true,
        dots: true
	});
});

$('.owl-carousel').owlCarousel({
	loop: true,
	margin: 10,
	nav: false,
	responsive: {
		0: {
			items: 1
		},
		600: {
			items: 3
		},
		1000: {
			items: 3
		}
	}
})





