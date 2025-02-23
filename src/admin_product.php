<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PHP and JavaScript CRUD Project: PDO and API</title>
    <link rel="stylesheet" href="./output.css" />
</head>

<body class=" text-gray-600 font-body" onload="product_read()">
    <!-- Container -->
    <div class="container mx-auto mt-10 p-3">
        <?php
        include_once('header.html');
        ?>



        <div class="mt-5 flex justify-between items-end">
            <h1 class="mt-5 text-xl mb-2 font-bold">Admin: Products</h1>
            <a href="insert_productForm.php" class=" text-gray-700  bg-blue-200 rounded-lg bg-opacity-50 p-2 uppercase"
                id="addProductBtn">Add</a>
        </div>

        <div class="mt-5 overflow-auto rounded-lg shadow">

            <table class="w-full">
                <thead class="bg-gray-50 border-b-2 border-gray-200">
                    <tr>
                        <th class="w-20 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Product ID
                        </th>
                        <th class="w-30 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Product
                            Name</th>
                        <th
                            class="w-30 hidden sm:table-cell md:p-3 md:text-sm md:font-semibold md:tracking-wide md:text-left">
                            Description
                        </th>
                        <th class="w-10 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Price</th>
                        <th class="w-10 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">In Stock
                        </th>
                        <th class="w-30 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">Image</th>
                        <th class="w-10 p-3 text-sm font-semibold tracking-wide text-left whitespace-nowrap">
                            <a href="#" class="">Update</a>
                        </th>
                        <th class=" w-10 p-3 text-sm font-semibold tracking-wide text-left"><a href="#"
                                class="">Delete</a>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100" id="productTable">

                    <tr class="bg-white">
                        <td class="p-3 text-sm  tracking-wide text-left">100</td>
                        <td class="p-3 text-sm  tracking-wide text-left">AAA</td>
                        <td class="hidden sm:table-cell md:p-3 md:text-sm  md:tracking-wide md:text-left">
                            Lorem
                            ipsum
                            dolor sit amet,
                            consectetur adipisicing
                            elit. Nesciunt, assumenda, placeat ratione optio saepe accusantium, quibusdam asperiores
                            quis
                            consequatur hic molestiae! A, alias? Ut, possimus autem. Unde optio temporibus alias!</td>
                        <td class="p-3 text-sm  tracking-wide text-left">2000</td>
                        <td class="p-3 text-sm  tracking-wide text-left">50</td>
                        <td class="p-3 text-sm  tracking-wide text-left">Image</td>
                        <td class="p-3 text-sm font-semibold tracking-wide text-left"><a href="#"
                                class=" text-green-800 bg-green-200 rounded-lg bg-opacity-50 p-2 uppercase">Update</a>
                        </td>
                        <td class="p-3 text-sm font-semibold tracking-wide text-left"><a href="#"
                                class=" text-green-800  bg-red-200 rounded-lg bg-opacity-50 p-2 uppercase">Delete</a>
                        </td>
                    </tr>
                    <tr class="bg-white">
                        <td class="p-3 text-sm  tracking-wide text-left">200</td>
                        <td class="p-3 text-sm  tracking-wide text-left">BAA</td>
                        <td class="hidden sm:table-cell md:p-3 md:text-sm md:tracking-wide md:text-left">
                            Lorem
                            ipsum
                            dolor sit amet, consectetur adipisicing
                            elit. Nesciunt, assumenda, placeat ratione optio saepe accusantium, quibusdam asperiores
                            quis
                            consequatur hic molestiae! A, alias? Ut, possimus autem. Unde optio temporibus alias!</td>
                        <td class="p-3 text-sm  tracking-wide text-left">2000</td>
                        <td class="p-3 text-sm  tracking-wide text-left">30</td>
                        <td class="p-3 text-sm  tracking-wide text-left">Image</td>
                        <td class="p-3 text-sm font-semibold tracking-wide text-left"><a href="#"
                                class=" text-green-800 bg-green-200 rounded-lg bg-opacity-50 p-2 uppercase">Update</a>
                        </td>
                        <td class="p-3 text-sm font-semibold tracking-wide text-left"><a href="#"
                                class=" text-green-800  bg-red-200 rounded-lg bg-opacity-50 p-2 uppercase">Delete</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination Container -->
        <div id="pagination" class="mt-5 flex justify-center space-x-2"></div>

    </div>
    </div>
    <?php
    include_once('footer.html');
    ?>
    <script src="index.js"></script>
</body>

</html>
<script>
// กำหนดตัวแปร Pagination
var currentPage = 1;
var limit = 5; // จำนวนรายการต่อหน้า

var product_read = function(page) {
    currentPage = page; // กำหนดหน้าปัจจุบัน
    const requestOptions = {
        method: "GET",
        redirect: "follow",
    };

    var product_table = document.getElementById("productTable");
    fetch("http://localhost/php_tailwindcss_crud/src/api/readPagination.php?page=" + currentPage + "&limit=" +
            limit,
            requestOptions)
        .then((response) => response.json())
        .then((result) => {
            var products = result.products;
            var totalPages = result.totalPages;
            var trHTML = "";
            // var products = JSON.parse(result);
            for (let product of products) {
                trHTML +=
                    `<tr class="bg-white  align-top">
                        <td class="p-3 text-sm  tracking-wide text-left">` +
                    product.id +
                    `</td>
                        <td class="p-3 text-sm  tracking-wide text-left">` +
                    product.name +
                    `</td>
                        <td class="hidden sm:table-cell md:p-3 md:text-sm  md:tracking-wide md:text-left">
                            ` +
                    product.desc +
                    `</td>
                        <td class="p-3 text-sm  tracking-wide text-left">` +
                    product.price +
                    `</td>
                        <td class="p-3 text-sm  tracking-wide text-left">` +
                    product.stock +
                    `</td>
                        <td class="p-3 text-sm  tracking-wide text-left">
                        <img class="rounded-lg w-24 h-20 object-cover" src="product_display/` +
                    product.image_name +
                    ` "alt="image description"/></td>
                        <td class="p-3 text-sm font-semibold tracking-wide text-left"><a href="update_productForm.php?id=` +
                    product.id +
                    `"
                                class=" text-green-800 bg-green-200 rounded-lg bg-opacity-50 p-2 uppercase">Update</a>
                        </td>
                        <td class="p-3 text-sm font-semibold tracking-wide text-left"><a href="#" onclick="product_delete(` +
                    product.id + `)" class="text-green-800  bg-red-200 rounded-lg bg-opacity-50 p-2 uppercase">Delete</a>
                        </td>
                    </tr>`;
            }
            product_table.innerHTML = trHTML;
            generatePagination(totalPages);

        })
        .catch((error) => console.error(error));
}

// ฟังก์ชันสร้างปุ่ม Pagination
var generatePagination = function(totalPages) {
    var paginationDiv = document.getElementById("pagination");
    var paginationHTML = "";

    // ปุ่ม Previous
    if (currentPage > 1) {
        paginationHTML +=
            `<button onclick="product_read(${currentPage - 1})" class="mx-1 px-3 py-1 border rounded">Previous</button>`;
    }

    // ปุ่มแสดงหมายเลขหน้า
    for (var i = 1; i <= totalPages; i++) {
        if (i === currentPage) {
            paginationHTML +=
                `<button onclick="product_read(${i})" class="mx-1 px-3 py-1 border rounded bg-blue-500 text-white">${i}</button>`;
        } else {
            paginationHTML +=
                `<button onclick="product_read(${i})" class="mx-1 px-3 py-1 border rounded">${i}</button>`;
        }
    }

    // ปุ่ม Next
    if (currentPage < totalPages) {
        paginationHTML +=
            `<button onclick="product_read(${currentPage + 1})" class="mx-1 px-3 py-1 border rounded">Next</button>`;
    }

    paginationDiv.innerHTML = paginationHTML;
}

var product_delete = function(id) {
    if (confirm('Are you sure you want to delete this item?')) {
        const myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");

        console.log(id);
        const raw = JSON.stringify({
            "id": id
        });

        const requestOptions = {
            method: "DELETE",
            headers: myHeaders,
            body: raw,
            redirect: "follow"
        };

        fetch("http://localhost//php_tailwindcss_crud/src/api/delete.php", requestOptions)
            .then((response) => response.text())
            .then((result) => {
                var jsonObj = JSON.parse(result);
                if (jsonObj.status == 'ok') {
                    //alert('ok');
                    window.open('admin_product.php');
                } else {
                    alert('error');
                }

            })
            .catch((error) => console.error(error));

    }


}
</script>