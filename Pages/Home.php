<?php
session_start();
if (!$_SESSION['logged_in']) {
  header("Location: ./Login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../CSS/Home.css">
  <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.2/gsap.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <title>Document</title>
  <style>
    body {
      cursor: url("../Assests/cursor.png"), auto;
    }
  </style>
</head>

<body class=" text-white bg-gray-100 overflow-x-hidden">
  <div class="Navbar fixed z-50 w-full">
    <?php include './Navbar.php' ?>
  </div>
  <div class="MainHome py-[74px]">
    <div class="SwiperAdd relative">
      <?php include '../Swipers/Swiper.html' ?>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 p-4 h-full w-full relative" style="grid-template-rows: repeat(2, minmax(200px, 300px));">

  <!-- First item: spans two rows -->
  <div class="grid-item transition-transform transform hover:scale-105 ease-in-out duration-300 lg:row-span-2 row-span-1 bg-gray-900 flex items-center justify-center relative overflow-hidden rounded-lg shadow-lg">
    <img src="../Assests/image/perfume.jpeg" alt="Perfume" class="w-full h-full object-cover hover:opacity-80 transition-opacity duration-300">
    <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center p-4 opacity-0 hover:opacity-100 transition-opacity duration-300">
      <h2 class="text-xl md:text-2xl font-bold text-white">Sale Up To 30% Off</h2>
      <p class="text-base md:text-lg text-white">Latest Perfume Collection</p>
      <a href="#" class="text-yellow-500 hover:underline">View Offer</a>
    </div>
  </div>

  <!-- Second item -->
  <div class="grid-item transition-transform transform hover:scale-105 ease-in-out duration-300 col-span-1 bg-gray-900 flex items-center justify-center relative overflow-hidden rounded-lg shadow-lg">
    <img src="../Assests/image/Ring.jpeg" alt="Ring" class="w-full h-full object-cover hover:opacity-80 transition-opacity duration-300">
    <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center p-4 opacity-0 hover:opacity-100 transition-opacity duration-300">
      <h2 class="text-xl md:text-2xl font-bold text-white">20% Off Rings</h2>
      <a href="#" class="text-yellow-500 hover:underline">Shop Now</a>
    </div>
  </div>

  <!-- Third item -->
  <div class="grid-item transition-transform transform hover:scale-105 ease-in-out duration-300 col-span-2 bg-gray-900 flex items-center justify-center relative overflow-hidden rounded-lg shadow-lg">
    <img src="../Assests/image/Straight Interface Manual Folding Head Layer Cowhide Strap - Silver Button Head _ 22mm.jpeg" alt="Watch Strap" class="w-full h-full object-cover hover:opacity-80 transition-opacity duration-300">
    <div class="absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center p-4 opacity-0 hover:opacity-100 transition-opacity duration-300">
      <p class="text-base md:text-lg text-white">Luxury Watch Strap</p>
    </div>
  </div>

  <!-- Fourth item -->
  <div class="grid-item transition-transform transform hover:scale-105 ease-in-out duration-300 col-span-1 lg:col-span-2 bg-gray-900 flex items-center justify-center relative overflow-hidden rounded-lg shadow-lg">
    <img src="../Assests/image/download.jpeg" alt="Smart Speaker" class="w-full h-full object-cover hover:opacity-80 transition-opacity duration-300">
    <div class="absolute inset-0 bg-black bg-opacity-50 flex justify-center items-center p-4 opacity-0 hover:opacity-100 transition-opacity duration-300">
      <p class="text-base md:text-lg text-white">Smart Speaker</p>
    </div>
  </div>

  <!-- Fifth item -->
  <div class="grid-item transition-transform transform hover:scale-105 ease-in-out duration-300 col-span-1 bg-gray-900 flex items-center justify-center relative overflow-hidden rounded-lg shadow-lg">
    <img src="../Assests/image/Shoes.jpeg" alt="Shoes" class="w-full h-full object-cover hover:opacity-80 transition-opacity duration-300">
    <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col justify-center items-center p-4 opacity-0 hover:opacity-100 transition-opacity duration-300">
      <p class="text-xl md:text-2xl font-bold text-white">Stylish Shoes</p>
      <a href="#" class="text-yellow-500 hover:underline">View More</a>
    </div>
  </div>

</div>

<div class="tempelate py-20 sm:px-10">
            <?php 
            $color = "#457488";
            $image = "../Assests/Shoe.png";
            include './Tempelate.php'?>
        </div>

    <section class="section min-h-screen">
      <div class="Home-image grid grid-cols-1 md:grid-cols-3 gap-4 md:mt-20">
        <!-- First Box -->
        <div class="box flex  items-center justify-between bg-[#F3F3F3] p-6 text-center rounded-lg shadow-lg">
          <div class="text mb-4 md:mb-0">
            <h1 class="text-xl md:text-2xl font-bold">Discover Our Products</h1>
            <p class="text-sm md:text-base text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          </div>
          <div class="img w-full bg-[#EBEBEB] rounded-lg p-4">
            <img class="h-[20vw] md:h-auto w-full object-contain" src="../Assests/image/WatchImage2.png" alt="Product Image">
          </div>
        </div>

        <!-- Second Box -->
        <div class="box flex items-center justify-between bg-[#F3F3F3] p-6 text-center rounded-lg shadow-lg">
          <div class="text mb-4 md:mb-0">
            <h1 class="text-xl md:text-2xl font-bold">New Arrivals</h1>
            <p class="text-sm md:text-base text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          </div>
          <div class="img w-full bg-[#EBEBEB] rounded-lg p-4">
            <img class="h-[20vw] md:h-auto w-full object-contain" src="../Assests/image/WatchImage2.png" alt="New Arrival Image">
          </div>
        </div>

        <!-- Third Box -->
        <div class="box flex  items-center justify-between bg-[#F3F3F3] p-6 text-center rounded-lg shadow-lg">
          <div class="text mb-4 md:mb-0">
            <h1 class="text-xl md:text-2xl font-bold">Special Offers</h1>
            <p class="text-sm md:text-base text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          </div>
          <div class="img w-full bg-[#EBEBEB] rounded-lg p-4">
            <img class="h-[20vw] md:h-auto w-full object-contain" src="../Assests/image/WatchImage3.png" alt="Special Offers Image">
          </div>
        </div>
      </div>



      <div class="FindThings flex flex-col mt-10 relative w-screen h- bg-[#F3F3F3]">
        <h1 class="text-center mb-3 text-lg font-bold">Find Things You'll Love</h1>
        <?php include '../Swipers/Swiper2.php' ?>
      </div>


      <div class="Cards mt-10 flex flex-col w-full items-center">
        <h1 class="text-center text-3xl">FEATURED COLLECTION'S</h1>
        <?php include './Polocard.php' ?>
      </div>

        <div class="tempelate py-20 sm:px-10">
          <?php 
          $color ="#DDA983";
          $image = "../Assests/WatchImage2.png";
          include './Tempelate.php'?>
        </div>

      <div class="Items">
        <div class="box ">
          <div class="image">
            <img class="img" src="../Assests/image/WatchImage1.png" alt="">
          </div>
          <div class="text">
            <h1>Tempered Glass</h1>
            <p>Make Your Life Smart</p>
            <button>Shop Now</button>
          </div>
        </div>
        <div class="box">
          <div class="image">
            <img class="img" src="../Images/Product_images/71OxdL3aBYL._SY625_.jpg" alt="">
          </div>
          <div class="text">
            <h1>Tempered Glass</h1>
            <p>Make Your Life Smart</p>
            <button>Shop Now</button>
          </div>
        </div>
        <div class="box">
          <div class="image">
            <img class="img" src="../Assests/image/WatchImage3.png" alt="">
          </div>
          <div class="text">
            <h1>Tempered Glass</h1>
            <p>Make Your Life Smart</p>
            <button>Shop Now</button>
          </div>
        </div>
      </div>

      <div class="NewProduct mt-12 p-10">
        <h1 class="text-center text-3xl mb-10">NEW PRODUCTS</h1>
        <?php include '../Swipers/Swiper3.php' ?>
      </div>
    </section>

    <div class="">
      <?php include './Footer.php'; ?>
    </div>
  </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/locomotive-scroll@3.5.4/dist/locomotive-scroll.js"></script>

</html>