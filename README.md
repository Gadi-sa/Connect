![Algorithm schema](readme_img/nav.png)
# Connect
Connect is a responsive social networking website that allows users to easily ```create profiles, share their stories, and connect with others.``` The platform features a simple ```user registration, login system, and forget password```, enabling users to quickly ```customize their profiles with personal information, profile picture, and a short biography```.

Users can stay up-to-date with others by viewing stories posted on the ```news feed system and interact with them through reactions and comments```. Connect also provides a ```dark/light mode```, allowing users to personalize their experience.

The website allows users to ```create posts, and add comments``` to other users' posts. It also includes a ```search system, download feature, and profile editing``` functionality. The project was developed using ```HTML, the Tailwind CSS framework, JavaScript, PHP, and SQL```. With its features and functionality, Connect offers a comprehensive social networking platform that provides a fun and engaging experience for users.

## Setup and run the project
### Database Connection
```bash
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "backend";
```


### Database
#### 1-Open your database management system(MySQL) and create a new database called ```"backend"```.

#### 2-import ```backend.sql``` to the MySQL.

#### 3-Run the script to create the necessary tables for the Connect website. This will create the following tables:

* users: stores user information, such as name, email, password, bio, and profile picture.

* stories: stores stories posted by users, along with their titles, content, images, and creation dates.

* comments: stores comments made on stories, along with the user and story IDs, the comment text, and the creation date.

# Dark/Light Mode
![Algorithm schema](readme_img/darkmode.png)
![Algorithm schema](readme_img/lightmode.png)

To experience the ```dark/light mode``` functionality, you should first turn off the dark mode from your ```computer's settings by going to Personalization > Colors and turning off dark mode if it's already on.``` Once you have done that, you can go to the Connect website and toggle between dark and light mode using the toggle switch provided on the website.
 # Defualt Account
email:
 ```bash
user@connect.nl
 ```
password:
 ```bash
 123
 ```

