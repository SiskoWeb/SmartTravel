<article id="ticket-wrapper" class="bg-white w-full  h-auto rounded-md p-4 mx-auto ">


<div id="ticket-wrapper2" class=" flex  gap-x-2 p-4 flex-col lg:flex-row mx-auto justify-between  lg:h-[80%] items-center " >
<div class=" ticket-wrapper-info flex-col lg:justify-between justify-center items-center gap-y-6 ">
  <h3 class="font-bold text-lg  leading-7 text-[#424248]">CTM - Kansas - Echo Bass</h3>
<img src="assets/ctm.png" class=" w-auto h-28 bg-cover bg-center">

</div>
<div class="ticket-wrapper-cities flex justify-between gap-x-4  items-center">
    
<div>
    <h4 class="font-semibold text-lg  leading-7 text-[#424248]">08:00 AM</h4>
    <p>Kansas</p>
</div>

<div class="text-center ">
<i class="fa-solid fa-arrow-right-long text-green-700"></i>
    <p>08:30 min</p>
</div>

<div>
    <h4 class="font-semibold text-lg  leading-7 text-[#424248]">04:30 PM</h4>
    <p>Echo Bass</p>
</div>

</div>
<div class="ticket-wrapper-price text-center flex flex-col gap-4">
    <h3 class="text-green-600 text-bold text-2xl">$100.00</h3>


   <button   class="w-full bg-[#0E9E4D] hover:bg-green-600 text-white font-medium py-2 px-4 rounded-lg focus:outline-none">Select Seat</button>

</div>
</div>
<hr>
<div class="flex  gap-x-2 p-4 mx-auto justify-start basis-4/6 items-center">
    <p class="font-bold text-[#777]">Facilities-</p> <span class="bg-[#f7f7f7] text-[#777] p-1 rounded-sn">Water Bottle</span>
     <span class="bg-[#f7f7f7] text-[#777] p-1 rounded-md">Pillow</span>
     <span class="bg-[#f7f7f7] text-[#777] p-1 rounded-md">Wifi</span>
</div>
</article>



<script>
const API_BASE_URL = 'http://localhost/travel/backend/trip.php';
try {
        
            const url = buildUrl();
            const response = await fetch(API_BASE_UR);
            if (!response.ok) {
                throw new Error(`Network response was not ok: ${response.statusText}`);
            }
            const data = await response.json();
            builderTrips(data)
            loader.classList.replace("flex", "hidden")
            console.log("Fetch successful. Data:", data);
            // Handle the data as needed
        } catch (error) {
            console.error("Fetch failed:", error);
            loader.classList.replace("flex", "hidden")

            buildMsgNoTrip()
            // Handle errors
        }

</script>