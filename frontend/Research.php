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
<section class="bg-cover bg-center relative  w-full h-[300px] flex items-end justify-center" style="background-image: url(assets/heroResearch.png)">
       <div class="bg-white rounded-tr-md rounded-tl-md w-3/4 h-3/4">
       <?php require('components/form.php')?>
       </div>
    </section>

    <section class="flex gap-x-10  bg-blue-500 items-center justify-start pt-40 lg:justify-between flex-col lg:flex-row  max-w-screen-xl h-screen px-4 mx-auto">


    <div class="bg-green-500 basis-1/4	w-full h-screen">
<div class="flex ">
<p class="justify-between w-full gap-x-10">Filter <button class="border-none ourline-none bg-transparent">Reset All</button></p>

</div>
</div>
    <div class="bg-red-500 basis-3/4	w-full h-screen">

</div>
    </section>

    <!-- /*<input id="orderBy" type="checkbox"  value="ASC" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">

    <input id="schedules" type="checkbox"  value="night" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
    */ -->

<script src="scripts/Research.js"></script>
</body>
</html>