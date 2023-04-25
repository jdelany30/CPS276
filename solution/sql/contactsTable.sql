CREATE TABLE `contactsTable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `city` varchar(250) NOT NULL,
  `state` varchar(250) NOT NULL,
  `phone` varchar(250) NULL,
  `email` varchar(250) NULL,
  `dob` varchar(250) NOT NULL,
  `contact` varchar(250) NOT NULL,
  `age` varchar(250) NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;