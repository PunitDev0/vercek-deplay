if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}

window.onload = () => {
    const navbar= document.getElementById('navbar');

    // Event listener for scrolling
    window.addEventListener('scroll', () => {
        const scrollY = window.scrollY;
        console.log(`Scroll Position: ${scrollY}px`);
        if (scrollY > 230) {
            console.log(scrollY);
            navbar.classList.add('bg-white') // Show the indicator when scrolled
        } else {
            navbar.classList.remove('bg-white') 
        }
    });
}

document.querySelector('.bx-menu').addEventListener('click', function() {
    // Slide the sidebar in
    gsap.to(".sidebar", {
        x: 0,
        duration: 0.5,
        ease: "power2.inOut",
    });

    // Animate the sidebar elements
    gsap.from(".sideEle", {
        x: -50,
        opacity: 0,
        duration: 0.8,
        ease: "power2.inOut",
        stagger: 0.1,
        delay: 0.2,
    });
});

document.querySelector('.bx-close').addEventListener('click', function() {
    // Slide the sidebar out
    gsap.to(".sidebar", {
        x: -208, // -52 * 4 (width of sidebar in px)
        duration: 0.5,
        ease: "power2.inOut",
    });
});


document.querySelector('.bx-close').addEventListener('click', function() {
    document.querySelector('.sidebar').classList.toggle('open');
});
// document.querySelector('.toggle').addEventListener('click',()=>{
//     document.querySelector('.sidebar').classList.remove('open')
// })
function submitForm(page) {
    document.getElementById('page-input').value = page;
    document.getElementById('nav-form').submit();
}
const user = document.querySelector('.user-icon')
const submenu = document.querySelector('.sub-menu')
user.addEventListener('mouseenter', () => {
    console.log("hello world");
    // const ul = button.nextElementSibling;
    submenu.classList.toggle('max-h-0');
    submenu.classList.toggle('max-h-96');
  });
user.addEventListener('mouseleave', () => {
    console.log("hello world");
    // const ul = button.nextElementSibling;
    submenu.classList.toggle('max-h-0');
    submenu.classList.toggle('max-h-96');
  });


document.querySelector('.bx-cart').addEventListener('click', ()=>{
    document.querySelector('.cart').classList.remove('translate-x-[300px]')
})
document.querySelector('#bx-x').addEventListener('click', ()=>{
    document.querySelector('.cart').classList.add('translate-x-[300px]')
})
document.querySelector('.bx-heart').addEventListener('click', ()=>{
    document.querySelector('.wishlist').classList.remove('translate-x-[300px]')
})
document.querySelector('#bx-wish').addEventListener('click', ()=>{
    console.log('hello');
    
    document.querySelector('.wishlist').classList.add('translate-x-[300px]')
})