// Hide the flash message after 2 seconds.
var flashMessageElement = document.getElementById('flash-message');
if (flashMessageElement) {
    setTimeout(function() {
        flashMessageElement.classList.add('flash-message--hidden');
    }, 2000);
}
