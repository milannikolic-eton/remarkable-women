    // Wait for the DOM to load
document.addEventListener('DOMContentLoaded', function() {
        const header = document.getElementById("header");

        // Set the offset position of the header
        const sticky = header.offsetTop;

        // Add or remove the sticky-header class based on scroll position
        window.onscroll = function() {
            if (window.pageYOffset > sticky) {
                header.classList.add("sticky-header");
            } else {
                header.classList.remove("sticky-header");
            }
        };

        document.getElementById('mob-menu-bar').addEventListener('click', function () {
            this.classList.toggle('change');
            document.querySelector('.header nav').classList.toggle('menu-open');
            document.body.classList.toggle('menu-open');
        });
            
}); //wait for DOM