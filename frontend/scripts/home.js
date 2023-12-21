document.addEventListener('DOMContentLoaded', async function () {


    const departure = document.getElementById('departure');
    const destination = document.getElementById('destination');
    //fetching cities and display it 
    let citiesPromise = await fetch('cities.json');
    const data = await citiesPromise.json();

    data.forEach(city => {

        const optionForDeparture = document.createElement('option');
        optionForDeparture.value = city.city;
        optionForDeparture.text = city.city;
        departure.appendChild(optionForDeparture);


        const optionForDestination = document.createElement('option');
        optionForDestination.value = city.city;
        optionForDestination.text = city.city;
        destination.appendChild(optionForDestination);
    });





    // animation for bus
    let busImg = document.getElementById('bus_img');

    let currentRight = parseFloat(getComputedStyle(busImg).right);

    let speed = busImg.style.right;

    function animateBus() {

        let newRight = (currentRight === 0) ? '100%' : 0;

        // Apply the new right value
        busImg.style.right = newRight;
    }


    setInterval(animateBus, 2000);


    // get inputs
    const findTripBtn = document.getElementById('findTripBtn')
    findTripBtn.addEventListener('click', onSubmit)
    function onSubmit() {

        const departureValue = departure.value.toString();
        const destinationValue = destination.value.toString();
        const date = document.getElementById('date').value;

        const error_msg = document.getElementById('error_msg');

        console.log(departureValue)
        console.log(destinationValue)
        console.log(date)
        if (destinationValue === "") {
            error_msg.textContent = "Please Select destination";
            return;
        }

        if (departureValue === "") {
            error_msg.textContent = "Please Select departure.";
            return;
        }
        if (date === "") {
            error_msg.textContent = "Please Select date.";
            return;
        }

        const queryParams = new URLSearchParams({
            date: date,
            departure: departureValue,
            destination: destinationValue
        }).toString();
    
        // Redirect to another page with the query parameters
        const redirectUrl = `Research.php?${queryParams}`;
        window.location.href = redirectUrl;
    }




});










