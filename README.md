# Web Technologies
## Assignment One - Responsive Web Application
The assignment entails the creation of an online shop for the UCLan Student's Union.

>The assignment is due **19th January 2022**. 
## The Brief
The brief provides an additional file, the design requirements, which contains most of the information about the assignment.

The design requirements state that the following must apply to the assessment response:

### Form (Design)
 - [x] The website contains the logo on all views
 - [x] The application is given a name
 - [x] Provide a navigational menu to access all views within the application
 - [x] Follow the University's brand guidelines for primary colours palette *see Figure One*.
 - [x] Use the primary colour for main branding of the application *#BE1622*
 - [x] *#007FB0* for hyperlinks
 - [x] *#34516C* for secondary elements (such as the sidebar and footer)
 - [x] Use secondary colours (hex) appropriately throughout the rest of the application *see Figure One*.
 - [x] Apply a sans-serif typeface throughout the application

### Function (Implementation)

 - [x] The website should contain four views, index.html, products.html, cart.html, and item.html
 - [x] The item.html should only be accessible through clicking an item on the products view.
 - [x] All products should be available on the products.html page
 - [x] There should be a video in the form of an embedded YouTube iFrame.
 - [x] Contain a README file outlining what webpages have been implemented and the operation of each page.
 - [x] Pass any HTML and CSS validation checks

### Optional Extras

 - [x] Present functionality to click on a product for more details
 - [x] Provide functionality to browse products by using anchor tags to jump to parts of the webpage
 - [x] Enable users to add items to the shopping cart
 - [x] Provide functionality to view the shopping cart with items added.

 ## The Marking Scheme
 There is a banded marking scheme, the criteria below is used as a guide with academic judgement to determine a grade
 

 - Design and evaluate appropriate user interfaces for front-end web applications - Wireframing with annotations overlaid
 - Develop a front-end web application using modern development environments - web application implementation (detailed breakdown below)
 - Justify a choice of interaction methods and identify appropriate contexts of use for web applications - questions in demo regarding responsive web design
 - Demonstrate an awareness of current industry standards including those related to security, accessibility, and the design and development of web applications - questions in demo regarding HTML5 API (local/sessionStorage), web front-end frameworks etc...

## Front-End Marking Scheme
| Requirement | 3rd Class | 2:2 Class | 2:1 Class | 1st Class | Completed
| -- | -- | -- | -- | -- | -- |
| Follows brief | / | / | / | / | Yes |
| Wireframe | / | / | / | / | Yes |
| Applies HTML appropriately | / | / | / | / | Yes |
| External CSS styling applied consistently | / | / | / | / | Yes |
| Method to navigate in view | / | / | / | / | Yes |
| Written a file in markdown following the design brief requirements | / | / | / | / | Yes |
| Demo in lab and ability to answer questions to satisfactory standard | / | / | / | / | N/A |
| HTML and CSS pass validation without errors | / | / | / | / | Yes |
| iFrame embedded to display YouTube video | / | / | / | / | Yes |
| Clean and commented code | / | / | / | / | Yes |
| Responsive design considerations |  | / | / | / | Yes |
| Clear navigation |  | / | / | / | Yes |
| Best practice for CSS |  | / | / | / | Yes |
| Manipulating the DOM |  |  | / | / | Yes |
| Advanced responsive design considerations |  |  | / | / | Yes |
| HTML5 semantic elements |  |  | / | / | Yes |
| Basic implementation of the shopping cart |  |  | / | / | Yes |
| HTML5 API integration |  |  |  | / | Yes |
| Extended feature to the shopping cart |  |  |  | / | Yes |
| No significant accessibility flaws |  |  |  | / | Yes |
| A professional looking prototype with no significant usability flaws |  |  |  | / | Yes |
| The adoption of version control with regular, quality commits to demonstrate progress |  |  |  | / | Yes |

# Assessment Response
## index.html
The *index.html* page was the first page to be implemented. This served as the framework for designing the header and footer.
> The header and footer would later be added to all pages, once designing was finished.

The page primarily shows a title, heading, an introduction to the website, and the embedded YouTube video, in the form of an iFrame.
> The page was styled using global.css and index.css
> The script(s) on this page are: navigation.js
>  
>  Please note that the YouTube iFrame may include the importation of additional scripts from YouTube.

## products.html
The *products.html* page was designed to show the user all of the available products. Users can use this page to add to the cart by pressing the 'Buy' button.
> Users can press 'Read more...' to access the item.html page

The use of JavaScript on this page was essential to its function, all of the products visible on the page were added using a custom-written JavaScript function, which created the container for each product, as well as the content.
> 'Content' is an image, price, description, colour, and product type.

The user can press the circular 'Top' button, which will use JavaScript to scroll to the top of the page.

An Object was created to store the information as efficiently as possible.

> CSS was also heavily used on this page, classes and IDs were used to allow specific targeting of elements, and pseudo-classes such as :hover and :first-of-type were used to better style the web page.
> 
> The page is styled using global.css and products.css
> The script(s) on this page are: navigation.js, loadProducts.js

## item.html
The *item.html* page is accessible only through the products page, and displays one item in greater detail, this page is incredibly alike the products.html page.

The same JavaScript scripts are used on item.html as products.html
> Some code was added to the loadProducts.js to ensure the loading process for item.html is as streamlined as possible, without unnecessarily adding additional files.

> This page is styled using global.css and item.css
> The script(s) on this page are: navigation.js, loadProducts.js

## cart.html
The final page of the website, *cart.html*, is used to display the products that the user has added to their cart. A table has been used to show this in an easy way.

JavaScript was used to retrieve the localStorage and display this information to the user.
> This page is styled using global.css and cart.css
> The script(s) on this page are: navigation.js, loadCart.js

## Other
- The global.css file is applied on every page, and this is used to style the body, header, and footer.
- The buttons have custom styling that is consistent with the colour palette in the front-end marking scheme
- A wireframe is included in the root folder.
- The footer contains a href to the UCLan Student's Union
	- The footer contains a mailto href to open the user's web client to the Student Union email.
	- The footer contains a tel href to open the user's phone client to phone the UCLan Student's Union
- The application is given the name "UCLan Student's Union Shop"

# References / Bibliography
Coyier, C. (2016) Sticky Footer, Five Ways | CSS-Tricks - CSS-Tricks [Online]. Available at: https://css-tricks.com/couple-takes-sticky-footer/ [Accessed 26 December 2021].

Edpresso Team. (n.d.) How to add a line-break using CSS. [Online]. Available at: https://www.educative.io/edpresso/how-to-add-a-line-break-using-css */ [Accessed 17 November 2021].

Hamid, D. (2021) JavaScript matchMedia().addListener() Alternative - Designcise [Online]. Available at: https://www.designcise.com/web/tutorial/what-is-the-substitute-for-the-deprecated-matchmedia-addlistener-method [Accessed 12 January 2022].

Ilik, M. (2020) Working with JavaScript Media Queries [Online]. Available at: https://css-tricks.com/working-with-javascript-media-queries/ [Accessed 12 January 2022].

JavaScripter. (2011) JavaScript: window title [Online]. Available at: http://www.javascripter.net/faq/windowti.htm [Accessed 13 January 2022].

JavaScriptTutorial. (n.d.) How to Replace All Occurrences of a Substring in a String [Online]. Available at: https://www.javascripttutorial.net/string/javascript-string-replace-all/ [Accessed 29 December 2021].

Nikitha, N. (2018) How to use an image as a link in HTML? [Online]. Available at: https://www.tutorialspoint.com/How-to-use-an-image-as-a-link-in-HTML [Accessed 20 November 2021].

RapidTables. (n.d.) mailto: HTML email link [Online]. Available at: https://www.rapidtables.com/web/html/mailto.html [Accessed 12 December 2021].

W3Docs. (n.d.) How to Add Telephone Links with HTML [Online]. Available at: https://www.w3docs.com/snippets/html/how-to-add-telephone-links-with-html.html [Accessed 12 December 2021].

w3schools (n.d. a) CSS flex property [Online]. Available at: https://www.w3schools.com/cssref/css3_pr_flex.asp [Accessed 18 November 2021].

w3schools (n.d. b) onclick Event [Online]. Available at: https://www.w3schools.com/jsref/event_onclick.asp [Accessed 20 November 2021].

# Written by Will Corkill
Furness College Student ID: 40019692
Furness College Email: 40019692@student.furness.ac.uk

UCLan Student ID: G20973951
UCLan Email: WCorkill@uclan.ac.uk
