![enter image description here](https://raw.githubusercontent.com/iamashraff/Pet-Club-Management-System/main/img/logo.png?token=GHSAT0AAAAAABRS3BR5H42QGTSCNNY7VFS2YQWHGZQ)
# Pet Corner Club Management System
***Pet Corner Club*** is a ***Pet Club Management System***. Design for Pet Club to manage the membership of the club.<br>
The project was developed by me for Internet Programming (ISB42503) course at  the Universiti Kuala Lumpur (UniKL MIIT).

## License
The source code has been published on GitHub Repository under _MIT License_.  
Please visit `LICENSE` file to read the details about the license.

## About the project
The system is using  ***CRUD*** concept in ***PHP***.

Languages :
- PHP
- CSS

Technology :
- Bootstrap 5
- MDBootstrap 5
- MySQL Database
- Font Awesome 5
- Google Font

## Project Sitemap
![enter image description here](https://raw.githubusercontent.com/iamashraff/Pet-Club-Management-System/main/img/sitemap.png?token=GHSAT0AAAAAABRS3BR4YGVLSELA6PBAHJEKYQXD7NA)

**Module :**
- **User/Member**<br>
	Allow user/member to create a new account and register their pet(s) in the system.<br>
	Allow user/member to edit their account information.<br>
	Allow user/member to login and logout from their account.<br>
	![User/Member Sitemap](https://raw.githubusercontent.com/iamashraff/Pet-Club-Management-System/main/img/sitemap_user.jpg?token=GHSAT0AAAAAABRS3BR4FT5URJSY2AKJAZCOYQXESRA)
			*Figure : User/Member Sitemap*<br><br>
	
- **Administrator**<br>
	Allow administrator to view all user registered in the system.<br>
	Allow administrator to edit user(s) account information such as name, email, phone number and password.<br>
	Allow administrator to delete user(s) account with their pet(s) assigned to the account.<br>
	Allow administrator to view all user's pet registered in the system.<br>
	Allow administrator to add pet and assigned the pet to a particular user that registered in the system.<br>
	Allow administrator edit user's pet information.<br>
	Allow administrator to delete user's pet.<br>
	![Administrator Sitemap](https://raw.githubusercontent.com/iamashraff/Pet-Club-Management-System/main/img/sitemap_admin.jpg?token=GHSAT0AAAAAABRS3BR4U2SMDPSI2M35I2SAYQXERPA)
				*Figure : Administrator Sitemap*<br><br>
				

## Databases
![enter image description here](https://raw.githubusercontent.com/iamashraff/Pet-Club-Management-System/main/img/erd.jpg?token=GHSAT0AAAAAABRS3BR4B2VBE7FQUJBDCB66YQXSN5Q)

**Business Rules**<br>
	- A user/member could add one or many pets into their account.<br>
	- A pet could only be assigned to one and only one user/member at a time.<br>
	- An administrator could manage one or many user/member at a time.<br>
	- An administrator could manage one or many pets at a time.<br>

## How to use ?
**Option 1 : Restore MySQL Dump.**
1. Login to phpMyAdmin.
2. Select or create a new database.
3. Import `petcorner.sql` MySQL dump file.
4. Import project file to web server directory.
5. Visit `[URL]/admin/admin_login.php`
6. Login credential are the following :
> Admin Username : admin<br>
> Password : 456
7. You could easily create a new user account by visiting `[URL]/register.php`
8. Once registration has success, you may login the system with the information you recently created on this link `[URL]/login.php`
9. You may try login user with pre-created user account information with the following credential :
 > Username : muhamadashraff<br>
> Password : 456
<br>

**Option 2 : Create a new database.**
1. Create a new database name : `petcorner`
2. Create table *admin* by running this SQL query :

>  CREATE TABLE members (   member_id int(6) NOT NULL,
>  f_name varchar(20) NOT NULL,   
>  l_name varchar(20) NOT NULL,   
>  email varchar(30) NOT NULL,   
>  area_code varchar(5) NOT NULL,   
>  mobilehp varchar(20) NOT NULL,   
>  birth_date date NOT NULL,   
>  username varchar(50) NOT NULL,   
>  password varchar(100) NOT NULL );

3. Add an *admin privileges* by running SQL query :
> INSERT INTO admin (admin_id, username, password) VALUES (1,
> 'admin', '51eac6b471a284d3341d8c0c63d0f1a286262a18');

Password in SHA1 format. <br>
*`51eac6b471a284d3341d8c0c63d0f1a286262a18`* is *`456`*.

4. Create table *members* and *pet_info*

> CREATE TABLE members ( 
> member_id int(6) NOT NULL,   
> f_name varchar(20) NOT NULL,  
> l_name varchar(20) NOT NULL,   
> email varchar(30) NOT NULL,   
> area_code varchar(5) NOT NULL,   
> mobilehp varchar(20) NOT NULL,  
> birth_date date NOT NULL,   
> username varchar(50) NOT NULL,  
> password varchar(100) NOT NULL );

> CREATE TABLE pet_info (
> pet_id int(6) NOT NULL,   
> pet_type varchar(20) NOT NULL,   
> pet_name varchar(50) NOT NULL,  
> pet_gender varchar(20) NOT NULL,   
> pet_partnership_pro varchar(255) NOT NULL,   
> member_id int(6) NOT NULL,   
> date_added datetime DEFAULT NULL );

5. Import project file to web server directory.
6. Visit `[URL]/admin/admin_login.php`
7. Login credential are the following :
> Admin Username : admin<br>
> Password : 456

8. You could easily create a new user account by visiting `[URL]/register.php`
9. Once registration has success, you may login the system with the information you recently created on this link `[URL]/login.php`
10. Alternatively, you may run a SQL query to add a user into the database by using the following example query :
> INSERT INTO members (f_name, l_name, email, area_code, mobilehp,
> birth_date, username, password) VALUES ('Muhamad', 'Ashraff',
> 'muhamadashraff@email.com', '011', '3456789', '1990-01-01',
> 'muhamadashraff', SHA1('456'));


				
## Main Page

![enter image description here](https://raw.githubusercontent.com/iamashraff/Pet-Club-Management-System/main/img/mainpage.png?token=GHSAT0AAAAAABRS3BR4RGLXRF5S7L66WKIOYQWGQXQ)


## User Side

1. **User *Login* Form**
![User Login Form](https://raw.githubusercontent.com/iamashraff/Pet-Club-Management-System/main/img/login_user.jpg?token=GHSAT0AAAAAABRS3BR43GN2B3IJ4MFG4SVWYQXEU4A)
<br><br>
2. **User *Registration* Form**
![enter image description here](https://raw.githubusercontent.com/iamashraff/Pet-Club-Management-System/main/img/register_user.jpg?token=GHSAT0AAAAAABRS3BR5V4G5YF5FUBYPE4XSYQXEWVQ)

3. **User Dashboard**
	
	3.1 ***View*** Pets
![enter image description here](https://raw.githubusercontent.com/iamashraff/Pet-Club-Management-System/main/img/viewpets_user.jpg?token=GHSAT0AAAAAABRS3BR4MNWXGKZHPXZI5M32YQXEYTA)

	3.2 ***Add*** Pets
![enter image description here](https://raw.githubusercontent.com/iamashraff/Pet-Club-Management-System/main/img/addpets_user.jpg?token=GHSAT0AAAAAABRS3BR55MKJ3ARYJ7PAT2SUYQXE2AQ)

	3.3 ***Edit*** Pet
![enter image description here](https://raw.githubusercontent.com/iamashraff/Pet-Club-Management-System/main/img/editpet_user.jpg?token=GHSAT0AAAAAABRS3BR5EIZWMLH7QIL4QBQMYQXE3DQ)

	3.4 ***Delete*** Pet
![enter image description here](https://raw.githubusercontent.com/iamashraff/Pet-Club-Management-System/main/img/deletepet_user.jpg?token=GHSAT0AAAAAABRS3BR5P6PVO64LIPSJO2J6YQXE4IA)

	3.5 ***Edit*** Account Information
![enter image description here](https://raw.githubusercontent.com/iamashraff/Pet-Club-Management-System/main/img/editaccount_user.jpg?token=GHSAT0AAAAAABRS3BR4CZ2SDDZB5KTN4G36YQXFBMA)

## Administrator Side
1. **Administrator *Login***
![enter image description here](https://raw.githubusercontent.com/iamashraff/Pet-Club-Management-System/main/img/login_admin.jpg?token=GHSAT0AAAAAABRS3BR4PQ5I4LV6VH7FMQZ6YQXRUXQ)

2. **Administrator Dashboard**

	2.1 **User Management**

	2.1.1 ***View*** All Users
![enter image description here](https://raw.githubusercontent.com/iamashraff/Pet-Club-Management-System/main/img/viewusers_admin.jpg?token=GHSAT0AAAAAABRS3BR45CE6QFW7OYNWPANQYQXRXRA)

	2.1.2 ***Add*** User
![enter image description here](https://raw.githubusercontent.com/iamashraff/Pet-Club-Management-System/main/img/adduser_admin.jpg?token=GHSAT0AAAAAABRS3BR4GAOVONLKD3ZF4L3IYQXR3JQ)

	2.1.3 ***View*** A User
![enter image description here](https://raw.githubusercontent.com/iamashraff/Pet-Club-Management-System/main/img/viewuser_admin.jpg?token=GHSAT0AAAAAABRS3BR4XSMG3N57XEJEPVQYYQXR6SA)

	2.1.4 ***Edit*** User's Password
![enter image description here](https://raw.githubusercontent.com/iamashraff/Pet-Club-Management-System/main/img/editpassword_admin.jpg?token=GHSAT0AAAAAABRS3BR5SFR4CZEY55ESVMLOYQXSAAA)

	  2.1.5 ***Edit*** User's Account Information
![enter image description here](https://raw.githubusercontent.com/iamashraff/Pet-Club-Management-System/main/img/edituser_admin.jpg?token=GHSAT0AAAAAABRS3BR57J5TZFKOOEDXYMM4YQXSBYQ)

	2.1.6 ***Delete*** User
![enter image description here](https://raw.githubusercontent.com/iamashraff/Pet-Club-Management-System/main/img/deleteuser_admin.jpg?token=GHSAT0AAAAAABRS3BR5HUWYMKJVGJK6EENKYQXSDLQ)

	2.2 **Pet Management**
	
	2.2.1 ***View*** All Pets
![enter image description here](https://raw.githubusercontent.com/iamashraff/Pet-Club-Management-System/main/img/viewpets_admin.jpg?token=GHSAT0AAAAAABRS3BR5B6DFLILVECV5J5DEYQXSGWQ)

	2.2.2 ***Add*** Pets
![enter image description here](https://raw.githubusercontent.com/iamashraff/Pet-Club-Management-System/main/img/addpet_admin.jpg?token=GHSAT0AAAAAABRS3BR4JKFBSIL3A7W7WNYUYQXSIFQ)

	2.2.3 ***View*** A Pet
![enter image description here](https://raw.githubusercontent.com/iamashraff/Pet-Club-Management-System/main/img/viewpet_admin.jpg?token=GHSAT0AAAAAABRS3BR5R753YFSCCRGJNSEGYQXSJWQ)

	2.2.4 ***Edit*** Pet
![enter image description here](https://raw.githubusercontent.com/iamashraff/Pet-Club-Management-System/main/img/editpet_admin.jpg?token=GHSAT0AAAAAABRS3BR5CWB2FKT6BWW7DCNCYQXSKTA)

	2.2.5 ***Delete*** Pet
![enter image description here](https://raw.githubusercontent.com/iamashraff/Pet-Club-Management-System/main/img/deletepet_admin.jpg?token=GHSAT0AAAAAABRS3BR4YXID5G3GGCNXFGYMYQXSL4A)



## Credit
**Developed by :**  
_Muhamad Ashraff Othman_<br>
© 2021-2022 All rights reserved.
