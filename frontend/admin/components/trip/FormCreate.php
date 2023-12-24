<h1 class="font-semibold text-lg md:text-2xl mb-6">Upload Product</h1>
<div class="rounded-lg border bg-card text-card-foreground shadow-sm max-w-xl mx-auto" data-v0-t="card">
  <div class="flex flex-col space-y-1.5 p-6 pb-4">
    <h3 class="text-2xl font-semibold leading-none tracking-tight">Product Information</h3>
  </div>
  <div class="p-6">
    <form class="grid gap-4">
      <div class="grid w-full max-w-md items-center gap-1.5">


        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="departure">Time</label>



        <div date-rangepicker class="flex items-center">


          <input name="start" type="datetime-local" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date start">



          <span class="mx-4 text-gray-500">to</span>


          <input name="end" type="datetime-local" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full  p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date end">

        </div>


      </div>

      <div class="grid w-full max-w-md items-center gap-1.5">
        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="bus">Bus</label>


        <select id="bus" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
          <option selected disabled class="bg-gray-500/20 text-white">Choose a Bus</option>


        </select>
      </div>



      <div class="grid w-full max-w-md items-center gap-1.5">
        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="route">Route</label>


        <select id="route" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
          <option selected disabled class="bg-gray-500">Choose a Route</option>

        </select>
      </div>


      <div class="grid w-full max-w-md items-center gap-1.5">
        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="seats">Seats Available</label>
        <input max='50' placeholder="/seats" id="seats" type="number" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
      </div>


      <div class="grid w-full max-w-md items-center gap-1.5">
        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="timeOfDay">Time of Day</label>




        <div id="timeOfDay" class="flex gap-x-4">

          <label for="morning" class="flex items-center gap-x-4 text-gray-400">
            <input checked id="morning" type="radio" name="timeOfDay" value="morning" class="accent-green-600 border-2 w-4 h-4 text-green-600 bg-gray-100 border-green-300 rounded focus:ring-green-600">
            <span class="bg-[#f6f6f7] rounded-md w-2/2 px-2 flex gap-x-3 items-center"><i class="fa-regular fa-clock"></i>Morning</span>
          </label>

          <label for="afternoon" class="flex items-center gap-x-4 text-gray-400">
            <input id="afternoon" type="radio" name="timeOfDay" value="afternoon" class="accent-green-600 border-2 w-4 h-4 text-green-600 bg-gray-100 border-green-300 rounded focus:ring-green-600">
            <span class="bg-[#f6f6f7] rounded-md w-2/2 px-2 flex gap-x-3 items-center"><i class="fa-regular fa-clock"></i>Afternoon</span>
          </label>

          <label for="night" class="flex items-center gap-x-4 text-gray-400">
            <input id="night" type="radio" name="timeOfDay" value="night" class="accent-green-600 border-2 w-4 h-4 text-green-600 bg-gray-100 border-green-300 rounded focus:ring-green-600">
            <span class="bg-[#f6f6f7] rounded-md w-2/2 px-2 flex gap-x-3 items-center"><i class="fa-regular fa-clock"></i>Night</span>
          </label>
        </div>

      </div>







      <button class="inline-flex items-center justify-center text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-9 rounded-md px-3 w-full">
        Create
      </button>
    </form>
  </div>
</div>


<script>
  document.addEventListener('DOMContentLoaded', async () => {


    // Fetch cities and populate the dropdowns
    try {
      let busDiv = document.getElementById('bus');
      let busList = await fetch('http://localhost/travel/backend/bus.php');
      let data = await busList.json();

      // loop through list cities and add it as option
      data.forEach(busItem => {
        addOptionToSelectBus(busDiv, busItem.number_bus)
      })
    } catch (error) {
      console.error("Error fetching bus:", error);
    }



    // function to add an option <buses> to a select element
    function addOptionToSelectBus(selectElement, optionValue) {
      const option = document.createElement('option');
      option.value = optionValue;
      option.text = optionValue;
      selectElement.appendChild(option);
    }



    // Fetch cities and populate the dropdowns
    try {
      let routeDiv = document.getElementById('route');
      let routeList = await fetch('http://localhost/travel/backend/road.php');
      let data = await routeList.json();

      // loop through list cities and add it as option
      data.forEach(routeItem => {
        addOptionToSelectRoute(routeDiv, routeItem)
      })
    } catch (error) {
      console.error("Error fetching route:", error);
    }


    // function to add an option <buses> to a select element
    function addOptionToSelectRoute(selectElement, optionValue) {
      const option = document.createElement('option');
      option.value = optionValue.id;
      option.text = `${optionValue.departure} to ${optionValue.destination}`;
      selectElement.appendChild(option);
    }


  })
</script>