</main>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let lazyloadImages = document.querySelectorAll(".foto");

        if ("IntersectionObserver" in window) {
            let lazyloadObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        let img = entry.target;
                        img.style.backgroundImage = `url(${img.dataset.src})`;
                        lazyloadObserver.unobserve(img);
                    }
                });
            });

            lazyloadImages.forEach(function(img) {
                lazyloadObserver.observe(img);
            });
        } else {
            // Fallback to the event-based lazy load for older browsers
            let lazyloadThrottleTimeout;

            function lazyload() {
                if (lazyloadThrottleTimeout) {
                    clearTimeout(lazyloadThrottleTimeout);
                }

                lazyloadThrottleTimeout = setTimeout(function() {
                    let scrollTop = window.pageYOffset;
                    lazyloadImages.forEach(function(img) {
                        if (img.offsetTop < (window.innerHeight + scrollTop)) {
                            img.style.backgroundImage = `url(${img.dataset.src})`;
                            img.classList.remove('foto');
                        }
                    });
                    if (lazyloadImages.length === 0) {
                        document.removeEventListener("scroll", lazyload);
                        window.removeEventListener("resize", lazyload);
                        window.removeEventListener("orientationChange", lazyload);
                    }
                }, 20);
            }

            document.addEventListener("scroll", lazyload);
            window.addEventListener("resize", lazyload);
            window.addEventListener("orientationChange", lazyload);
        }
    });
</script>

</body>

</html>