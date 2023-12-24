<div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-8">

    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="[&amp;_tr]:border-b">
            <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0 w-full sm:w-[200px]">Departure</th>
                <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0 w-full sm:w-[200px]">Destination</th>
                <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0 table-cell w-[200px]">Km</th>
                <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0 table-cell w-[200px]">Time Minuts</th>
                <th class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0 w-full sm:w-[200px]">Actions</th>
            </tr>
        </thead>
        <tbody id="routeTable" class="[&amp;_tr:last-child]:border-0">

        </tbody>
    </table>

</div>

<script>
    let routes = []

    let btnForm = document.getElementById('btnForm')

    // Move the onRemoveRoute function outside of the DOMContentLoaded event listener
    async function onRemoveRoute(id) {
        try {
            let routePromise = await fetch(`http://localhost/travel/backend/road.php?action=delete&id=${id}`);
            let data = await routePromise.json();
            onLoadBuildTable();
        } catch (error) {
            console.error("Error fetching cities:", error);
        }
    }

    onLoadBuildTable();

    async function onLoadBuildTable() {
        try {
            let routeTable = document.getElementById('routeTable');
            let routePromise = await fetch('http://localhost/travel/backend/road.php');
            let data = await routePromise.json();
            routes = data
            if (data.length !== 0) {
                routeTable.innerHTML = ''
                data.forEach(route => {
                    buildTable(routeTable, route);
                });
            } else {
                console.log('no routes')
            }
        } catch (error) {
            console.error("Error fetching cities:", error);
        }
    }

    function buildTable(routeTable, data) {
        const trTable = document.createElement('tr');
        trTable.classList = 'border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted';
        trTable.innerHTML = `<td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 font-medium">${data.departure}</td>
                <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 font-medium">${data.destination}</td>
                <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 font-medium">${data.distance_km}</td>
                <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 font-medium">${data.distance_minute}</td>
                <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">
                    <div class="flex space-x-2">
                    
                    <button onclick='onEditBtnRoute(${data.id})' class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 w-full sm:w-[100px]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-1">
                            <path d="M4 13.5V4a2 2 0 0 1 2-2h8.5L20 7.5V20a2 2 0 0 1-2 2h-5.5"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <path d="M10.42 12.61a2.1 2.1 0 1 1 2.97 2.97L7.95 21 4 22l.99-3.95 5.43-5.44Z"></path>
                        </svg>
                        Edit
                    </button>
                    <button onclick='onRemoveRoute(${data.id})'  class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 w-full sm:w-[100px]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-1">
                            <path d="M3 6h18"></path>
                            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                        </svg>
                        Delete
                    </button></div>
                </td>`;

        routeTable.appendChild(trTable);
    }



    //////////// update and create  ///////////////////


    //list of forms
    let kmForm = document.getElementById('km')
    let distance_minuteForm = document.getElementById('distance_minute')
    let departure = document.getElementById('departure')
    let destination = document.getElementById('destination')
    let error_msg = document.getElementById('error_msg')
    let idItemUpdate = null


    //when click on btn edit add value route to input
    async function onEditBtnRoute(id) {
        idItemUpdate = id

        //get data route admin want update by id
        let routeEdit = routes.find((item) => item.id === id)

        // fill dataroute to inputs to update it
        kmForm.value = routeEdit.distance_km
        distance_minuteForm.value = routeEdit.distance_minute
        fillInputsWithUpdate(departure, routeEdit.departure)
        fillInputsWithUpdate(destination, routeEdit.destination)



        //change value btnForm To Become Update
        btnForm.textContent = 'Update'

    }


    // on click BtnForm
    btnForm.addEventListener('click', async () => {
        console.log('clicker')

        // if (idItemUpdate === null) return error_msg.textContent = 'chose item first'
        if (kmForm.value.trim() === '') {
            return error_msg.textContent = 'Distance Km is Required'
        }
        if (distance_minuteForm.value.trim() === '') {
            return error_msg.textContent = 'distance minute is Required'
        }
        if (departure.value.trim() === '') {
            return error_msg.textContent = 'departure  is Required'
        }
        if (destination.value.trim() === '') {
            return error_msg.textContent = 'destination is Required'
        }


        const formData = new FormData();
        formData.append('distance_km', kmForm.value);
        formData.append('distance_minute', distance_minuteForm.value);
        formData.append('departure', departure.value);
        formData.append('destination', destination.value);
        console.log(departure.value)
        console.log(distance_minuteForm.value)

        if (btnForm.textContent === 'Update') {



            try {
                let routePromise = await fetch(`http://localhost/travel/backend/road.php?action=update&id=8`, {
                    method: 'POST',

                    body: formData,
                });



                let response = await routePromise.json();
                console.log(response);
                console.log('update');
                onLoadBuildTable();

                clearForm()
                btnForm.textContent = 'Create'
            } catch (error) {
                console.error(error);
            }


        } else {
            try {
                let routePromise = await fetch(`http://localhost/travel/backend/road.php?action=create`, {
                    method: 'POST',

                    body: formData,
                });



                let response = await routePromise.json();
                console.log(response);

                onLoadBuildTable();
                clearForm()

            } catch (error) {
                console.error(error);
            }

            console.log('create')
        }

    })


    function clearForm() {
        kmForm.value = '';
        distance_minuteForm.value = '';
        departure.value = '';
        destination.value = '';
        error_msg.textContent = '';
        idItemUpdate = null;
    }


    // function to update selectoon and add value of route 
    function fillInputsWithUpdate(selectElement, optionValue) {
        const option = document.createElement('option');
        option.value = optionValue
        option.text = optionValue
        option.selected = true;
        selectElement.appendChild(option);
    }
</script>