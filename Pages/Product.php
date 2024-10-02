<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/locomotive-scroll@3.5.4/dist/locomotive-scroll.css"
    />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <title>Document</title>
    <style>
      .Shortby {
        position: relative;
        width: 100%;
        padding: 10px;
      }
    </style>
  </head>
  <body>
    <div class="Navbar fixed w-full z-50">
      <?php include './Navbar.php' ?>
    </div>
    <div class="MainPage">
      <!-- here include navbar -->
      <div class="Content flex md:py-28 py-10 md:px-10">
        <div class="box1">
          <?php include'./sidebar.php'?>
        </div>
        <div class="box2 w-full h-full">
          <div class="Shortby w-full relative">
            <?php include'./Filter.php'?>
          </div>
          <div class="Cards my-10">
              <h1 class="text-center text-3xl">FEATURED COLLECTION'S</h1>
              <div class="horizontalCard product-list">
                <?php include './Card.php' ?>
              </div>
              <div class="verticalCard hidden product-list">
                <?php include './verticleCard.php' ?>
              </div>
          </div>
        </div>
      </div>
      <div class="z-50">
      <?php include './index.html'?>
      </div>
      <div class="Footer">
        <?php include './Footer.php'; ?>
      </div>
    </div>
  </body>
  <script src="https://cdn.jsdelivr.net/npm/locomotive-scroll@3.5.4/dist/locomotive-scroll.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  <!-- <script src="../JS/loco.js"></script> -->
</html>
