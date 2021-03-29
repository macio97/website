// @license magnet:?xt=urn:btih:1f739d935676111cfff4b4693e3816e664797050&dn=gpl-3.0.txt GPL-v3-or-Later

window.onload = function() {
	const slider = document.querySelector('#submenu');
	let isDown = false;
	let startX;
	let scrollLeft;

	var clickHandler = function (event) {
		event.preventDefault();
		}

	elements = document.getElementById("submenu")
	elements = elements.querySelectorAll("a")

	slider.addEventListener('mousedown', (e) => {
		isDown = true;
		isDragging = false;
		startX = e.pageX - slider.offsetLeft;
		scrollLeft = slider.scrollLeft;
		for (var i = 0; i < elements.length; i++) {
			elements[i].addEventListener("click", clickHandler, false);
			}
		});

	slider.addEventListener('mouseleave', () => {
		isDown = false;
		});

	slider.addEventListener('mouseup', () => {
		if(isDragging==true){
			isDragging = false;
			}
		else {
			for (var i = 0; i < elements.length; i++) {
				elements[i].removeEventListener('click', clickHandler, false);
				}
			}
		isDown = false;
		});

	slider.addEventListener('mousemove', (e) => {
		isDragging = true
		if(!isDown) return;
		e.preventDefault();
		const x = e.pageX - slider.offsetLeft;
		const walk = x - startX;
		slider.scrollLeft = scrollLeft - walk;
		});
}

// @license-end