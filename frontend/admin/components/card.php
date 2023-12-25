<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 p-6">



    <div class="rounded-lg border bg-card text-card-foreground shadow-sm hover:shadow-lg transition-all duration-200" data-v0-t="card">
        <div class="flex flex-col space-y-1.5 p-6">
            <h3 class="text-2xl font-semibold leading-none tracking-tight">Total Income</h3>
        </div>
        <div class="p-6 flex items-center justify-between"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-8 h-8 text-green-500">
                <line x1="12" x2="12" y1="2" y2="22"></line>
                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
            </svg><span class="text-4xl font-semibold">$103,430</span></div>
    </div>



    <div class="rounded-lg border bg-card text-card-foreground shadow-sm hover:shadow-lg transition-all duration-200" data-v0-t="card">
        <div class="flex flex-col space-y-1.5 p-6">
            <h3 class="text-2xl font-semibold leading-none tracking-tight">Number of Trips</h3>
        </div>
        <div class="p-6 flex items-center justify-between">
            <i class="fa-solid fa-suitcase-rolling text-blue-500"></i>
            <span class="text-4xl font-semibold">123</span>
        </div>
    </div>


    <div class="rounded-lg border bg-card text-card-foreground shadow-sm hover:shadow-lg transition-all duration-200" data-v0-t="card">
        <div class="flex flex-col space-y-1.5 p-6">
            <h3 class="text-2xl font-semibold leading-none tracking-tight">Bus</h3>
        </div>
        <div class="p-6 flex items-center justify-between">
            <i class="fa-solid fa-bus w-18 h-auto text-red-500"></i>
            <span class="text-4xl font-semibold">241</span>
        </div>
    </div>


    <div class="rounded-lg border bg-card text-card-foreground shadow-sm hover:shadow-lg transition-all duration-200" data-v0-t="card">
        <div class="flex flex-col space-y-1.5 p-6">
            <h3 class="text-2xl font-semibold leading-none tracking-tight">Routes</h3>
        </div>
        <div class="p-6 flex items-center justify-between">
            <i class="fa-solid fa-route text-yellow-500  w-30 h-auto"></i>
            <span class="text-4xl font-semibold">51</span>
        </div>
    </div>


</div>


<script>
    document.addEventListener('DOMContentLoaded', onLoadBuildTable)
    
    
    //this function bring data from server and send it to
    // function <buildTable> to create
    async function onLoadBuildTable() {
        const API_BASE_URL = 'http://localhost/travel/backend/status.php';

        try {
            const routePromise = await fetch(API_BASE_URL);
            const data = await routePromise.json();
            console.log(data)




        } catch (error) {
            console.error("Error fetching compines:", error);
        }
    }
</script>