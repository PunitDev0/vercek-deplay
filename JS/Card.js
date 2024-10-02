
// Import core framework



// Show the toast
document.addEventListener('DOMContentLoaded', function() {
    const heartIcons = document.querySelectorAll('.heart-icon');
    const userIdInput = document.getElementById('form-user_id');

    // Iterate over all heart icons
    heartIcons.forEach(icon => {
      const productId = icon.getAttribute('data-product-id');

      // Initialize icon state from localStorage
      if (localStorage.getItem(`wishlist-${productId}`) === 'liked') {
        icon.classList.add('text-red-500'); // Liked state
        icon.classList.remove('text-gray-400');
       
      } else {
        icon.classList.add('text-gray-400'); // Default state
        icon.classList.remove('text-red-500');
      }

      // Handle click event on heart icon
      icon.addEventListener('click', function() {
        const isLiked = icon.classList.contains('text-red-500');
        const action = isLiked ? 'remove' : 'add';

        console.log(`Icon clicked for product ${productId}: Action is ${action}`);

        // Toggle heart icon color
        if (action === 'remove') {
          icon.classList.remove('text-red-500');
          icon.classList.add('text-gray-400');
          localStorage.removeItem(`wishlist-${productId}`);
          console.log(`Removed product ${productId} from wishlist`);
          Toastify({
            text: "Removed from wishlist",
            duration: 3000,
            newWindow: true,
            close: true,
            gravity: "bottom", // `top` or `bottom`
            position: "center", // `left`, `center`, or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "#ffffff", // White background
                color: "#333", // Dark text color
                boxShadow: "0px 0px 10px black", // Shadow
                borderRadius: "8px", // Rounded corners
                display: "flex",
                alignItems: "center",
                padding: "15px 25px" // Padding for better layout
              },
            avatar: "https://cdn-icons-png.flaticon.com/512/1828/1828843.png", // Cross icon URL
            onClick: function(){} // Callback after click
        }).showToast();
        } else {
          icon.classList.remove('text-gray-400');
          icon.classList.add('text-red-500');
          localStorage.setItem(`wishlist-${productId}`, 'liked'); 
          console.log(`Added product ${productId} to wishlist`);
            
            // Show toast with check icon for adding item
        Toastify({
            text: "Added to wishlist",
            duration: 3000,
            newWindow: true,
            close: true,
            gravity: "bottom", // `top` or `bottom`
            position: "center", // `left`, `center`, or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "#ffffff", // White background
                color: "#333", // Dark text color
                boxShadow: "0px 0px 10px black", // Shadow
                borderRadius: "8px", // Rounded corners
                display: "flex",
                alignItems: "center",
                padding: "15px 25px" // Padding for better layout
              },
            avatar: "https://cdn-icons-png.flaticon.com/512/190/190411.png", // Check icon URL
            onClick: function(){} // Callback after click
        }).showToast();

        }

        // Send AJAX request to update the server-side wishlist
        $.ajax({
          url: 'wishlist_handler.php',
          method: 'POST',
          data: {
            action: action,
            product_id: productId,
            user_id: userIdInput.value
          },
          success: function(result) {
            console.log('AJAX Success:', result);
          },
          error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
          }
        });
      });
    });
  });



  const swiper = new Swiper(".mySwiper", {
    navigation: false,
    autoplay: {
      delay: 3000, // Time in ms before the next slide
      disableOnInteraction: false, // Continue autoplay after interaction
    },
    loop: true,
  });