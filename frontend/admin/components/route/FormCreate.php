<h1 class="font-semibold text-lg md:text-2xl mb-6">Upload Product</h1>
<div class="rounded-lg border bg-card text-card-foreground shadow-sm max-w-xl mx-auto" data-v0-t="card">
  <div class="flex flex-col space-y-1.5 p-6 pb-4">
    <h3 class="text-2xl font-semibold leading-none tracking-tight">Product Information</h3>
  </div>
  <div class="p-6">
    <form class="grid gap-4">

      <div id="error_msg" class=" text-sm text-red-500 rounded-lg  dark:bg-gray-800 dark:text-red-400" role="alert">

      </div>
      <div class="grid w-full max-w-md items-center gap-1.5">
        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="departure">Departure</label>


        <select id="departure" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
          <option class="text-gray-400" value="" disabled selected>Pcik a departure</option>

        </select>
      </div>

      <div class="grid w-full max-w-md items-center gap-1.5">
        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="destination">Destination</label>


        <select id="destination" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
          <option class="text-gray-400" value="" disabled selected>Pick a destination</option>

        </select>
      </div>
      <div class="grid w-full max-w-md items-center gap-1.5">
        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="km">Distance Km</label>
        <input id="km" type="number" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
      </div>
      <div class="grid w-full max-w-md items-center gap-1.5">
        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="distance_minute">Distance Minute</label>
        <input id="distance_minute" type="number" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
      </div>





    </form>
    <button type="button" id="btnForm" class="inline-flex items-center justify-center text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-primary text-primary-foreground hover:bg-primary/90 h-9 rounded-md px-3 w-full">
      Create
    </button>
  </div>
</div>


<script>
  // Fetch cities and populate the dropdowns
  document.addEventListener('DOMContentLoaded', async () => {


    try {
      let departure = document.getElementById('departure');
      let destination = document.getElementById('destination');
      let citiesPromise = await fetch('../cities.json');
      let data = await citiesPromise.json();

      data.forEach(city => {
        // loop through list cities and add it as option
        addOptionToSelect(departure, city.city);
        addOptionToSelect(destination, city.city);
      });
    } catch (error) {
      console.error("Error fetching cities:", error);
    }
  })



  // function to add an option <citeis> to a select element
  function addOptionToSelect(selectElement, optionValue) {
    const option = document.createElement('option');
    option.value = optionValue;
    option.text = optionValue;
    selectElement.appendChild(option);
  }
</script>