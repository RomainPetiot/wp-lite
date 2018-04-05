function hasClass(el, className) {
  if (el.classList)
    return el.classList.contains(className)
  else
    return !el.className.match(new RegExp('(\\s|^)' + className + '(\\s|$)'))
}

function addClass(el, className) {
  if (el.classList)
    el.classList.add(className)
  else if (!hasClass(el, className)) el.className += " " + className
}

function removeClass(el, className) {
  if (el.classList)
    el.classList.remove(className)
  else if (hasClass(el, className)) {
    var reg = new RegExp('(\\s|^)' + className + '(\\s|$)')
    el.className=el.className.replace(reg, ' ')
  }
}


/********MODAL*******/

function openModal(el, text, title){
	var text = (typeof text !== 'undefined') ? text : "";
	var title = (typeof title !== 'undefined') ? title : "";
	if(text.length){
		el.children[1].innerHTML = text;
	}
	if(title.length){
		document.getElementById('modal-title').innerHTML = title;
	}
	addClass(el, 'openModal');
	overlay = document.getElementById("modalOverlay");
	addClass(overlay, 'overlayOpen');
}
function closeModal(){
	el = document.getElementsByClassName('modal');
	for(var i = 0; i < el.length; i++){
		removeClass(el[i], 'openModal');
	}
	overlay = document.getElementById("modalOverlay");
	removeClass(overlay, 'overlayOpen');
	el = document.getElementById("menuMobile");
	removeClass(el, 'menuMobileOpen');
}

document.getElementById("burger-menu").addEventListener("click", function(){menuMobile();});
function menuMobile() {
	el = document.getElementById("menuMobile");
	overlay = document.getElementById("modalOverlay");
	if(hasClass(el, 'menuMobileOpen')){
		removeClass(el, 'menuMobileOpen');
		removeClass(overlay, 'overlayOpen');
	}
	else{
		addClass(el, 'menuMobileOpen');
		addClass(overlay, 'overlayOpen');
	}
}


function plusSlides(elem, n) {
	var item = elem.dataset.item;
  	showSlides(item, slideIndex[item] += n);
}

function currentSlide(elem, n) {
	var item = elem.dataset.item;
	showSlides(item, slideIndex[item] = n);
}

function showSlides(item, n) {
  var i;
  var elem = document.getElementById('carousel' + item);
  var slides = elem.getElementsByClassName("mySlides");
  var dots = elem.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex[item] = 1}
  if (n < 1) {slideIndex[item] = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex[item] - 1].style.display = "block";
  dots[slideIndex[item] - 1].className += " active";
}

var slideIndex = [];
window.addEventListener("load", function(event) {
		var elements = document.getElementsByClassName("carousel");
		for (var i = 0, len = elements.length; i < len; i++) {
		    var elem = elements[i];
			elem.setAttribute("id", "carousel" + i);
			elem.getElementsByClassName('prev')[0].dataset.item = i;
			elem.getElementsByClassName('next')[0].dataset.item = i;
			for (var j = 0, lenJ = elem.getElementsByClassName('dot').length; j < lenJ; j++) {
				elem.getElementsByClassName('dot')[j].dataset.item = i;
			}
			slideIndex[i] = 1;

			showSlides( i, 1);
		}
});

//contact
document.addEventListener('DOMContentLoaded', function(){

	if(document.getElementById('form-contact')){
		document.getElementById('form-contact').addEventListener('submit', function(e) {
			document.getElementById('submitButtonContact').disabled = true;
		    e.preventDefault();
			var form = document.forms.namedItem("form-contact");
			console.log("form");
			var formData = new FormData(form);
		    xhr = new XMLHttpRequest();
			xhr.open('POST', ajaxurl, true);
			xhr.onload = function() {
			    if (xhr.status === 200) {
			        //alert('Something went wrong.  Name is now ' + xhr.responseText);
					el = document.getElementById('modal');
					text = '<p>Votre message a été envoyé,<br>il sera traité rapidement.</p>';
					title = 'Formulaire de contact';
					openModal(el, text, title);
					document.getElementById('submitButtonContact').disabled = false;
			    }
			};
			xhr.send(formData);
		});
	}

	if(document.getElementById('newsletter-home')){
		document.getElementById('newsletter-home').addEventListener('submit', function(e) {
		    e.preventDefault();
			document.getElementById('submitButtonNewsHome').disabled = true;
			var form = document.forms.namedItem("newsletter-home");
			var formData = new FormData(form);
		    xhr = new XMLHttpRequest();
			xhr.open('POST', ajaxurl, true);
			xhr.onload = function() {
			    if (xhr.status === 200) {
			        //alert('Something went wrong.  Name is now ' + xhr.responseText);
					el = document.getElementById('modal');
					text = '<p>à bientôt</p>';
					title = 'Merci pour votre inscription.';
					openModal(el, text, title);
					document.getElementById('submitButtonNewsHome').disabled = false;
			    }
			};
			xhr.send(formData);
		});
	}

	if(document.getElementById('newsletter-footer')){
		document.getElementById('newsletter-footer').addEventListener('submit', function(e) {
		    e.preventDefault();
			document.getElementById('submitButtonNewsFooter').disabled = true;
			var form = document.forms.namedItem("newsletter-footer");
			var formData = new FormData(form);
		    xhr = new XMLHttpRequest();
			xhr.open('POST', ajaxurl, true);
			xhr.onload = function() {
			    if (xhr.status === 200) {
			        //alert('Something went wrong.  Name is now ' + xhr.responseText);
					el = document.getElementById('modal');
					text = '<p>à bientôt</p>';
					title = 'Merci pour votre inscription.';
					openModal(el, text, title);
					document.getElementById('submitButtonNewsFooter').disabled = false;
			    }
			};
			xhr.send(formData);
		});
	}
});
