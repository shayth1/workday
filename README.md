# WorkDay
## Installation
### Step 1:
Open XAMMP and RUN Apache and MySQL
### Step 2:
```sh
Go to: C:\xampp\htdocs\workday
```
### Step 3:
open workday folder then right click and select Git Bash Here
 ### Step 4:
 Run this command 
```sh
git pull origin main
```
 ### Step 5: 
open google chrome and go to phpMyAdmin
```sh
http://localhost/phpmyadmin/index.php
```
it should open the mySQL and youll be abel to show all databases

### Step 6:
* on the left side click on New icon.
* a new screen will open
* inside Database name put the exact name:

```sh
workday
```
* then click create
* now look again to the left side of the screen you should see a database called "workday"

### Step 7:

* double click on workday database 
* now look at the top middle of the screen and find the (import) button
* select choose file button 
* go to this path 
```sh
C:\xampp\htdocs\workday\assets\setup
```
* select (workday) file with double click 
* then scroll down to the end to see (Go) button in the right and click on it 
* now you will see that a new tabels has been added

### Step 8:
now go to localhost by using google chrome 
```sh
http://localhost/workday
```
 
Now you should redirect to the Login page. 
use the following info to login:

| Username | Password |
| ------ | ------ |
| admin | aaaaaa |

