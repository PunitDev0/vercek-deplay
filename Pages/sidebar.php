<?php
// Define the directory containing images
$directory = '../Images/Product_images/';

// Get all image files with supported extensions
$images = glob($directory . "/*.{jpg,jpeg,png,gif}", GLOB_BRACE);

// Convert the PHP array of images to a JSON array for JavaScript
$imagesJSON = json_encode($images);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../CSS/sidebar.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>Document</title>
  <style>
    .price-range {
      margin: 20px 0;
    }
    .price-range p {
      margin: 10px 0;
    }
    .price-range input[type=range] {
      width: 100%;
    }
    .price-range-output {
      display: flex;
      justify-content: space-between;
    }
    .hideitem {
      overflow: hidden;
    }
    .max-h-0 {
      max-height: 0;
      transition: max-height 0.5s ease-out;
    }
    .max-h-96 {
      max-height: 24rem; /* Adjust as needed */
      transition: max-height 0.5s ease-in;
    }
  </style>
</head>
<body>
  <div class="Filter">
    <div class="list">
      <ul class="options leading-8 p-2 font-bold">
        <h1 class="text-2xl py-4">Shop</h1>
        <hr>
        <li class="font-bold">
          Fashion
          <button class="toggle-btn bg-transparent"><i class='bx bx-plus'></i></button>
          <ul class="hideitem max-h-0 overflow-hidden text-xs px-5 font-medium opacity-55">
            <form id="nav-form" action="Product.php" method="GET">
                <input type="hidden" name="page" id="page-input" />
                <div class=" flex flex-col md:flex  text-sm font-medium" id="nav">
                    <a href="#"  onclick="submitForm('1')">Polos</a>
                    <a href="#" onclick="submitForm('2')">Watch</a>
                    <a href="#" onclick="submitForm('3')">Accessories</a>
                    <a href="#" onclick="submitForm('4')">Shoes</a>
                </div>
            </form>
          </ul>
        </li>
        <li class="font-bold" >
          Jewellery
          <button class="toggle-btn"><i class='bx bx-plus'></i></button>
          <ul class="hideitem max-h-0 overflow-hidden text-xs px-5 font-medium opacity-55">
          <form id="nav-form" action="Product.php" method="GET">
                <input type="hidden" name="page" id="page-input" />
                <div class=" flex flex-col md:flex  text-sm font-medium" id="nav">
                    <a href="#"  onclick="submitForm('1')">Polos</a>
                    <a href="#" onclick="submitForm('2')">Watch</a>
                    <a href="#" onclick="submitForm('3')">Accessories</a>
                    <a href="#" onclick="submitForm('4')">Shoes</a>
                </div>
            </form>
          </ul>
        </li>
        <li class="font-bold" >
          Furniture
          <button class="toggle-btn"><i class='bx bx-plus'></i></button>
          <ul class="hideitem max-h-0 overflow-hidden text-xs px-5 font-medium opacity-55">
          <form id="nav-form" action="Product.php" method="GET">
                <input type="hidden" name="page" id="page-input" />
                <div class=" flex flex-col md:flex  text-sm font-medium" id="nav">
                    <a href="#"  onclick="submitForm('1')">Polos</a>
                    <a href="#" onclick="submitForm('2')">Watch</a>
                    <a href="#" onclick="submitForm('3')">Accessories</a>
                    <a href="#" onclick="submitForm('4')">Shoes</a>
                </div>
            </form>
          </ul>
        </li>
        <li class="font-bold" >
          Fashion
          <button class="toggle-btn"><i class='bx bx-plus'></i></button>
          <ul class="hideitem max-h-0 overflow-hidden text-xs px-5 font-medium opacity-55">
          <form id="nav-form" action="Product.php" method="GET">
                <input type="hidden" name="page" id="page-input" />
                <div class=" flex flex-col md:flex  text-sm font-medium" id="nav">
                    <a href="#"  onclick="submitForm('1')">Polos</a>
                    <a href="#" onclick="submitForm('2')">Watch</a>
                    <a href="#" onclick="submitForm('3')">Accessories</a>
                    <a href="#" onclick="submitForm('4')">Shoes</a>
                </div>
            </form>
          </ul>
        </li>
      </ul>
    </div>
    <div class="list">
      <ul class="options leading-8 p-2 font-bold">
        <h1 class="text-2xl py-4">Filter</h1>
        <hr>
        <li class="font-bold">
          Fashion
          <button class="toggle-btn bg-transparent"><i class='bx bx-plus'></i></button>
          <ul class="hideitem max-h-0 overflow-hidden">
            <li>
              <div class="price-range">
                <form id="price-filter-form" action="" method="GET">
                  <p>Price:</p>
                  <div class="price-range-output">
                    <span id="min-price-output">$0</span>
                    <span id="max-price-output">$1000</span>
                  </div>
                  <input type="range" name="min_price" id="min-price" min="0" max="1000" value="0" step="1">
                  <input type="range" name="max_price" id="max-price" min="0" max="1000" value="1000">
                  <input type="text" name="pr_id">
                  <button type="submit" name="submit" class="border-2 px-4 rounded-lg bg-[#333] text-white hover:bg-gray-400 transition-all">Filter</button>
                </form>
              </div>
            </li>
          </ul>
        </li>
        
      </ul>
    </div>
    <div class="image">
      <img src="" alt="" id = "rotating-image">
    </div>
  </div>

  <script>
    document.querySelectorAll('.toggle-btn').forEach((button) => {
      button.addEventListener('click', () => {
        const ul = button.nextElementSibling;
        ul.classList.toggle('max-h-0');
        ul.classList.toggle('max-h-96');

        const icon = button.querySelector('i');
        icon.classList.toggle('bx-plus');
        icon.classList.toggle('bx-minus');
      });
    }); 

        document.querySelector('#min-price').addEventListener('input', () => {
            document.getElementById('min-price-output').innerText = '$' + document.querySelector('#min-price').value;
        });

        document.querySelector('#max-price').addEventListener('input', () => {
            document.getElementById('max-price-output').innerText = '$' + document.querySelector('#max-price').value;
        });

        const images = <?php echo $imagesJSON; ?>;
        
        let currentImageIndex = 0;

        function changeImage() {
            const imgElement = document.getElementById('rotating-image');
            imgElement.src = images[currentImageIndex];
            currentImageIndex++;            
            if (currentImageIndex >= images.length) {
                currentImageIndex = 0;
            }
        }
        setInterval(changeImage, 600);
        changeImage();

    
  </script>
</body>
</html>
