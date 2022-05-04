# Web Technologies
## Assignment Two - Server-side Implementation
The assignment focuses on the back-end implementation of a database which can connect to the front-end site.

>The assignment is due **27th April 2022**. 
## The Brief
The brief provides an additional file, the design requirements, which contains most of the information about the assignment.

The design requirements state that the following must apply to the assessment response:

### Function (Implementation)

 - [x] Communicate to a backend database service using PHP and MySQL
 - [x] Allow users to sign up to the shop in order to make purchases
 - [x] Provide latest offers from the database presented on the homepage of the web application
 - [x] Present the shop items from the database rather than statically hardcoded inside the HTML
 - [x] Contain a README file detailing any set up instructions (passwords for tutors to assess the work) and any decisions you've made you want the tutor to know which is evidenced in the demonstration

### Optional Extras

 - [x] Use sessions to detect when a user is logged in (in order to make purchases)
 - [x] Provide extra functionality to search for products in the shop (for example, using PHP to obtain a list of products, or searching for using text and presenting this information by updating the front-end using JS).
 - [x] Provide a personalised welcome message when a user is logged in
 - [x] Provide user friendly feedback (when a user log in is incorrect, adding items to a basket has a problem etc)
 - [x] Provide a user friendly 404 error page if a page is not available when accessed
 - [x] Provide a means to register new users to the shop
 - [x] Allow logged in users the functionality to leave reviews on products with average star rating and text messages
 - [x] Store passwords security by hashing and salting using the bcrypt mechanism
 - [x] Present dynamic information from the database responsively to meet the minimum requirements of the first assessment (responsive mobile design)
 - [x] Use passing of POST/GET variables to access product items rather than using the sessionStorage object as preferred in assessment 1

 ## The Marking Scheme
 There is a banded marking scheme, the criteria below is used as a guide with academic judgement to determine a grade

 - Develop an understanding of back-end development to build data driven web applications - using PHP to interface with the front-end and backend database service. 
 - Justify a choice of interaction methods and identify appropriate contexts of use for web applications - Questions in demo regarding backend web development 
 - Demonstrate an awareness of current industry standards including those related to security, accessibility, and the design and development of web applications - Questions in demo regarding HTML5, PHP and MySQL etc...

## Front-End Marking Scheme
| Requirement | 3rd Class | 2:2 Class | 2:1 Class | 1st Class | Completed
| -- | -- | -- | -- | -- | -- |
| Follows brief | / | / | / | / | Yes |
| All pages are defined with .php extension (where the PHP is either inside the HTML or as a separate file) | / | / | / | / | Yes |
| Communicates with a backend MySQL database using PHP | / | / | / | / | Yes |
| Provides login functionality | / | / | / | / | Yes |
| Provides live offers | / | / | / | / | Yes |
| Product items are stored in the database | / | / | / | / | Yes |
| Submission includes a README.md file | / | / | / | / | No |
| Uses sessions to detect logged in users |  | / | / | / | Yes |
| Basic browse product view |  | / | / | / | Yes |
| Provides a personalised greeting |  | / | / | / | Yes |
| Custom 404 error page |  | / | / | / | Yes |
| Neatly structured code |  | / | / | / | Yes |
| User registration |  |  | / | / | Yes |
| Calculated product reviews |  |  | / | / | Yes |
| Product information page |  |  | / | / | Yes |
| Submit/present reviews |  |  | / | / | Yes |
| Secure passwords |  |  | / | / | Yes |
| Dynamic content is responsive |  |  | / | / | Yes |
| Advanced products search |  |  |  | / | Yes |
| Checkout mechanism |  |  |  | / | Yes |
| Little/no bugs |  |  |  | / | Yes |
| Professional looking and functional web application |  |  |  | / | Yes |
| Extended functionality/presentation additional to the above criteria |  |  |  | / | Yes |

# Assessment Response
## Changes to the database
Various changes to the database have been made as the website has progressed in its building. 

Firstly, as each section of the website was developed, the names of the tables were changed from tbl_[table_name] to simply [table_name], this was purely for organisational purposes, to signify that this section of the database was either in progress or complete.
> For example 'tbl_products' becomes 'products'

Next, the largest change to the database was removing the 'product_type'-related information from the database. This was primarily done for reasons of reducing the storage taken up by having the information on every row in the table, however, this information was moved into a separate table with a one-to-many relationship. The data was moved to prevent the 'update' anomaly to occur - meaning the data will only have to be updated in one place to affect all records.

Another change in the products table is the change of all the image paths. Due to conflicting names between the file paths on the file names themselves and the pre-set database. The change of the file paths in the database improves the organisation.

## Accessing the database
The database in its final form before the assignment was submitted can be found in the file "modified_database_final.sql", which will reconstruct the database as necessary.

## Other changes made to the assignment
A unique page for logging in and signing up was created, this can be accessed through the header on each page. This was done for ease of use and consistency across the website.
> There are still hyperlinks on pages where the log in page may need to be accessed.

A section below the shopping cart on cart.php has been added which will display the users previous orders
> They are displayed in a table-link manner such as in the shopping cart.

# References / Bibliography
Hamid, D. (2021) JavaScript matchMedia().addListener() Alternative - Designcise [Online]. Available at: https://www.designcise.com/web/tutorial/what-is-the-substitute-for-the-deprecated-matchmedia-addlistener-method [Accessed 12 January 2022].

Ilik, M. (2020) Working with JavaScript Media Queries [Online]. Available at: https://css-tricks.com/working-with-javascript-media-queries/ [Accessed 12 January 2022].

w3schools (n.d. a) AJAX Send an XMLHttpRequest To A Server [Online] Available at: https://www.w3schools.com/xml/ajax_xmlhttprequest_send.asp [Accessed: 24 February 2022].

w3schools (n.d. b) How To Create A Validation Form [Online] Available at: https://www.w3schools.com/howto/howto_js_password_validation.asp [Accessed: 20 February 2022].

w3schools (n.d. c) PHP MySQL Prepared Statements [Online] Available at: https://www.w3schools.com/php/php_mysql_prepared_statements.asp [Accessed: 25 February 2022].

# Written by Will Corkill
Furness College Student ID: 40019692
> Furness College Email: 40019692@student.furness.ac.uk

UCLan Student ID: G20973951
> UCLan Email: WCorkill@uclan.ac.uk
