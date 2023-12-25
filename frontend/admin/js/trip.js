

const API_BASE_URL = 'http://localhost/travel/backend/trip.php';
const Image_BASE_URL = 'http://localhost/travel/backend/';

// DOM elements
const btnForm = document.getElementById('btnForm');
const tripsTable = document.getElementById('tripsTable');
const departure_timeInput = document.getElementById('departure_time');
const busInput = document.getElementById('bus');
const routeInput = document.getElementById('route');
const seatsInput = document.getElementById('seats');
// let timeOfDayInput = document.getElementById('timeOfDay');
const timeOfDayInput = document.querySelectorAll('input[name="timeOfDay"]')
let arriveTimeInput = null;



const error_msg = document.getElementById('error_msg');

let trips = [];
let idItemUpdate = null;



//automaticly build table when dom load
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
        const tripPromise = await fetch(API_BASE_URL);
        const data = await tripPromise.json();
        trips = data;


        tripsTable.innerHTML = '';
        data.forEach(trip => buildTable(tripsTable, trip));

    } catch (error) {
        console.error("Error fetching buses:", error);
    }
}


//this function for item in tables 
//required:table body and data 
function buildTable(tripsTable, data) {



    //$@desc : get start time and arrive time by add destination time to start date 
    //convert time from string to Date Type
    const startDateTimeString = new Date(data.departure_time);

    const arrivalDateTime = new Date(startDateTimeString.getTime() + data.distance_minute * 60000)

        .toISOString().replace("T", " ").slice(0, -8);




    const trTable = document.createElement('tr');

    trTable.classList = 'border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted';
    trTable.innerHTML = `
        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 font-medium">${data.departure_time.replace("T", " ")}</td>
        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 font-medium">${arrivalDateTime}</td>
        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 font-medium">${data.number_bus}</td>
        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 font-medium">${data.seats_available}/${data.capacity}</td>
        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 font-medium">${data.departure} -> ${data.destination}</td>
        <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0 font-medium">${data.timeOfDay}</td>



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
                </button>
            </div>
        </td>`;

    tripsTable.appendChild(trTable);
}

function onEditBtnRoute(id) {
    idItemUpdate = id; // save id item want update it to use it in update function

    // get data route admin wants to update by id
    let trip = trips.find((item) => item.id === id);
    //change  btnForm To Become Update
    btnForm.textContent = 'Update';

    // fill data route to inputs to update it
    const formattedDatetime = trip.departure_time.slice(0, 16);
    departure_timeInput.value = formattedDatetime;

    busInput.value = trip.number_bus
    routeInput.value = trip.road_id
    seatsInput.value = trip.seats_available


    //loop thgouth radio time of day and give it chekced 
    const radioInputsTimes = document.querySelectorAll('input[name="timeOfDay"]');
    radioInputsTimes.forEach(input => {
        if (input.value === trip.timeOfDay) {
            input.checked = true;
        }
    });


}




// on click BtnForm
async function onBtnFormClick() {

    // validation inputs
    if (departure_timeInput.value.trim() === '') {
        return error_msg.textContent = 'departure_timeInput is Required'
    }
    if (seatsInput.value.trim() === '') {
        return error_msg.textContent = 'seatsInput is Required'
    }
    if (routeInput.value.trim() === '') {
        return error_msg.textContent = 'routeInput is Required'
    }
    if (busInput.value.trim() === '') {
        return error_msg.textContent = 'cbusInput is Required'
    }






    //create formdata to send it to server
    const formData = new FormData();
    timeOfDayInput.forEach((item) => {
        if (item.checked == true) return formData.append('timeOfDay', item.value);
    })


    formData.append('departure_time', departure_timeInput.value);
    // formData.append('arrive_time', null);
    formData.append('seats_available', seatsInput.value);
    formData.append('road_id', routeInput.value);
    formData.append('number_bus', busInput.value);


    //check if btn is updae so excute code update trip if not create
    if (btnForm.textContent === 'Update') {
        if (idItemUpdate === null) return error_msg.textContent = 'chose item first'


        try {
            console.log('update')
            let tripPromise = await fetch(`${API_BASE_URL}?action=update&id=${idItemUpdate}`, {
                method: 'POST',

                body: formData,
            });



            let response = await tripPromise.json();

            if (response.status == 200) {

                onLoadBuildTable();
                clearForm()
                //change  btnForm To Become create
                btnForm.textContent = 'Create'
                error_msg.textContent = ''
                return;
            } else if (response.status == 500) {
                error_msg.textContent = response.message
                return;
            }
            else if (response.status == 401) {
                error_msg.textContent = response.message
                return;
            }
            else if (response.status == 402) {
                error_msg.textContent = response.message
                return;
            }

        } catch (error) {
            error_msg.textContent = error

        }


    } else {

        console.log('create')
        try {
            let tripPromise = await fetch(`${API_BASE_URL}?action=create`, {
                method: 'POST',

                body: formData,
            });



            let response = await tripPromise.json();
            if (response.status == 201) {

                onLoadBuildTable();
                clearForm()
                //change  btnForm To Become create
                btnForm.textContent = 'Create'
                error_msg.textContent = ''
                return;
            } else if (response.status == 500) {
                error_msg.textContent = response.message
                return;
            }
            else if (response.status == 401) {
                error_msg.textContent = response.message
                return;
            }
            else if (response.status == 402) {
                error_msg.textContent = response.message
                return;
            }
        } catch (error) {
            error_msg.textContent = error

        }

        console.log('create')
    }
}

function clearForm() {
    document.getElementById('form').reset();
    idItemUpdate = null;
}

function fillInputsWithUpdate(selectElement, optionValue) {
    const option = document.createElement('option');
    option.value = optionValue.companyID;
    option.text = optionValue.companyName;
    option.selected = true;
    selectElement.appendChild(option);
}


getCurrentDateTime()
//this funcyion for limit user date he can't choose yesterday
function getCurrentDateTime() {
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0'); // Months are zero-based
    const day = String(now.getDate()).padStart(2, '0');
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');

    departure_timeInput.min = `${year}-${month}-${day}T${hours}:${minutes}`

}