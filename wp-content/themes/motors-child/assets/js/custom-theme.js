jQuery(document).ready(function () {
	ajaxcallfunction();

	var dropdown = document.getElementsByClassName("dropdown-btn");
	var i;

	for (i = 0; i < dropdown.length; i++) {

		jQuery(dropdown[i]).on('click', function (e) {
			e.preventDefault();




			if (jQuery(this).next().css('display') == "block") {
				jQuery(this).removeClass('active');
				jQuery(this).next().slideUp();
			}
			else {
				jQuery(this).addClass('active');
				jQuery(this).next().slideDown();
			}

		});
	}

});

function ajaxcallfunction() {

	jQuery('body').on('click', '.car-img', function () {

		$(this).closest('.list-leftcontent').find('.image-inner img').attr('src', $(this).attr('src'));
	});

	jQuery('.stm_phrases .button').on('click', function (e) {
		e.preventDefault();
		var $string = [];

		jQuery('.stm_phrases input[type="checkbox"]').each(function () {
			if (jQuery(this).attr('checked')) {
				$string.push(jQuery(this).val());
			}
		});

		$string = $string.join(',');

		var $textArea = jQuery(".stm-phrases-unit input[type='text']");

		var $textAreahiddne = jQuery(".stm-phrases-unit input[type='hidden']");
		var $textAreaCurrentVal = $textArea.val();
		$textAreaCurrentVal = $string;
		$textAreahiddne.val($textAreaCurrentVal);
		$textArea.val($textAreaCurrentVal);

		jQuery('.stm_phrases').toggleClass('activated');
	});


	var owl;
	owl = jQuery('.car-slider').owlCarousel({
		loop: true,
		autoplay: true,
		margin: 10,
		nav: true,
		navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
		dots: false,
		responsive: {
			0: {
				items: 2
			},
			600: {
				items: 3
			},
			1000: {
				items: 5
			}
		}
	});

	$(function () {
		var Accordion = function (el, multiple) {
			this.el = el || {};
			this.multiple = multiple || false;

			var links = this.el.find('.article-title');
			links.on('click', {
				el: this.el,
				multiple: this.multiple		
			}, this.dropdown)
		}

		Accordion.prototype.dropdown = function (e) {
			var $el = e.data.el;
			$this = $(this),
				$next = $this.next();

			$next.slideToggle();
			$this.parent().toggleClass('open');

			if (!e.data.multiple) {
				$el.find('.accordion-content').not($next).slideUp().parent().removeClass('open');
			};
		}
		var accordion = new Accordion($('.accordion-container'), false);
	});

	// var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
	// var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
	// 	return new bootstrap.Tooltip(tooltipTriggerEl)
	// });

		
	


	// // set main image src on slide of slider
	// // owl.on('changed.owl.carousel', function(event) {
	// // console.log("test");
	// // var current = event.item.index;
	// // var src = jQuery(event.target).find(".owl-item").eq(current).find(".car-img").attr('data-src');
	// // console.log('Image current is ' + src);
	// // ////jQuery(event.currentTarget).find(".owl-item").find(".car-img").attr("data-src");

	// // var parent_image = jQuery(event.target).parent().parent().find(".image .image-inner img");
	// // parent_image.attr("data-original", src);

	// // var srcset_image = src + "1x," + src + "2x";
	// // parent_image.attr("srcset", srcset_image);

	// // //parent_image.addClass("testttt");
	// // //var parent_image = jQuery(event.target).parent().parent().find(".image .image-inner img").attr("data-original");

	// // });

	// owl.on('click', '.owl-item', function(event) {
	// var target = jQuery(this).index();
	// alert("indexxx: "+target);
	// //owl.owlCarousel('current',target);
	// });

	// jQuery('.car-slider .link').on('click', function(event){
	// alert("tet");
	// var $this = jQuery(this);
	// var target = jQuery(this).index();
	// alert($this+"index: "+target);
	// //var current_src = $this.attr('data-src');
	// if($this.hasClass('clicked')){
	// $this.removeClass('clicked');
	// } else{
	// $this.addClass('clicked');			
	// }
	// });

	// jQuery('.owl-item').click(function(){
	// alert("testtttt");
	// });

	// jQuery(document).on('click', 'body .owl-item', function(){
	// var index = jQuery(this).index();
	// console.log(index);
	// alert("testtttt: "+index);
	// //$('.owl-wrapper').trigger('owl.goTo', n);
	// });



	// var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'))
	// var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
	// 	return new bootstrap.Tooltip(tooltipTriggerEl)
	// })

}