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
    localStorage.setItem(`UCLan_Item${numberOfKeys+1}`, `${productType},${productColour}`); // The item in the local storage is assigned to be used on cart.html and loadCart.js
    alert(`${productColour} ${productType} has been added to your cart.`); // Show an alert informing the user of the addition to their cart.
}
function removeFromCart(containerId, itemIdentifier) 
{
    localStorage.removeItem(itemIdentifier); // Remove the item from localStorage
    const container = document.getElementById(containerId);
    container.remove(); // Remove the item from cart.html
}

function SendCartItemToServer(container, product_type, product_colour, localStorageKey) {
    var XmlHttp = new XMLHttpRequest();
    XmlHttp.onreadystatechange = function() {
    }
    XmlHttp.open("POST", "../Scripts/Server/AddProductToPage.php", false)
    XmlHttp.onload = function() {
        container.innerHTML += this.responseText;
    }
    XmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // Allow to send post request such as in a form
    XmlHttp.send(`product_type=${product_type}&product_colour=${product_colour}&localStorageKey=${localStorageKey}`);
}

window.addEventListener("load", function() {
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
            console.log(itemKey.search("UCLan"));
            if (itemKey.search("UCLan") != -1)
            {
                const itemValue = localStorage.getItem(itemKey);
                const productInfo = parseValue(itemValue)
                SendCartItemToServer(tableContainer, productInfo[0], productInfo[1], itemKey);
            }
        }
    }
});