<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Swiper demo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <!-- Link Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.1/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="font-sans text-base text-black m-0 p-0">
  <!-- Swiper -->
  <div class="swiper mySwiper2 w-full h-full">
    <div class="swiper-wrapper">
  <?php
    include './config.php';
    $query = "SELECT * FROM Product_item WHERE product_catg = 3";
    $result = mysqli_query($product_info, $query);
    while($product = mysqli_fetch_assoc($result)){
  ?>
      <div class="swiper-slide flex justify-center items-center my-10 h-40 w-40">
        <div class="relative w-[7rem] h-[7rem] rounded-full bg-opacity-80 shadow-2xl">
          <img src="../images/Product_images/<?php echo $product['product_image']?>" alt="" class="h-full w-full object-cover mix-blend-multiply rounded-full" />
        </div>
      </div>
  <?php
      }
  ?>
    </div>
  </div>  
  <!-- Swiper JS -->
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".mySwiper2", {
      slidesPerView: 6,
      freeMode: true,
      loop: true,
      autoplay: {
        delay: 0,
        disableOnInteraction: false,
      },
      speed: 4000,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      breakpoints: {
        400: {
          slidesPerView: 2,
        },
        430: {
          slidesPerView: 2,
        },
        500: {
          slidesPerView: 3,
        },
        768: {
          slidesPerView: 4,
        },
        1024: {
          slidesPerView: 6,
        },
      },
    });
  </script>
</body>

</html>
