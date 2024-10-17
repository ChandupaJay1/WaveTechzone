(function ($) {
	
	"use strict";

	// Page loading animation
	$(window).on('load', function() {

        $('#js-preloader').addClass('loaded');

    });


	$(window).scroll(function() {
	  var scroll = $(window).scrollTop();
	  var box = $('.header-text').height();
	  var header = $('header').height();

	  if (scroll >= box - header) {
	    $("header").addClass("background-header");
	  } else {
	    $("header").removeClass("background-header");
	  }
	})

	var width = $(window).width();
		$(window).resize(function() {
		if (width > 767 && $(window).width() < 767) {
			location.reload();
		}
		else if (width < 767 && $(window).width() > 767) {
			location.reload();
		}
	})

	const elem = document.querySelector('.trending-box');
	const filtersElem = document.querySelector('.trending-filter');
	if (elem) {
		const rdn_events_list = new Isotope(elem, {
			itemSelector: '.trending-items',
			layoutMode: 'masonry'
		});
		if (filtersElem) {
			filtersElem.addEventListener('click', function(event) {
				if (!matchesSelector(event.target, 'a')) {
					return;
				}
				const filterValue = event.target.getAttribute('data-filter');
				rdn_events_list.arrange({
					filter: filterValue
				});
				filtersElem.querySelector('.is_active').classList.remove('is_active');
				event.target.classList.add('is_active');
				event.preventDefault();
			});
		}
	}


	// Menu Dropdown Toggle
	if($('.menu-trigger').length){
		$(".menu-trigger").on('click', function() {	
			$(this).toggleClass('active');
			$('.header-area .nav').slideToggle(200);
		});
	}


	// Menu elevator animation
	$('.scroll-to-section a[href*=\\#]:not([href=\\#])').on('click', function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				var width = $(window).width();
				if(width < 991) {
					$('.menu-trigger').removeClass('active');
					$('.header-area .nav').slideUp(200);	
				}				
				$('html,body').animate({
					scrollTop: (target.offset().top) - 80
				}, 700);
				return false;
			}
		}
	});


	// Page loading animation
	$(window).on('load', function() {
		if($('.cover').length){
			$('.cover').parallax({
				imageSrc: $('.cover').data('image'),
				zIndex: '1'
			});
		}

		$("#preloader").animate({
			'opacity': '0'
		}, 600, function(){
			setTimeout(function(){
				$("#preloader").css("visibility", "hidden").fadeOut();
			}, 300);
		});
	});
    


})(window.jQuery);







function includeComponents() {
	var elements = document.querySelectorAll("[w3-include-html]");
  
	elements.forEach(function (elmnt) {
	  var file = elmnt.getAttribute("w3-include-html");
	  if (file) {
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function () {
		  if (this.readyState == 4) {
			if (this.status == 200) {
			  elmnt.innerHTML = this.responseText;
			}
			if (this.status == 404) {
			  elmnt.innerHTML = "Page not found.";
			}
			elmnt.removeAttribute("w3-include-html");
		  }
		};
		xhttp.open("GET", file, true);
		xhttp.send();
	  }
	});
  }
  
  // Call the function when the page loads
  document.addEventListener("DOMContentLoaded", includeComponents);
  
  
  function includeHeader() {
	var elements = document.querySelectorAll("[w3-include-html]");
	elements.forEach(function (elmnt) {
		var file = elmnt.getAttribute("w3-include-html");
		if (file) {
			// First attempt with XMLHttpRequest
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function () {
				if (this.readyState == 4) {
					if (this.status == 200) {
						elmnt.innerHTML = this.responseText;
					} else if (this.status == 404) {
						elmnt.innerHTML = "Page not found.";
					} else {
						loadContentFallback(file, elmnt);
					}
					elmnt.removeAttribute("w3-include-html");
				}
			};
			xhttp.open("GET", file, true);
			try {
				xhttp.send();
			} catch (err) {
				loadContentFallback(file, elmnt);
			}
		}
	});
  }
  
  function loadContentFallback(file, element) {
	fetch(file)
		.then(response => response.text())
		.then(data => {
			element.innerHTML = data;
		})
		.catch(error => {
			console.error("Error loading file:", error);
			element.innerHTML = "Content could not be loaded.";
		});
  }

  
  $(document).ready(function() {
    // When a filter link is clicked
    $('.trending-filter a').on('click', function(e) {
        e.preventDefault(); // Prevent the default link behavior
        var filterValue = $(this).data('filter'); // Get the filter value

        // Show all items if "Show All" is clicked
        if (filterValue === '*') {
            $('.trending-items').show(); // Show all items
        } else {
            // Hide all items first
            $('.trending-items').hide();
            // Show only the filtered items
            $(filterValue).show();
        }

        // Remove active class from all links and add to the clicked link
        $('.trending-filter a').removeClass('is_active');
        $(this).addClass('is_active');
    });
});