
  <style>
    .hover-grow:hover {
      margin-left: 10px;
    }
    * {
      color: black;
    }
    @media (max-width: 500px) {
      .ul {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
      }
    }
  </style>
  <!-- Other content -->

  <footer class="bg-gray-100 text-white py-8 w-full">
    <div class="w-full px-8">
      <div class="flex flex-wrap -mx-4">
        <div class="w-full md:w-1/4 px-4 mb-8 md:mb-0 leading-8">
          <h3 class="text-lg font-bold mb-4 hover-grow cursor-pointer" onclick="toggleList(this)">Contact</h3>
          <ul class="ul">
            <li>Address</li>
            <li>130 Street, Arizona</li>
            <li>85002, United States</li>
            <li>Mail Us: <a href="mailto:admin@info.com" class="text-blue-400 hover:underline hover-grow">admin@info.com</a></li>
            <li>Phone: (123) 456 7890</li>
          </ul>
        </div>
        <div class="w-full md:w-1/4 px-4 mb-8 md:mb-0">
          <h3 class="text-lg font-bold mb-4 hover-grow cursor-pointer" onclick="toggleList(this)">Your Account</h3>
          <ul class="leading-8 ul">
            <li><a href="#" class="hover:text-blue-400 transition-all hover-grow">Personal info</a></li>
            <li><a href="#" class="hover:text-blue-400 hover-grow transition-all">Orders</a></li>
            <li><a href="#" class="hover:text-blue-400 hover-grow transition-all">Credit slips</a></li>
            <li><a href="#" class="hover:text-blue-400 hover-grow transition-all">Addresses</a></li>
          </ul>
        </div>
        <div class="w-full md:w-1/4 px-4 mb-8 md:mb-0">
          <h3 class="text-lg font-bold mb-4 hover-grow cursor-pointer" onclick="toggleList(this)">Products</h3>
          <ul class="leading-8 ul">
            <li><a href="#" class="hover:text-blue-400 hover-grow transition-all">Prices drop</a></li>
            <li><a href="#" class="hover:text-blue-400 hover-grow transition-all">New products</a></li>
            <li><a href="#" class="hover:text-blue-400 hover-grow transition-all">Best sales</a></li>
            <li><a href="#" class="hover:text-blue-400 hover-grow transition-all">Sitemap</a></li>
            <li><a href="#" class="hover:text-blue-400 hover-grow transition-all">Stores</a></li>
          </ul>
        </div>
        <div class="w-full md:w-1/4 px-4 mb-8 md:mb-0">
          <h3 class="text-lg font-bold mb-4 hover-grow cursor-pointer" onclick="toggleList(this)">Our Company</h3>
          <ul class="leading-8 ul">
            <li><a href="#" class="hover:text-blue-400 hover-grow transition-all">Delivery</a></li>
            <li><a href="#" class="hover:text-blue-400 hover-grow transition-all">Legal Notice</a></li>
            <li><a href="#" class="hover:text-blue-400 hover-grow transition-all">Terms and conditions of use</a></li>
            <li><a href="#" class="hover:text-blue-400 hover-grow transition-all">About us</a></li>
            <li><a href="#" class="hover:text-blue-400 hover-grow transition-all">Secure payment</a></li>
            <li><a href="#" class="hover:text-blue-400 hover-grow transition-all">Contact us</a></li>
          </ul>
        </div>
      </div>
      <div class="flex flex-wrap justify-between items-center mt-8 border-t border-gray-700 pt-4">
        <p class="text-gray-400 text-sm">© 2024 - Ecommerce software by PrestaShop™</p>
        <div class="flex space-x-4">
          <img src="../Assests/visa_PNG25.png" alt="Visa" class="w-10 h-6">
          <img src="../Assests/paypal-logo-png-512.png" alt="PayPal" class="w-10 h-6">
          <img src="../Assests/PAYTM.NS_BIG-463f18d2.png" alt="Discover" class="w-15 h-6">
          <img src="../Assests/upi-logo-png-4-free-png-images-download-84465.png" alt="American Express" class="w-15 h-6">
        </div>
      </div>
    </div>
  </footer>

  <script>
    function toggleList(header) {
      const ul = header.nextElementSibling;
      if (ul.style.maxHeight) {
        ul.style.maxHeight = null;
      } else {
        ul.style.maxHeight = ul.scrollHeight + "px";
      }
    }
  </script>

