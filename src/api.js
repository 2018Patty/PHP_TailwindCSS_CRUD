function loadProduct() {
  const xhttp = new XMLHttpRequest();
  xhttp.open("GET", "http://localhost/php_tailwindcss_crud/src/read.php");
  xhttp.send();
  xhttp.onreadystatechange = function () {
    // Check if success
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
      var trHTML = "";
      const products = JSON.parse(this.responseText);
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
                        <img class="rounded-lg w-20 h-20 object-cover" src="product_display/` +
          product.image_name +
          ` "alt="image description"/></td>
                        <td class="p-3 text-sm font-semibold tracking-wide text-left"><a href="#"
                                class=" text-green-800 bg-green-200 rounded-lg bg-opacity-50 p-2 uppercase">Update</a>
                        </td>
                        <td class="p-3 text-sm font-semibold tracking-wide text-left"><a href="#"
                                class=" text-green-800  bg-red-200 rounded-lg bg-opacity-50 p-2 uppercase">Delete</a>
                        </td>
                    </tr>`;
      }
      document.getElementById("productTable").innerHTML = trHTML;
    }
  };
}

document.addEventListener("DOMContentLoaded", function () {
  loadProduct();
});
