# Doodle Designer
Doodle Designer was created to provide a way to create simple, fun doodles and share them with others, or just save them for later. With the increase in popularity of online drawing games, there's a particular uniqueness that comes with these drawings. Whether you want to just practice drawing with a mouse, create simple and unique sketches, or even use it for more serious purposes, doodle designer provides a way to do so. 

Doodle Designer was created by a group of 4 CU Boulder students, during our CSCI3308 course. This project allowed us to get accustomed with frontend and backend development, various different languages, and the whole workflow of a group in general. While the project still lacks a few features, our vision for Doodle Designer is more social, and will involve sharing doodles with others at its core.  
## Repo Organization/Structure  
On the main page of the repository, one will find four folders and two files. Those four folders being, 'All project code components', 'Milestone Submissions', 'recordings', and 'root'. The two files are a video demonstrating the project in action and the README you are reading now.
### All Project Code Components 
Here are tests done for the canvas drawing feature. In the views directory, there are multiple experiments in regards to drawing on canvas, saving images and loading images to canvas. In the recs directory, there are JavaScript and CSS files that correspond to each experiment in the views directory.
### Milestone Submissions
Here are our milestones in pdf format. They show our progress, how the direction of the project has changed over time, and how each member contributed over time.
### Recordings
Here are the partial recordings for the project video in the main repository. The reason for this directory was to make it easier for Elizabeth to combine the recordings and create a finished product.
### Root
Here is the finalized website. This has the finalized features for drawing on canvas, the frontend, the backend, the .htaccess file, etc. When the website is running, the majority of it requires is in this directory.
## How to Build/Run/Test Code  
First, XAMPP is required to run the PHP files. So, install this first if not already installed[^1]. After the installation, the repository needs to be cloned into the folder called “htdocs”. From there, open XAMPP and start Apache and MySQL. After the deployment environment is up and running, go to localhost and click on the link with the same name as the repository, CSCI-3308-Fall21-013-07. From there, click on the link called “root.” Now the user is on the website. However, there are a couple more things to do to make the app functional. Go to localhost/phpmyadmin/ and create a new database called “drawing”. After that, copy and paste the code in the .sql files in root/includes called userinfo.sql and drawings.sql. Now, the database should be working properly and the website fully functional. If there is an error, check the includes/dbh.inc.php file to make sure server variables are correct. In the case of an error with the backend, the website will print there is an sql error. When done using the application, click stop for the Apache and MySQL options in XAMPP.
[^1]: Install XAMPP [here](https://www.apachefriends.org/download.html)
