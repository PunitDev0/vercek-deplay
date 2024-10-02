<style>
    /* General Styles */
    .grid-view {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
    }

    .list-view {
        display: block;
    }

    .list-view>div {
        margin-bottom: 1rem;
    }

    .filter {
        width: 100%;
    }

    /* Responsive Styles */
    @media (max-width: 400px) {
        .grid-view {
            grid-template-columns: repeat(2, 1fr);
            gap: 0.5rem;
        }

        .filter {
            padding: 4px;
        }

        .flex.items-center {
            flex-direction: column;
            align-items: stretch;
        }

        .flex.space-x-2 {
            margin-bottom: 1rem;
            justify-content: space-between;
        }

        .p-2 {
            padding: 0.5rem;
        }

        .sort-form {
            width: 100%;
            margin-bottom: 1rem;
        }

        .sort-form label {
            font-size: 0.875rem;
        }

        .sort-form select {
            width: 100%;
            font-size: 0.875rem;
        }
    }
</style>
<div class="bg-gray-100">

    <!-- Filter and Sort Options -->
    <div class="flex items-center justify-between mb-4 shadow-lg filter md:p-6 p-3 bg-white">
        <div class="flex space-x-2">
            <button id="grid-view" class="p-2 border border-gray-300 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h4V4H4v2zm6 0h4V4h-4v2zm6 0h4V4h-4v2zM4 10h4V8H4v2zm6 0h4V8h-4v2zm6 0h4V8h-4v2zM4 14h4v-2H4v2zm6 0h4v-2H4v2zm6 0h4v-2H4v2zM4 18h4v-2H4v2zm6 0h4v-2H4v2zm6 0h4v-2H4v2z" />
                </svg>
            </button>
            <button id="list-view" class="p-2 border border-gray-300 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                </svg>
            </button>
        </div>
        <p class="text-sm text-gray-600 md:hidden">There are 16 products.</p>
        <div class="sort-form">
            <form id="sort-form" method="GET" action="">
            <input type="hidden" name="page" id="page-input" value="<?php echo $_SESSION['catgid']?>">
                <label for="sort-by" class="mr-2">Sort by:</label>
                <select id="sort-by" name="sort" class="border border-gray-300 p-2 rounded">
                    <option value="relevance">Relevance</option>
                    <option value="price-asc">Price: Low to High</option>
                    <option value="price-desc">Price: High to Low</option>
                </select>
            </form>
        </div>
    </div>
    <?php $_SESSION['catgid'] = isset($_GET['page']) ? $_GET['page'] : " ";?>
    
    <!-- Title -->
    <div class="container mx-auto">
        <h1 class="text-2xl font-semibold mb-6 text-center">
            <?php
            $min_price = isset($_GET['min_price']) ? (int)$_GET['min_price'] : 0;
            $max_price = isset($_GET['max_price']) ? (int)$_GET['max_price'] : 1000;
            echo "Product List: $min_price - $max_price";
            ?>
        </h1>
    </div>

    <!-- Add your product cards or list elements here -->

    <script>
        // Sort Form Submission
        document.getElementById('sort-by').addEventListener('input', function(event) {
            event.preventDefault();
            document.getElementById('sort-form').submit();
        });

       

    </script>
</div>

</html>