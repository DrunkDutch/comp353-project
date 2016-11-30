# Super -- Final Group Project for COMP 353
### Group 12

Authors: 26290515, 26795528, 27417888, 40039346


|Folder    | Description                   |
|----------|:-----------------------------:|
|app       |Reserved for Back-End Function. template used to create Layout Function for PHP (finished) |
|Index.php | Home Page                     |
|public    |Should be used as "Folder available for Client"|
|Config    |Used for Back-end config. config.php: empty|
|Public    |js/app.js : Used as main JS file of the project; css/app.css : Used as main StyleSheet; Media: Used to store Image; View/main: Used to store HTML pages; Includes: Used to Store Navigation, Footer, Head; Fonts: Could be used to store Font if needed|

NB: The Layout Function is not ready yet and it is only working correctly
on the index.php page.

INSTALLATION: 

1. `cd /var/www/html/`
2. `git clone git@github.com:DrunkDutch/comp353-project.git`
3. `cd /var/www/html/sql/tables`
4. `mysql -u root -proot < structure.sql`



Tutorial to install Front-End

Install all VM files in a folder, open VirtualBox -> Select new VM -> Select the file of 3Gb -> Select the amount of RAM (min: 4Gb) -> Start your VM

...
->Start your VM
-> enter your name and password (comp353, root)
-> start with an update: sudo apt-get update
-> Enter the password (if needed)
-> Let's check if everything is alright: sudo service apache2 start
-> Enter the password (if needed)

Output expected:
		*Starting web server apache2


-> Let's install a GUI so you can navigate in the OS, I have chosen GNOME:
sudo apt-get install ubuntu-gnome-desktop
-> Enter the password (if needed)
-> answer to the question: y

(Wait for installation to be completed 10-30 minutes)


-> Once finished restart: sudo reboot
-> You should see a normal desktop environment on your VM (make sure to give at least 4Gb of ram)

-> Login , Don't upgrade to ubuntu 16.10

-> Open firefox, enter this URL: http://localhost,
you should see the Apache2 Ubuntu Default Page (https://assets.digitalocean.com/articles/lamp_1404/default_apache.png)


-> Open the terminal application, enter: sudo chown -R comp353:comp353 /var/www/html

-> Then find the files application -> click on computer -> var folder -> www folder -> html folder 

-> Right click on the folder html, click on properties -> Permission , and make sure comp353 user have right to create and delete

-> Press "ok"
-> Go inside html, and delete the index.php file

-> Install git : sudo apt-get install git

-> Update your softwares: sudo apt-get update

-> Now let's set the html folder as your git folder for the project,
cd /
cd /var/www/html
git init

-> Let's load files from Master, 
-> git -b master clone https://github.com/DrunkDutch/comp353-project.git
-> ... Now you should have a folder called comp353-project inside the html folder
-> Check the permission again make sure user have right to create and delete

NB. During your test, if you want to access to the other files not inside the choosen directory through the broswer, you need to:

-> go in app/route.php
-> Set the value, $enable_root to false

if the value is set to true the user is restricted to a certain directory on the website...
/var/www/html/comp353-project/




