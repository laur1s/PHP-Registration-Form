# Users Login and Registration Template

This is a secure login & registration form using PHP, MySQL and jQuery using Bootstrap  3.

Form is using MySQL Prepared Statements and password encryption using SHA-256.

![Index page](https://github.com/laur1s/Registration-Template/blob/master/example/index.PNG)
![Login and Registration pages](https://github.com/laur1s/Registration-Template/blob/master/example/log_reg.png)

## Installation

1.Clone the Repository to your www directory
   ```
   $ git clone https://github.com/laur1s/PHP-Registration-Form.git
   ```
2. Setup your MySQL database
3. Create an users table according by running the following SQL commands:
   1. `CREATE DATABASE db;`
   2. `USE db;`
   3. `CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;`


## Use

Feel free to modify the template according your needs and push the code if you make any improvements!
