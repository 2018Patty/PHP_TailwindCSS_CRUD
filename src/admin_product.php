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

        <table
            class="table-auto overflow-hidden rounded-lg mt-4 border-collapse border border-blue-500 w-full text-left">
            <thead>
                <tr class="bg-blue-100">
                    <th class="border border-blue-500 px-4 py-2">Column 1</th>
                    <th class="border border-blue-500 px-4 py-2">Column 2</th>
                    <th class="border border-blue-500 px-4 py-2">Column 3</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border border-blue-500 px-4 py-2">Data 1</td>
                    <td class="border border-blue-500 px-4 py-2">Data 2</td>
                    <td class="border border-blue-500 px-4 py-2">Data 3</td>
                </tr>
                <tr class="bg-blue-50">
                    <td class="border border-blue-500 px-4 py-2">Data 4</td>
                    <td class="border border-blue-500 px-4 py-2">Data 5</td>
                    <td class="border border-blue-500 px-4 py-2">Data 6</td>
                </tr>
            </tbody>
        </table>




    </div>






    <?php
    include_once('footer.html');
    ?>
    <script src="index.js"></script>
</body>

</html>