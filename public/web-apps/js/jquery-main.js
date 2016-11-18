jQuery(window).load(function(){
	$('body').removeClass('loading-page');
});

$(document).ready(function() {
	$(".js-example-basic-single").select2();
	$("#select-user").select2({
		placeholder: "Please Select User"
	});
	if (screen.width < 1024){
		$('body').removeClass('sideBar-active');
		$(document).on('click', '.sideBar-links li', function(){
			$('body').removeClass('sideBar-active');
		});
	}
	if($('.listing-pro').find('.t-d').length == 0){
		$('.propertyNotFound').removeClass('hidden');
		$('.pager').remove();
	}
	$('.moreDetail-slide').slideUp();
});
// page init
jQuery(function(){
	initLightbox();
	initCarousel();
});
function initCarousel() {
	jQuery('.listing-imageSlider').scrollGallery({
		mask: '.mask',
		slider: '.slideset',
		slides: '.slide',
		btnPrev: '.btn-prev',
		btnNext: '.btn-next',
		autoRotation: false,
		circularRotation: true,
		switchTime: 3000,
		animSpeed: 500,
		swipeGap: true
	});
}

$(document).on('change keyup', 'input, textarea, select', function(){
	$(this).closest('.input-holder').removeClass('error');
});

$(document).on('click', 'a.lightbox', function(){
	$('#wrapper').addClass('fancy-overlay');
});

$(document).mouseup(function (e)
{
	var container = $(".fancybox-opened");

	if (!container.is(e.target)
		&& container.has(e.target).length === 0)
	{
		$('#wrapper').removeClass('fancy-overlay');
	}
});

$(document).on('click', '.generic-lightbox>.close, .fancybox-close', function(){
	$('#wrapper').removeClass('fancy-overlay');
});

$(document).keyup(function(e) {
	if (e.keyCode === 27){
		$('.fancybox-overlay-fixed').hide();
		$('#wrapper').removeClass('fancy-overlay');
	}   // esc
});


$(document).on('click', '.filters-links-opener', function(){
	$(this).closest('li').toggleClass('active');

	if($(this).closest('li').hasClass('active')){
		$(this).closest('li').find('.slide').slideDown();
	}
	else {
		$(this).closest('li').find('.slide').slideUp();
	}
});

$(document).on('focusin', '.PriceField', function(){
	$('.calculatedPrice').removeClass('priceShow');
	$('.calculatedPrice').addClass('priceShow');
});

$(document).on('focusout', '.PriceField', function(){
	$('.calculatedPrice').removeClass('priceShow');
});

$(document).on('click', '.sideBar-opener', function(){
	$('body').toggleClass('sideBar-active');
});

$(document).on('click', '.property-status-links-opener', function(){
	$(this).toggleClass('active');
	$('.property-status-links').slideToggle();
});
$(document).on('click', '.property-status-links>li>a', function(){
	if (screen.width < 1024){
		$('.property-status-links-opener>.text-container').text($(this).text());
		$('.property-status-links').slideUp();
		$('.property-status-links-opener').removeClass('active');
	}
});
$(document).on('click', '.searchOpener-Mobile', function(){
	$('.searchByID').slideToggle();
});
$(document).on('click', '.moreDetail-slideOpener', function(){
	$(this).closest('.t-d').find('.moreDetail-slide').slideToggle();
	$(this).text(function(i, text){
		return text === "View more" ? "View Less" : "View more";
	})
});

$(document).on('click', '.propertyDocumentCloseBtn', function(){
	$(this).closest('li').find('.picture-name').val('');
	$(this).closest('li').find('img').attr('src', '#');
	$(this).closest('li').removeClass('image-loaded');
});

function previewAddPropertyImg(file, target)
{
	previewFile(file, target);
	$(file).closest('li').addClass('image-loaded');
	$(file).closest('li').find('.picture-name').focus();
}


function previewFile(file, target) {
	var preview = document.querySelector(target);
	var file    = file.files[0];
	var reader  = new FileReader();

	reader.onloadend = function () {
		preview.src = reader.result;
	}

	if (file) {
		reader.readAsDataURL(file);
	} else {
		preview.src = "";
	}
}