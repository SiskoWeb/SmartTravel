// document.addEventListener('DOMContentLoaded', async function () {
//     // Get all radio buttons with the name 'time'
//     const minPriceInput = document.getElementById('minPrice');
//     const maxPriceInput = document.getElementById('maxPrice');

//     const onInputMaxPriceChangeDebounced = debounce(onSubmit, 500);
//     const onInputMinPriceChangeDebounced = debounce(onSubmit, 500);

//     maxPriceInput.addEventListener('change', () => {

//         maxPriceParam = maxPriceInput.value
//         onInputMaxPriceChangeDebounced()
//     })


//     minPriceInput.addEventListener('change', () => {

//         minPriceParam = minPriceInput.value
//         onInputMinPriceChangeDebounced()
//     })




//     // this is for sorting
//     const orderByBtn = document.getElementById('orderBy');
//     // Add event listener to each radio button
//     orderByBtn.addEventListener('change', () => {
//         orderParam = orderByBtn.value
//         onSubmit()
//     })



// })