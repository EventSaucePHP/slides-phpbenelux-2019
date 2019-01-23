(function () {
   const title = document.getElementById('title');
   const header = document.getElementById('header');
   let titleContents = title.innerHTML;

    const slides = document.querySelectorAll('.slides > section');
    Array.from(slides).forEach(slide => {
        if (!slide.hasAttribute('data-title')) {
            slide.setAttribute('data-title', titleContents);
        } else {
            titleContents = slide.getAttribute('data-title');
        }

    });

    const onSlideChange = event => {
        title.innerHTML = event.currentSlide.getAttribute('data-title');

        if (event.currentSlide.hasAttribute('data-title-hidden')) {
            header.classList.add('hidden');
        } else {
            header.classList.remove('hidden');
        }
    };

    Reveal.addEventListener('slidechanged', onSlideChange);
    Reveal.addEventListener('ready', onSlideChange);
})();