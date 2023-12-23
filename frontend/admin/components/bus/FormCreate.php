<h1 class="font-semibold text-lg md:text-2xl mb-6">Upload Product</h1>
<div class="rounded-lg border bg-card text-card-foreground shadow-sm max-w-xl mx-auto" data-v0-t="card">
  <div class="flex flex-col space-y-1.5 p-6 pb-4">
    <h3 class="text-2xl font-semibold leading-none tracking-tight">Product Information</h3>
  </div>
  <div class="p-6">
    <form class="grid gap-4">
      <div class="grid w-full max-w-md items-center gap-1.5">
        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="Company">Company</label>


        <select id="Company" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
          <option selected disabled class="bg-gray-500/20 text-white"> Choose a Company</option>

        </select>
      </div>

      <div class="grid w-full max-w-md items-center gap-1.5">
        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="Capasity">Number of Seats</label>
        <input id="capasity" type="number" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
      </div>
      <div class="grid w-full max-w-md items-center gap-1.5">
        <label class="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70" for="cost_per_km">Cost Per Km</label>
        <input id="cost_per_km" type="number" class="flex h-10 w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background file:border-0 file:bg-transparent file:text-sm file:font-medium placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50">
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
      let CompanyDiv = document.getElementById('Company');
      let CompanyList = await fetch('http://localhost/travel/backend/company.php');
      let data = await CompanyList.json();

      // loop through list cities and add it as option
      data.forEach(companyItem => {
        addOptionToSelectBus(CompanyDiv, companyItem)
      })
    } catch (error) {
      console.error("Error fetching bus:", error);
    }



    // function to add an option <buses> to a select element
    function addOptionToSelectBus(selectElement, optionValue) {
      const option = document.createElement('option');

      option.value = optionValue.id;
      option.text = optionValue.name;

      selectElement.appendChild(option);
    }



  })
</script>