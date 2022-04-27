/*
    Author: Will Corkill
    Name: navigation.js
    Description: Manipulate the DOM to toggle the menu display, move navigation based on screen size.
*/
var isWindowLoaded = false; // Explained on line 29
window.addEventListener("load", function() {
    isWindowLoaded = true;
    const mediaQuery = window.matchMedia("(max-width: 480px)"); // (Ilik, 2020) regarding media queries
    const navigationElement = document.getElementById("navigation"); // Define the necessary elements for the page
    const mobileNavigationContainer = document.getElementById("mobileNavigationContainer");
    const headerContainer = document.getElementById("header");
    function onMediaQueryStatusChange(event) { // Define the function for the media query change listener
        if (event.matches) { // Check if the criteria defined are met
            mobileNavigationContainer.appendChild(navigationElement); // Move the navigation to the mobile container
        } else {
            headerContainer.appendChild(navigationElement); // Move the container back to the header
        }
    }
    mediaQuery.addEventListener("change", onMediaQueryStatusChange); // Connect the listener - (Hamid, 2021) regarding deprecated functions
    onMediaQueryStatusChange(mediaQuery) // Run the listener when the page loads to ensure continuity. 
});

var isVisible = false; // The menu will not be visible by default.
function onMenuMouseDown() {
    if (!isWindowLoaded) {
        return; // Stops the function from running if the window isn't loaded
    }
    if (!isVisible) {
        document.getElementById("navigation").style.display = "flex";
        // Flexbox is used to allow the space-around content justification to be used.
    } else {
        document.getElementById("navigation").removeAttribute("style"); /*
        All styling is removed as DOM-based CSS manipulations are placed inline, as opposed to inside the
        external stylesheet. Inline CSS takes priority over external sheets, so this must be removed such
        that  the  display  is  not  affected by the value when the screen is larger than a mobile device.
        */
    }
    isVisible = !isVisible; // The equivalent of using a NOT gate to flip the value of a Boolean.
}