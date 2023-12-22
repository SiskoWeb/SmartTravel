document.addEventListener('DOMContentLoaded', async function () {
    const loader = document.getElementById('loader')
    loader.classList.replace("hidden", "flex")

    const tripsData = [];









    // Fetch cities and populate the dropdowns
    try {
        let departure = document.getElementById('departure');
        let destination = document.getElementById('destination');
        let citiesPromise = await fetch('cities.json');
        let data = await citiesPromise.json();

        data.forEach(city => {
            // loop through list cities and add it as option
            addOptionToSelect(departure, city.city);
            addOptionToSelect(destination, city.city);
        });
    } catch (error) {
        console.error("Error fetching cities:", error);
    }





    // Get query parameters from the URLl
    let urlParams = new URLSearchParams(window.location.search);
    let dateParam = urlParams.get('date');
    let departureParam = urlParams.get('departure');
    let destinationParam = urlParams.get('destination');
    let minPriceParam = urlParams.get('minPrice') || null;
    let maxPriceParam = urlParams.get('maxPrice') || null;
    let orderParam = urlParams.get('order') || null;
    let timeParam = urlParams.get('time') || null;





    // Set default values in form inputs
    document.getElementById('departure').value = departureParam || '';
    document.getElementById('destination').value = destinationParam || '';
    document.getElementById('date').value = dateParam || '';


    // const orderBy = document.getElementById('orderBy')
    // const schedulesCheckBox = document.getElementById('schedules')

    // /// filter when user clikc sorted 
    // orderBy.addEventListener('click', () => {
    //     if (orderBy.checked) {
    //         orderParam = orderBy.value
    //     } else {
    //         orderParam = 'DESC'
    //     }

    //     onSubmit()
    // })



    // // filter by Schedules
    // schedulesCheckBox.addEventListener('click', () => {
    //     if (schedulesCheckBox.checked) {
    //         timeParam = schedulesCheckBox.value
    //     } else {
    //         timeParam = 'morning'
    //     }

    //     onSubmit()
    // })



    // function to build the URL based on the form inputs
    function buildUrl() {
        const queryParams = new URLSearchParams({
            date: document.getElementById('date').value,
            departure: departure.value,
            destination: destination.value,

        });
        if (minPriceParam !== null) {
            queryParams.set('minPrice', minPriceParam);
        }

        if (maxPriceParam !== null) {
            queryParams.set('maxPrice', maxPriceParam);
        }




        if (orderParam !== null) {
            queryParams.set('order', orderParam);
        }

        if (timeParam !== null) {
            queryParams.set('time', timeParam);
        }




        // Update the URL without reloading the page
        // history.pushState({}, '', '?' + queryParams.toString());
        return `http://localhost/travel/backend/trip.php?action=filter&${queryParams.toString()}`;
    }




    // Fetch data when the page loads
    try {

        const url = buildUrl();
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Network response was not ok: ${response.statusText}`);
        }
        const data = await response.json();
        console.log("Initial fetch successful. Data:", data);
        builderTrips(data)
        loader.classList.replace("flex", "hidden")
        // Handle the data as needed
    } catch (error) {
        console.error("Initial fetch failed:", error);
        // Handle errors

    }




    // Event listener for "Find Trip"  brn
    const findTripBtn = document.getElementById('findTripBtn')
    findTripBtn.addEventListener('click', onSubmit);

    async function onSubmit() {

        const departureValue = departure.value.trim();
        const destinationValue = destination.value.trim();
        const date = document.getElementById('date').value.trim();

        const error_msg = document.getElementById('error_msg');

        // send inputs to validat it
        if (!validateInputs(departureValue, destinationValue, date, error_msg)) {
            return;
        }
        const queryParams = new URLSearchParams({
            date: document.getElementById('date').value,
            departure: departure.value,
            destination: destination.value,

        });
        if (minPriceParam !== null) {
            queryParams.set('minPrice', minPriceParam);
        }

        if (maxPriceParam !== null) {
            queryParams.set('maxPrice', maxPriceParam);
        }

        if (maxPriceParam !== null) {
            queryParams.set('maxPrice', maxPriceParam);
        }
        // if (orderBy.value !== null) {
        //     queryParams.set('order', orderBy.value);
        // }

        // if (schedulesCheckBox.value !== null) {
        //     queryParams.set('time', schedulesCheckBox.value);
        // }

        if (timeParam !== null) {
            queryParams.set('time', timeParam);
        }
        // Update the URL without reloading the page
        history.pushState({}, '', '?' + queryParams.toString());


        loader.classList.replace("hidden", "flex")
        // Fetch data with the updated URL 
        // buildUrl create url from query everytime
        try {
            // loader.classList.add('hidden')
            const url = buildUrl();
            const response = await fetch(url);
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

            // Handle errors
        }

    }










    // Get all radio buttons with the name 'time'
    const timeRadioButtons = document.querySelectorAll('input[name="time"]');

    // Add event listener to each radio button
    timeRadioButtons.forEach((radioButton) => {
        radioButton.addEventListener('change', function () {
            // Uncheck all other radio buttons when a radio button is checked
            timeRadioButtons.forEach((otherRadioButton) => {
                if (otherRadioButton !== radioButton) {
                    otherRadioButton.checked = false;
                }
            });
            if (radioButton.checked && radioButton.value !== 'all') {
                timeParam = radioButton.value
            } else {
                timeParam = null
            }

            onSubmit()
        });
    });




    //this function required arry of trips
    // rebuild list of trip filter change or page load first time
    function builderTrips(data) {

        const card_trips = document.getElementById('card_trips')

        card_trips.innerHTML = ''
        //loop through data trips
        data.forEach((trip) => {
            const tripElement = document.createElement('div')
            tripElement.classList = 'bg-white w-full  h-auto rounded-md p-4 mx-auto';

            // cardTrip fun return html 
            tripElement.innerHTML = cardTrip(trip)
            card_trips.appendChild(tripElement)
        })
    }





    // function to add an option <citeis> to a select element
    function addOptionToSelect(selectElement, optionValue) {
        const option = document.createElement('option');
        option.value = optionValue;
        option.text = optionValue;
        selectElement.appendChild(option);
    }



    // function for input validation
    function validateInputs(departure, destination, date, error_msg) {
        if (destination === "") {
            error_msg.textContent = "Please Select destination";
            return false;
        }
        if (departure === "") {
            error_msg.textContent = "Please Select departure.";
            return false;
        }
        if (date === "") {
            error_msg.textContent = "Please Select date.";
            return false;
        }
        return true;
    }
});










// this responsible to edit html 
//by add data to it and return it to main func <builderTrips>

function cardTrip(trip) {
    return `
    <div id="ticket-wrapper2" class=" flex  gap-x-2 p-4 flex-col lg:flex-row mx-auto justify-between  lg:h-[80%] items-center " >
    <div class=" ticket-wrapper-info flex-col lg:justify-between justify-center items-center gap-y-6 ">
      <h3 class="font-bold text-lg  leading-7 text-[#424248]"> ${trip.road_departure} - ${trip.road_destination}</h3>
    <img src="http://localhost/travel/backend/${trip.company_image}" class=" w-auto h-28 bg-cover bg-center">
    
    </div>
    <div class="ticket-wrapper-cities flex justify-between gap-x-4  items-center">
        
    <div>
        <h4 class="font-semibold text-lg  leading-7 text-[#424248]">08:00 AM</h4>
        <p>${trip.road_departure}</p>
    </div>
    
    <div class="text-center ">
    <i class="fa-solid fa-arrow-right-long text-green-700"></i>
        <p>${trip.road_distance_minute} min</p>
    </div>
    
    <div>
        <h4 class="font-semibold text-lg  leading-7 text-[#424248]">04:30 PM</h4>
        <p>${trip.road_destination}</p>
    </div>
    
    </div>
    <div class="ticket-wrapper-price text-center flex flex-col gap-4">
        <h3 class="text-green-600 text-bold text-2xl">$${trip.price}</h3>
    
    
       <button   class="w-full bg-[#0E9E4D] hover:bg-green-600 text-white font-medium py-2 px-4 rounded-lg focus:outline-none">Select Seat</button>
    
    </div>
    </div>
    <hr>
    <div class="flex  gap-x-2 p-4 mx-auto justify-start basis-4/6 items-center">
        <p class="font-bold text-[#777]">Facilities-</p> <span class="bg-[#f7f7f7] text-[#777] p-1 rounded-sn">Water Bottle</span>
         <span class="bg-[#f7f7f7] text-[#777] p-1 rounded-md">Pillow</span>
         <span class="bg-[#f7f7f7] text-[#777] p-1 rounded-md">Wifi</span>
    </div>`
}