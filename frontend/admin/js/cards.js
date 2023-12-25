document.addEventListener('DOMContentLoaded', onLoadBuildTable);

async function onLoadBuildTable() {
    const API_BASE_URL = 'http://localhost/travel/backend/status.php';
    const dataContainer = document.getElementById('dataContainer');

    try {
        const routePromise = await fetch(API_BASE_URL);
        const data = await routePromise.json();
        console.log(data);



        // Total Income
        createCard("Total Income", `$520.00`, "text-green-500");

        // Number of Trips
        createCard("Number of Trips", data.trip_status, "text-blue-500", "fa-suitcase-rolling");

        // Bus
        createCard("Bus", data.bus_status, "text-red-500", "fa-bus");

        // Routes
        createCard("Routes", data.road_status, "text-yellow-500", "fa-route");

    } catch (error) {
        console.error("Error fetching data:", error);
    }
}

function createCard(title, value, textColor, iconClass = "") {
    const card = document.createElement('div');
    card.className = 'rounded-lg border bg-card text-card-foreground shadow-sm hover:shadow-lg transition-all duration-200';
    card.setAttribute('data-v0-t', 'card');

    const innerDiv1 = document.createElement('div');
    innerDiv1.className = 'flex flex-col space-y-1.5 p-6';

    const h3 = document.createElement('h3');
    h3.className = 'text-2xl font-semibold leading-none tracking-tight';
    h3.textContent = title;

    innerDiv1.appendChild(h3);

    const innerDiv2 = document.createElement('div');
    innerDiv2.className = 'p-6 flex items-center justify-between';

    if (iconClass) {
        const icon = document.createElement('i');
        icon.className = `fa-solid ${iconClass} ${textColor}`;
        innerDiv2.appendChild(icon);
    }

    const span = document.createElement('span');
    span.className = 'text-4xl font-semibold';
    span.textContent = value;

    innerDiv2.appendChild(span);

    card.appendChild(innerDiv1);
    card.appendChild(innerDiv2);

    document.getElementById('dataContainer').appendChild(card);
}