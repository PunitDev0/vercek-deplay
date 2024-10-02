<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stoods Styling - About Us</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.2/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.2/ScrollTrigger.min.js"></script>
  <style>
    .hero-bg {
      background-image: url('https://images.pexels.com/photos/247929/pexels-photo-247929.jpeg');
      background-size: cover;
      background-position: center;
    }
  </style>
</head>

<body class="bg-gray-100 text-gray-800 font-sans">
    <?php include './Navbar.php'?>
  <!-- Hero Section -->
  <section class="hero-bg h-[600px] flex items-center justify-center">
    <div class="text-center text-white">
      <h1 class="text-5xl font-bold mb-4">About Stoods Styling</h1>
      <p class="text-lg mb-6">Leading fashion trends with style and comfort</p>
      <button class="bg-gray-900 text-white px-6 py-2 rounded-lg hover:bg-gray-800 transition-all duration-300">Explore Our Story</button>
    </div>
  </section>

  <!-- About Us Section -->
  <section class="py-20 px-6 md:px-20 bg-white">
    <div class="max-w-7xl mx-auto">
      <h2 class="text-4xl font-bold text-center mb-12">Who We Are</h2>
      <div class="md:flex gap-10">
        <div class="md:w-1/2 mb-10 md:mb-0">
          <img src="https://images.pexels.com/photos/769732/pexels-photo-769732.jpeg" alt="About Image" class="rounded-lg shadow-lg">
        </div>
        <div class="md:w-1/2">
          <p class="text-lg mb-4">
            Stoods Styling is a renowned brand dedicated to delivering the best in fashion with a modern twist. Our mission is to make fashion accessible to everyone, while keeping up with the latest trends in the industry. Our team of designers works tirelessly to bring innovative, stylish, and comfortable products that resonate with our customers.
          </p>
          <p class="text-lg mb-4">
            We believe fashion is not just about clothing; it's an expression of who you are. At Stoods Styling, we pride ourselves on creating pieces that speak to the personality and style of our clients.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Our Journey -->
  <section class="py-20 bg-gray-50 px-6 md:px-20">
    <div class="max-w-7xl mx-auto">
      <h2 class="text-4xl font-bold text-center mb-12">Our Journey</h2>
      <div class="space-y-8">
        <div class="flex items-center">
          <div class="flex-shrink-0 w-16 h-16 rounded-full bg-gray-900 text-white flex items-center justify-center text-xl font-bold">2010</div>
          <div class="ml-8 text-lg">Stoods Styling was founded by a group of passionate fashion enthusiasts.</div>
        </div>
        <div class="flex items-center">
          <div class="flex-shrink-0 w-16 h-16 rounded-full bg-gray-900 text-white flex items-center justify-center text-xl font-bold">2015</div>
          <div class="ml-8 text-lg">Launched our first international collection, bringing unique designs to a global audience.</div>
        </div>
        <div class="flex items-center">
          <div class="flex-shrink-0 w-16 h-16 rounded-full bg-gray-900 text-white flex items-center justify-center text-xl font-bold">2020</div>
          <div class="ml-8 text-lg">Expanded to online retail, making our products accessible worldwide.</div>
        </div>
        <div class="flex items-center">
          <div class="flex-shrink-0 w-16 h-16 rounded-full bg-gray-900 text-white flex items-center justify-center text-xl font-bold">2024</div>
          <div class="ml-8 text-lg">Partnered with global influencers to promote sustainable fashion trends.</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Our Values (Image Gallery) -->
  <section class="py-20 px-6 md:px-20 bg-white">
    <div class="max-w-7xl mx-auto text-center">
      <h2 class="text-4xl font-bold mb-12">Our Values</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
        <div class="relative overflow-hidden rounded-lg">
          <img src="https://images.pexels.com/photos/4471852/pexels-photo-4471852.jpeg" alt="Value 1" class="w-full h-auto hover:scale-110 transform transition-all duration-500">
          <div class="absolute inset-0 bg-gray-900 bg-opacity-50 text-white flex items-center justify-center opacity-0 hover:opacity-100 transition-all duration-500">
            <p class="text-xl font-bold">Sustainability</p>
          </div>
        </div>
        <div class="relative overflow-hidden rounded-lg">
          <img src="https://images.pexels.com/photos/6187924/pexels-photo-6187924.jpeg" alt="Value 2" class="w-full h-auto hover:scale-110 transform transition-all duration-500">
          <div class="absolute inset-0 bg-gray-900 bg-opacity-50 text-white flex items-center justify-center opacity-0 hover:opacity-100 transition-all duration-500">
            <p class="text-xl font-bold">Innovation</p>
          </div>
        </div>
        <div class="relative overflow-hidden rounded-lg">
          <img src="https://images.pexels.com/photos/1319489/pexels-photo-1319489.jpeg" alt="Value 3" class="w-full h-auto hover:scale-110 transform transition-all duration-500">
          <div class="absolute inset-0 bg-gray-900 bg-opacity-50 text-white flex items-center justify-center opacity-0 hover:opacity-100 transition-all duration-500">
            <p class="text-xl font-bold">Style</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section class="py-20 bg-gray-50 px-6 md:px-20">
    <div class="max-w-7xl mx-auto">
      <h2 class="text-4xl font-bold text-center mb-12">What Our Clients Say</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
        <div class="bg-white p-6 rounded-lg shadow-lg">
          <p class="text-lg italic mb-4">"Stoods Styling's collection is always ahead of the curve. Their products are not only stylish but also super comfortable. Love their commitment to sustainability!"</p>
          <h3 class="text-xl font-bold">Emily Parker</h3>
          <p class="text-gray-600">Fashion Blogger</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow-lg">
          <p class="text-lg italic mb-4">"The team at Stoods Styling truly understands fashion. Every piece feels unique and special. I've been a loyal customer for years."</p>
          <h3 class="text-xl font-bold">Michael Smith</h3>
          <p class="text-gray-600">Entrepreneur</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Meet The Team -->
  <section class="bg-white py-20 px-6 md:px-20">
    <div class="max-w-7xl mx-auto text-center">
      <h2 class="text-4xl font-bold mb-12">Meet the Team</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
        <div class="team-member">
          <img src="https://images.pexels.com/photos/1181690/pexels-photo-1181690.jpeg" alt="Team Member 1" class="w-full h-auto rounded-full mx-auto mb-4">
          <h3 class="text-xl font-bold">Alex Johnson</h3>
          <p class="text-gray-600">CEO & Founder</p>
        </div>
        <div class="team-member">
          <img src="https://images.pexels.com/photos/1181453/pexels-photo-1181453.jpeg" alt="Team Member 2" class="w-full h-auto rounded-full mx-auto mb-4">
          <h3 class="text-xl font-bold">Sophia Williams</h3>
          <p class="text-gray-600">Creative Director</p>
        </div>
        <div class="team-member">
          <img src="https://images.pexels.com/photos/1267698/pexels-photo-1267698.jpeg" alt="Team Member 3" class="w-full h-auto rounded-full mx-auto mb-4">
          <h3 class="text-xl font-bold">Mark Thompson</h3>
          <p class="text-gray-600">Lead Designer</p>
        </div>
      </div>
    </div>
  </section>

  <script>
    gsap.registerPlugin(ScrollTrigger);
    gsap.from('.hero-bg h1', {
      opacity: 0,
      y: -50,
      duration: 1,
      scrollTrigger: {
        trigger: '.hero-bg',
        start: 'top center',
        end: 'bottom top',
        toggleActions: 'restart none none reverse'
      }
    });
  </script>
</body>

</html>
