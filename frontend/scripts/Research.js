document.addEventListener('DOMContentLoaded', async function () {



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



    const orderBy = document.getElementById('orderBy')

    // Get query parameters from the URLl
    let urlParams = new URLSearchParams(window.location.search);
    let dateParam = urlParams.get('date');
    let departureParam = urlParams.get('departure');
    let destinationParam = urlParams.get('destination');
    let minPriceParam = urlParams.get('minPrice') || null;
    let maxPriceParam = urlParams.get('maxPrice') || null;
    let orderParam = urlParams.get('order') || null;
    orderParam = orderBy.checked == true ? orderBy.value : 'DESC';
    console.log(orderBy.checked)


    // Set default values in form inputs
    document.getElementById('departure').value = departureParam || '';
    document.getElementById('destination').value = destinationParam || '';
    document.getElementById('date').value = dateParam || '';


    /// filter
    orderBy.addEventListener('click', () => {
        orderParam = orderBy.value
        onSubmit()
    })


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

        if (orderBy.value !== null) {
            queryParams.set('order', orderBy.value);
        }


        // Update the URL without reloading the page
        history.pushState({}, '', '?' + queryParams.toString());



        // Fetch data with the updated URL 
        // buildUrl create url from query everytime
        try {
            const url = buildUrl();
            const response = await fetch(url);
            if (!response.ok) {
                throw new Error(`Network response was not ok: ${response.statusText}`);
            }
            const data = await response.json();
            console.log("Fetch successful. Data:", data);
            // Handle the data as needed
        } catch (error) {
            console.error("Fetch failed:", error);
            // Handle errors
        }
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


