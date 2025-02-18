<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Text Image Above Image</title>
    <link rel="stylesheet" href="./output.css">
</head>

<body>
    <div class="relative w-full h-[500px]">
        <img src="https://images.unsplash.com/photo-1580835920990-3ed971441447?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
            alt="Background" class="absolute top-0 left-0 w-full h-full object-cover" />

        <div class="absolute inset-0  text-white">
            <div class="flex flex-col items-end justify-center h-[500px]">
                <h1 class="text-3xl font-anton font-bold">Main Heading</h1>
                <h2 class="text-xl">Second Heading</h2>
                <p class="w-1/2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum, dignissimos molestiae.
                    Minima
                    perferendis
                    laboriosam alias, corrupti autem voluptates reprehenderit fugit mollitia itaque atque nihil
                    perspiciatis
                    eveniet quas, dolor repellat. Illum.</p>
                <a class="mt-5 px-4 py-2 rounded-lg btn bg-blue-500 text-white" href="#">Read More</a>

            </div>


        </div>



    </div>

    <div class="main">
        <div class="box">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Adipisci maxime laborum
            inventore, debitis vitae libero magnam quos quisquam suscipit excepturi nulla aliquid. Quas doloremque
            necessitatibus sapiente laborum deserunt sunt vitae!</div>
        <div class="box">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Adipisci maxime laborum
            inventore, debitis vitae libero magnam quos quisquam suscipit excepturi nulla aliquid. Quas doloremque
            necessitatibus sapiente laborum deserunt sunt vitae!</div>
        <div class="box">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Adipisci maxime laborum
            inventore, debitis vitae libero magnam quos quisquam suscipit excepturi nulla aliquid. Quas doloremque
            necessitatibus sapiente laborum deserunt sunt vitae!</div>
    </div>
</body>

</html>