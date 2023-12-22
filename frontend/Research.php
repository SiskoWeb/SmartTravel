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
<body class="bg-[#f6f6f7] relative ">



<!-- start form section -->
<section id="slider_hero" class="bg-cover bg-center relative   h-[300px] flex items-end justify-center" style="background-image: url(assets/heroResearch.jpg)">
       <div class="bg-white rounded-tr-md rounded-tl-md w-full h-3/4 flex gap-x-10    max-w-screen-xl  px-4 mx-auto">
       <?php require('components/formSearch.php')?>
       </div>
    </section>

<!-- end form section -->

    

<!-- start list of trips section -->
    <section class="flex gap-10  h-auto items-start justify-start pt-10 lg:justify-between flex-col lg:flex-row  max-w-screen-xl min-h-screen px-4 mx-auto">

    <div class="bg-white basis-1/4	rounded-md w-full h-screen p-8 mx-auto">
<div class=" flex justify-between  ">
<p class='font-bold'>Filter</p><button class="border-none ourline-none bg-transparent">Reset All</button>

</div>

<hr>
<!-- filer sorting  -->
<div class=" py-6">
<p class='font-bold py-4'>Company</p>



</div>
<hr>
<!-- filer sorting  -->
<div class=" py-6">
<p class='font-bold py-4'>Price</p>

<div class="flex gap-x-4">

<input id="minPrice" type="number" placeholder="From" class="w-full py-2 px-4 border border-gray-400 rounded-lg focus:outline-none focus:border-green-500 ">
<input id="maxPrice"  type="number" placeholder="To" class="w-full py-2 px-4 border border-gray-400 rounded-lg focus:outline-none focus:border-green-500 ">
</div>

</div>
<hr>
<!-- filer Schedules  -->
<div class=" py-6">
<p class='font-bold py-4' >Sorting</p>

<div >
<select id="orderBy" class="w-full py-2 px-4 border border-gray-400 rounded-lg focus:outline-none focus:border-green-500">
  <option  class="text-gray-400" value="" disabled selected>sorting By</option>
  <option value="DESC">Price: High to Low</option>
  <option value="ASC">Price: Low to High</option>

</select> 

</div>

</div>
<hr>
<!-- filer sorting  -->
<div class=" py-6">
<p class='font-bold py-4'>Schedules</p>

<div>
    <label for="all" class="flex items-center gap-x-4 text-gray-400">
        <input id="all" type="radio" name="time" value="all" class="accent-green-600 border-2 w-4 h-4 text-green-600 bg-gray-100 border-green-300 rounded focus:ring-green-600" checked>
        <span class="bg-[#f6f6f7] rounded-md w-2/2 px-2 flex gap-x-3 items-center"><i class="fa-regular fa-clock"></i>All</span>
    </label>

    <label for="morning" class="flex items-center gap-x-4 text-gray-400">
        <input id="morning" type="radio" name="time" value="morning" class="accent-green-600 border-2 w-4 h-4 text-green-600 bg-gray-100 border-green-300 rounded focus:ring-green-600">
        <span class="bg-[#f6f6f7] rounded-md w-2/2 px-2 flex gap-x-3 items-center"><i class="fa-regular fa-clock"></i>Morning</span>
    </label>

    <label for="afternoon" class="flex items-center gap-x-4 text-gray-400">
        <input id="afternoon" type="radio" name="time" value="afternoon" class="accent-green-600 border-2 w-4 h-4 text-green-600 bg-gray-100 border-green-300 rounded focus:ring-green-600">
        <span class="bg-[#f6f6f7] rounded-md w-2/2 px-2 flex gap-x-3 items-center"><i class="fa-regular fa-clock"></i>Afternoon</span>
    </label>

    <label for="night" class="flex items-center gap-x-4 text-gray-400">
        <input id="night" type="radio" name="time" value="night" class="accent-green-600 border-2 w-4 h-4 text-green-600 bg-gray-100 border-green-300 rounded focus:ring-green-600">
        <span class="bg-[#f6f6f7] rounded-md w-2/2 px-2 flex gap-x-3 items-center"><i class="fa-regular fa-clock"></i>Night</span>
    </label>
</div>


</div>

</div>


    <div id="card_trips" class="  basis-3/4	w-full h-auto flex flex-col gap-y-4">

    
</div>
    </section>
<!-- start list of trips section -->


    <!-- /*<input id="orderBy" type="checkbox"  value="ASC" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">

    <input id="schedules" type="checkbox"  value="night" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
    */ -->
    <?php require('components/loader.php')?>

<script src="scripts/Research.js"></script> 
<script src="scripts/slider.js"></script> 


</body>
</html>