<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/ea3542be0c.js" crossorigin="anonymous"></script>

    <title>SmartTravel</title>
    <style>
        /* Add styling for the bus_img */
        #bus_img {
            transition: right 20s ease-in-out;
        }
    </style>
</head>
<?php require('components/navbar.php')?>
<body >

<main class="relative w-full h-[500px] bg-cover bg-center ">


<!-- form  -->
<section class='flex  items-center justify-start pt-10 lg:justify-between flex-col lg:flex-row  max-w-screen-xl h-full gap-6 px-4 mx-auto'>
<div class='flex flex-col items-center lg:items-start justify-between gap-10'>
    <h2 class='text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl lg:text-6xl  '>Get Your Ticket Online,<br> Easy and Safely</h1>
    <a href="https://themesberg.com/product/tailwind-css/landing-page"
                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 sm:mr-2 lg:mr-0 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">BUY
                TICKETS</a>
    </div>
    <div>
    <h2 class='text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl lg:text-6xl  '>Get Your Ticket Online,<br> Easy and Safely</h1>
    </div>
</section>

<div class='pt-10'>
<img id="bus_img" src="assets/bus.png" alt="bg" class="absolute  w-[100px] h-auto bottom-0 right-0 z-30">
<div class="bg-cover bg-center absolute  w-full bottom-0 left-0 right-0 h-[20%]" style="background-image: url(assets/bg1.png)"></div>
    </div>



    </main>
<script>
        document.addEventListener('DOMContentLoaded', function () {
            // Get a reference to the bus_img element
            let busImg = document.getElementById('bus_img');

            let currentRight = parseFloat(getComputedStyle(busImg).right);
          
            let speed = busImg.style.right;
            console.log(speed)
            function animateBus() {
        
                let newRight = (currentRight === 0) ? '100%' : 0;

                // Apply the new right value
                busImg.style.right = newRight;
            }

            // Set up the animation to occur every 2 seconds (adjust the interval as needed)
        
            setInterval(animateBus, 1000);
        });
    </script>
</body>
</html>

