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


<script src="scripts/Research.js"></script>
</body>
</html>