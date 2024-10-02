<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Responsive Products Grid with Pagination</title>
  <link rel="stylesheet" href="../CSS/Card.css">
  <style>
    /* Add some basic styling for pagination */
    .pagination {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }
    .pagination a {
      color: black;
      padding: 8px 16px;
      text-decoration: none;
      transition: background-color .3s;
    }
    .pagination a:hover {
      background-color: #ddd;
    }
    .pagination .active {
      background-color: #4CAF50;
      color: white;
    }
  </style>
</head>
<body>
  <div class="containers md:px-10">
    <?php
      include './config.php';

      // Pagination setup
      $limit = 12; // Number of products per page
      $page = isset($_GET['page']) ? intval($_GET['page']) : 1; // Get current page or set to 1 if not provided
      $offset = ($page - 1) * $limit;

      // Get total number of products for pagination calculation
      $total_items_query = mysqli_query($product_info, "SELECT COUNT(*) as total FROM product_item");
      $total_items = mysqli_fetch_assoc($total_items_query)['total'];
      $total_pages = ceil($total_items / $limit);

      // SQL query to fetch products with pagination
      $item_query = "SELECT * FROM product_item ORDER BY RAND() LIMIT $limit OFFSET $offset";
      $item_result = mysqli_query($product_info, $item_query);

      // Display products
      while ($items = mysqli_fetch_array($item_result)) {
    ?>
        <div class="product-card ">
          <div class="product-image relative overflow-hidden">
            <img src="../images/product_images/<?php echo htmlspecialchars($items['product_image']); ?>" alt="Product Image" class="object-cover">
            <!-- <div class="quick_view h-10 w-fit rounded-lg bg-white shadow-xl flex items-center justify-center py-2 px-4 absolute bottom-0 translate-y-10">
              <p>Quick View</p>
            </div> -->
          </div>
          <div class="product-info">
            <p class="product-name truncate"><?php echo htmlspecialchars($items['product_name']); ?></p>
            <p class="product-price">$<?php echo htmlspecialchars($items['product_price']); ?></p>
            <form action="details.php" method="GET">
              <input type="hidden" name="id" value="<?php echo htmlspecialchars($items['product_id']); ?>">
              <button type="submit" class="add-to-cart bg-black text-white py-2 px-4 mt-4 rounded transition duration-300 hover:bg-gray-700">
                Add to Cart
              </button>
            </form>
          </div>
        </div>
    <?php
      }
    ?>
  </div>

  <!-- Pagination Links -->
  <div class="pagination">
    <?php if ($page > 1): ?>
      <a href="?page=<?php echo $page - 1; ?>">&laquo; Prev</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
      <a class="<?php if ($i == $page) echo 'active'; ?>" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>

    <?php if ($page < $total_pages): ?>
      <a href="?page=<?php echo $page + 1; ?>">Next &raquo;</a>
    <?php endif; ?>
  </div>
</body>
</html>
