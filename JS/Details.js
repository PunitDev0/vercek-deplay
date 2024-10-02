console.log('hello');

function openTab(evt, tabName) {
    var i, tabcontent, tablinks;

    // Hide all tab contents
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Remove the active class from all tablinks
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab and add an active class to the button that opened the tab
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}

var swiper = new Swiper(".mySwiper4", {
    slidesPerView: 3, // Adjust the number of slides per view
    spaceBetween: 30, // Space between slides
    // loop: true, // Loop slides
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        640: {
            slidesPerView: 1,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 2,
            spaceBetween: 30,
        },
        1024: {
            slidesPerView: 3,
            spaceBetween: 30,
        },
    }
});
document.getElementsByClassName('tablinks')[0].click();
document.querySelectorAll('#relatedImage').forEach(img => {
    img.addEventListener('click', function() {
        console.log('helo');
        document.querySelector('.mainImage').src = this.src;
    });
});
document.querySelectorAll('#relatedImage').forEach(img => {
    img.addEventListener('mouseover', function() {
        console.log('helo');
        document.querySelector('.mainImage').src = this.src;
    });
});
