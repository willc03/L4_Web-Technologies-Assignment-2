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

function addToCart(productType, productColour, productID) {
    // Function to be written for adding to the cart
    const numberOfKeys = Object.keys(localStorage).length;
    localStorage.setItem(`UCLan_Item${numberOfKeys+1}`, `${productID}`); // The item in the local storage is assigned to be used on cart.html and loadCart.js
    alert(`${productColour} ${productType} has been added to your cart.`); // Show an alert informing the user of the addition to their cart.
}
function removeFromCart(containerId, itemIdentifier) 
{
    localStorage.removeItem(itemIdentifier); // Remove the item from localStorage
    const container = document.getElementById(containerId);
    container.remove(); // Remove the item from cart.html
}

function SendCartItemToServer(container, product_id, localStorageKey) {
    var XmlHttp = new XMLHttpRequest();
    XmlHttp.open("POST", "../Scripts/Server/AddProductToPage.php", false)
    XmlHttp.onload = function() {
        container.innerHTML += this.responseText;
    }
    XmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // Allow to send post request such as in a form
    XmlHttp.send(`product_id=${product_id}&localStorageKey=${localStorageKey}`);
}

function performCheckout() {
    var countItems = 0;
    var itemPostString = "orderItems=";
    const storageKeys = Object.keys(localStorage).sort(); // Sort the keys into alphabetical order
    for (const key in storageKeys) 
    {
        const itemKey = storageKeys[key];
        if (itemKey.search("UCLan") != -1)
        {
            countItems++;
            itemPostString += String(localStorage.getItem(itemKey)) + "+";
        }
    }
    // Submit information to the web server for database changes
    if (countItems > 0)
    {
        itemPostString = itemPostString.slice(0, -1);
        var XmlHttp = new XMLHttpRequest();
        XmlHttp.open("POST", "../Scripts/Server/Checkout.php", true)
        XmlHttp.onload = function() {
            if (this.responseText == "success")
            {
                alert("Your purchase has been successful, thank you for shopping with the UCLan Student's Union.");
                localStorage.clear();
                window.location.reload();
            }
            else
            {
                alert("Your purchase was unsuccessful, please try again later");
            }
        }
        XmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // Allow to send post request such as in a form
        console.log(itemPostString)
        XmlHttp.send(itemPostString);
    }
    else
    {
        alert("There are no items in your cart! Please visit our products page to our products page to add items to your cart.");
    }
}

window.addEventListener("load", function() {
    tableContainer = document.getElementById("table");
    if (tableContainer)
    {
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
                if (itemKey.search("UCLan") != -1)
                {
                    SendCartItemToServer(tableContainer, localStorage.getItem(itemKey), itemKey);
                }
            }
        }
    }

});