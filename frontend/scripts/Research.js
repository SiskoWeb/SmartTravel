document.addEventListener('DOMContentLoaded', async function () {

    //after page loaded get all querys and fetch data with i
    const urlParams = new URLSearchParams(window.location.search);


    const dateParam = urlParams.get('date');
    const departureParam = urlParams.get('departure');
    const destinationParam = urlParams.get('destination');
    const minPriceParam = urlParams.get('minPrice') ?? null;
    const maxPriceParam = urlParams.get('maxPrice') ?? null;
    const orderParam = urlParams.get('order') ?? null;

    const url = `http://localhost/travel/backend/trip.php?action=filter&date=${dateParam}&departure=${departureParam}&destination=${destinationParam}&minPrice=${minPriceParam}&maxPrice=${maxPriceParam}&order=${orderParam}`;

    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Network response was not ok: ${response.statusText}`);
            }
            return response.json(); // or response.text() or response.blob() based on the expected response type
        })
        .then(data => {
            console.log("Fetch successful. Data:", data);
            // Handle the data as needed
        })
        .catch(error => {
            console.error("Fetch failed:", error);
            // Handle errors
        });
})