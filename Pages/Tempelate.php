<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Product Banner</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom styling for the image scaling */
        .product-image {
            transition: transform 0.3s ease-in-out;
        }
        .product-image:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body >
    <!-- Container -->
    <div class="bg-[<?= $color ?>] flex md:h-[40vh] sm:h-[30vh] h-[20vh] items-center justify-between md:p-10 sm:p-6 p-1 text-white rounded-lg w-full mx-auto mt-10">

        <!-- Left Section - Product Image -->
        <div class="w-1/2 flex justify-center absolute translate-x-14 -translate-y-10">
            <img src="<?= $image ?>" alt="Smart Watch" class=" w-[450px] md:w-[480px]">
        </div>

        <!-- Right Section - Text Content -->
         <div >
             <p class="text-lg md:text-base text-white">29% OFF</p>
             <h2 class="sm:text-6xl md:text-7xl text-3xl font-extrabold text-white">HAPPY <br> HOUR'S</h2>
            <p class="font-semibold text-sm sm:mb-6 text-white">From 15 Nov to 7 Dec</p>
         </div>
        <div class="sm:w-1/2 w-1/3 text-left sm:mt-6  md:mt-0 ">
            <h3 class="xm:text-xl md:text-2xl text-[1rem] font-semibold mb-2 text-white">Summer Sale</h3>
            <p class="sm:text-sm md:text-base text-[10px] sm:mb-6 mb-4  text-white">
            Company that's grown from 270 to 480 employees in the last 12 months.
            </p>
            <a href="#" class="bg-white text-green-500 font-bold sm:text-base text-sm sm:py-2 py-1 px-4 sm:px-6 rounded-full hover:bg-gray-100 transition duration-300">Shop Now</a>
        </div>

    </div>

</body>
</html>
