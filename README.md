# php-simple-auth


This project demonstrates simple authentication using PHP

Features:
* Sign-up
* Activate account
* Sign-in
* Reset password
* Remember user

Don't forget to configure the settings
```
/Config
```

Create User table to store registrants

```
  CREATE TABLE `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(45) DEFAULT NULL,
  `lastName` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `passwordDigest` varchar(60) DEFAULT NULL,
  `activationDigest` varchar(60) DEFAULT NULL,
  `rememberDigest` varchar(60) DEFAULT NULL,
  `resetDigest` varchar(60) DEFAULT NULL,
  `resetSentAt` datetime DEFAULT NULL,
  `activatedAt` datetime DEFAULT NULL,
  `isActive` bit(1) DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
```

