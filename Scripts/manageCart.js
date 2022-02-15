/*
    Author: Will Corkill
    Name: loadCart.js
    Last Accessed: 13/01/2022
    Description: Manipulate the DOM to display all products in the cart.
*/
const prices = {Hoodie: "£39.99", Jumper: "£29.99", Tshirt: "£19.99"};
var rowId = 0;
var tableContainer; // A variable made to be updated, as the page needs to be loaded before using document based functions.
function parseValue(localStorageValue) 
{ // Used to split the value up into different elements in an array.
    return localStorageValue.split(',');
}

function addToCart(productType, productColour) {
    // Function to be written for adding to the cart
    const numberOfKeys = Object.keys(localStorage).length;
    localStorage.setItem(`item${numberOfKeys+1}`, `${productType},${productColour}`); // The item in the local storage is assigned to be used on cart.html and loadCart.js
    alert(`${productColour} ${productType} has been added to your cart.`); // Show an alert informing the user of the addition to their cart.
}
function removeFromCart(containerId, itemIdentifier) 
{
    localStorage.removeItem(itemIdentifier); // Remove the item from localStorage
    const container = document.getElementById(containerId);
    container.remove(); // Remove the item from cart.html
}

function createRow(itemKey, localStorageValue) 
{
    // Gather all information needed to create the row in the list.
    const productInfo = parseValue(localStorageValue); // Split the value into two separate values in an array
    const productType = productInfo[0]; // Index the array of values to ascertain the product type and product colour
    const productColour = productInfo[1];
    // Create the container for the row
    const rowContainer = document.createElement("div");
    rowContainer.className = "row";
    rowContainer.id = `row${rowId}`;
    // Create item identifier to be presented to the user
    const itemIdentifier = document.createElement("p");
    itemIdentifier.textContent = itemKey.slice(-1); // Index the final character in the itemKey
    rowContainer.appendChild(itemIdentifier);
    // Show the user an image
    const itemImage = document.createElement("img");
    itemImage.src = `../Images/${productType}/${productColour.replaceAll(" ", "%20")}.jpg`; // (JavaScriptTutorial, n.d.) regarding replaceAll function
    itemImage.alt = `Photo of a ${productColour} ${productType}`;
    rowContainer.appendChild(itemImage);
    // Show the product name
    const itemName = document.createElement("p");
    itemName.textContent = `${productColour} ${productType}`;
    rowContainer.appendChild(itemName);
    // Show the product price
    const itemPrice = document.createElement("p");
    itemPrice.textContent = `${prices[productType]}`;
    rowContainer.appendChild(itemPrice);
    // Create a remove button
    const removeContainer = document.createElement("div");
    removeContainer.className = "removeContainer";
    rowContainer.appendChild(removeContainer);
    const removeItem = document.createElement("button");
    removeItem.textContent = "Remove";
    removeItem.setAttribute(`onclick` ,`removeFromCart("row${rowId}", "${itemKey}")`);
    removeContainer.appendChild(removeItem);
    // Add the container to the table
    rowId++; // Increment the value of rowId
    tableContainer.appendChild(rowContainer);
}

/*window.addEventListener("load", function() {
    tableContainer = document.getElementById("table");
    const storageKeys = Object.keys(localStorage).sort(); // Sort the keys into alphabetical order
    if (storageKeys.length < 1) // If there are no items in the cart
    {
        const noItemsNotifier = document.createElement("p");
        noItemsNotifier.setAttribute("class", "noItems");
        noItemsNotifier.innerHTML = "There are no items in your cart!";
        tableContainer.append(noItemsNotifier);
    }
    else
    { // If there are one or more items in the cart
        for (const key in storageKeys) 
        {
            const itemKey = storageKeys[key];
            const itemValue = localStorage.getItem(itemKey);
            createRow(itemKey, itemValue);
        }
    }
});*/