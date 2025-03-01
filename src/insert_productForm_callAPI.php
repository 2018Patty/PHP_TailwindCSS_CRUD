<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PHP and JavaScript CRUD Project: PDO and API</title>
    <link rel="stylesheet" href="./output.css" />
</head>

<body class="text-gray-600 font-body">
    <!-- Container -->
    <div class="container mx-auto mt-10 p-3">
        <?php
        include_once('header.html');
        ?>

        <form onsubmit="" method="post" action="" enctype="multipart/form-data" id="productForm">
            <div class="mt-5 border rounded-lg shadow w-1/2 space-y-12 mx-auto p-3">
                <div class="pb-5">
                    <h2 class="text-2xl text-center font-semibold text-gray-900">Add New Product</h2>


                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="col-span-full">
                            <label for="productname" class="block text-sm/6 font-medium text-gray-900">Product
                                Name</label>
                            <div class="mt-2">
                                <div
                                    class="flex items-center rounded-md bg-white pl-3 outline outline-1 -outline-offset-1 outline-gray-300 focus-within:outline focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">

                                    <input type="text" name="product_name" id="product_name"
                                        class="block min-w-0 grow py-1.5 pl-1 pr-3 text-base text-gray-900 placeholder:text-gray-400 focus:outline focus:outline-0 sm:text-sm/6"
                                        placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="col-span-full">
                            <label for="about" class="block text-sm/6 font-medium text-gray-900">Product
                                Description</label>
                            <div class="mt-2">
                                <textarea name="product_desc" id="product_desc" rows="3"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"></textarea>
                            </div>
                            <p class="mt-3 text-sm/6 text-gray-600">Write a few sentences about your product.</p>
                        </div>

                        <div class="col-span-full">
                            <label for="cover-photo" class="block text-sm/6 font-medium text-gray-900">Product
                                photo</label>
                            <input type="file" id="product_pic" name="product_pic">
                            <!-- <div
                                class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                                <div class="text-center">
                                    <svg class="mx-auto size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor"
                                        aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd"
                                            d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <div class="mt-4 flex text-sm/6 text-gray-600">
                                        <label for="file-upload"
                                            class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                            <span>Upload a file</span>
                                            <input id="product_pic" name="product_pic" type="file" class="sr-only">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs/5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                                </div>
                            </div> -->
                        </div>
                    </div>

                    <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                        <div class="sm:col-span-2">
                            <label for="product_price" class="block text-sm/6 font-medium text-gray-900">Price</label>
                            <div class="mt-2">
                                <input type="text" name="product_price" id="product_price" autocomplete="given-name"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="product_instock" class="block text-sm/6 font-medium text-gray-900">In
                                Stock</label>
                            <div class="mt-2">
                                <input type="text" name="product_instock" id="product_instock"
                                    autocomplete="family-name"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            </div>
                        </div>

                        <div class="sm:col-span-2">
                            <label for="product_size" class="block text-sm/6 font-medium text-gray-900">Size</label>
                            <div class="mt-2">
                                <input type="text" name="product_size" id="product_size" autocomplete="family-name"
                                    class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                            </div>
                        </div>

                    </div>
                    <div class="mt-10 flex items-center justify-end gap-x-6">
                        <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
                        <button type="submit" onclick="product_create()"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                    </div>
                </div>


            </div>


        </form>



    </div>
</body>

</html>
<script>
document.getElementById("productForm").addEventListener("submit", function(event) {
    event.preventDefault();

    let formData = new FormData(this);

    fetch("http://localhost/php_tailwindcss_crud/src/api/create_upload_api.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(result => {
            if (result.status === "ok") {
                alert("Product uploaded successfully!");
                this.reset(); // ล้างฟอร์ม
                window.open('admin_product.php');
            } else {
                alert("Error: " + result.message);
            }
        })
        .catch(error => console.error("Error:", error));
});

var product_create = function() {
    const myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");


    const raw = JSON.stringify({
        "name": document.getElementById('product_name').value,
        "price": document.getElementById('product_price').value,
        "stock": document.getElementById('product_instock').value,
        "desc": document.getElementById('product_desc').value,
        "size": document.getElementById('product_size').value,
        "image_name": document.getElementById('product_pic').files[0].name,
    });

    const requestOptions = {
        method: "POST",
        headers: myHeaders,
        body: raw,
        redirect: "follow"
    };

    fetch("http://localhost/php_tailwindcss_crud/src/api/create_upload_api.php", requestOptions)
        .then((response) => response.text())
        .then((result) => {
            var jsonObj = JSON.parse(result);
            if (jsonObj.status == 'ok') {
                alert('ok');
                //window.open('index.html');
            } else {
                alert('error');
            }


        })
        .catch((error) => console.error(error));
}
</script>