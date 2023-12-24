

const API_BASE_URL = 'http://localhost/travel/backend/bus.php';
const Image_BASE_URL = 'http://localhost/travel/backend/';

// DOM elements
const btnForm = document.getElementById('btnForm');
const busesTable = document.getElementById('companiesTable');
const CompanyInput = document.getElementById('Company');
const capasityInput = document.getElementById('capasity');
const costKmInput = document.getElementById('cost_per_km');



const error_msg = document.getElementById('error_msg');

let buses = [];
let idItemUpdate = null;



//
document.addEventListener('DOMContentLoaded', () => {
    btnForm.addEventListener('click', onBtnFormClick);
    onLoadBuildTable();
});



async function onRemoveRoute(id) {
    try {
        await fetch(`${API_BASE_URL}?action=delete&id=${id}`, { method: 'DELETE' });
        onLoadBuildTable();
    } catch (error) {
        console.error("Error deleting route:", error);
    }
}

//this function bring data from server and send it to
// function <buildTable> to create
async function onLoadBuildTable() {
    try {
        const busPromise = await fetch(API_BASE_URL);
        const data = await busPromise.json();
        buses = data;

        if (data.length !== 0) {
            busesTable.innerHTML = '';
            data.forEach(bus => buildTable(busesTable, bus));
        } else {
            console.log('no buses');
        }
    } catch (error) {
        console.error("Error fetching buses:", error);
    }
}


//this function for item in tables 
//required:table body and data 
function buildTable(busesTable, data) {
    const trTable = document.createElement('tr');
    trTable.classList = 'border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted';
    trTable.innerHTML = `
        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 font-medium">${data.number_bus}</td>
        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 font-medium">${data.capacity}</td>
        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 font-medium">${data.companyName}</td>
        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 font-medium">$${data.cost_per_km}</td>



        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">
            <div class="flex space-x-2">
                <button onclick='onEditBtnRoute(${data.number_bus})' class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 w-full sm:w-[100px]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-1">
                        <path d="M4 13.5V4a2 2 0 0 1 2-2h8.5L20 7.5V20a2 2 0 0 1-2 2h-5.5"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <path d="M10.42 12.61a2.1 2.1 0 1 1 2.97 2.97L7.95 21 4 22l.99-3.95 5.43-5.44Z"></path>
                    </svg>
                    Edit
                </button>
                <button onclick='onRemoveRoute(${data.number_bus})'  class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2 w-full sm:w-[100px]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 mr-1">
                        <path d="M3 6h18"></path>
                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                    </svg>
                    Delete
                </button>
            </div>
        </td>`;

    busesTable.appendChild(trTable);
}

function onEditBtnRoute(id) {
    idItemUpdate = id;

    // get data route admin wants to update by id
    let busEdit = buses.find((item) => item.number_bus === id);
    //change  btnForm To Become Update
    btnForm.textContent = 'Update';
    // fill data route to inputs to update it
    capasityInput.value = busEdit.capacity;
    costKmInput.value = busEdit.cost_per_km;
    fillInputsWithUpdate(CompanyInput, busEdit)
}




// on click BtnForm
async function onBtnFormClick() {

    //validation inputs
    if (CompanyInput.value.trim() === '') {
        return error_msg.textContent = 'company is Required'
    }
    if (capasityInput.value.trim() === '') {
        return error_msg.textContent = 'capasity is Required'
    }
    if (costKmInput.value.trim() === '') {
        return error_msg.textContent = 'cost per Km is Required'
    }





    //create formdata to send it to server
    const formData = new FormData();
    formData.append('companyID', CompanyInput.value);
    formData.append('capacity', capasityInput.value);
    formData.append('cost_per_km', costKmInput.value);


    if (btnForm.textContent === 'Update') {
        if (idItemUpdate === null) return error_msg.textContent = 'chose item first'


        try {
            console.log('update')
            let routePromise = await fetch(`${API_BASE_URL}?action=update&id=${idItemUpdate}`, {
                method: 'POST',

                body: formData,
            });



            let response = await routePromise.json();
            console.log(response);
            console.log('update');
            onLoadBuildTable();

            clearForm()
            //change  btnForm To Become create
            btnForm.textContent = 'Create'
        } catch (error) {
            console.log('update')
            console.error(error);
        }


    } else {

        console.log('create')
        try {
            let routePromise = await fetch(`${API_BASE_URL}?action=create`, {
                method: 'POST',

                body: formData,
            });



            let response = await routePromise.json();
            console.log(response);

            onLoadBuildTable();
            clearForm()
            btnForm.textContent = 'Create'
        } catch (error) {
            console.error(error);
        }

        console.log('create')
    }
}

function clearForm() {
    CompanyInput.value = '';
    capasityInput.value = '';
    costKmInput.value = '';
    idItemUpdate = null;
}

function fillInputsWithUpdate(selectElement, optionValue) {
    const option = document.createElement('option');
    option.value = optionValue.companyID;
    option.text = optionValue.companyName;
    option.selected = true;
    selectElement.appendChild(option);
}
