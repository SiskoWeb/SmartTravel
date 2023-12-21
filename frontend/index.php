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

<main class=" w-full lg:h-[450px] h-[550px]		">


<!-- form  -->
<section class='flex  items-center justify-start pt-10 lg:justify-between flex-col lg:flex-row  max-w-screen-xl h-full gap-6 px-4 mx-auto '>
<div class='flex flex-col items-center lg:items-start justify-between gap-10'>
    <h2 class='text-3xl font-bold tracking-tighter sm:text-4xl md:text-5xl lg:text-6xl '>Get Your Ticket Online,<br > Easy and Safely</h1>
    <a href="https://themesberg.com/product/tailwind-css/landing-page"
                class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 sm:mr-2 lg:mr-0 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800">BUY
                TICKETS</a>
    </div>
  
    <div class=' w-full lg:w-auto'>
    <p class="text-xs italic text-red-500 text-center" id="error_msg"></p>

        <h3 class='font-bold text-gray-500 text-center lg:text-left'>Choose Your Ticket</h3>
        <?php require('components/form.php')?>
    </div>

</section>

    
    
    <section class="bg-cover bg-center relative  w-full h-[20%] " style="background-image: url(assets/bg1.png)">
        <img id="bus_img" src="assets/bus.png" alt="bg" class="absolute  w-[100px] h-auto bottom-0 right-0 z-30">
    </section>

  
    



    </main>


    <script src="scripts/home.js"></script>


</body>
</html>

