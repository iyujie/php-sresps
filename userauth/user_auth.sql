CREATE DATABASE IF NOT EXISTS phpsres;

USE phpsres;

--
-- Table structure for user authentication
--

CREATE TABLE IF NOT EXISTS `customers_auth` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=187 ;

--
-- Dumping data for user authentication in the created table
--

INSERT INTO `customers_auth` (`uid`, `name`, `email`, `phone`, `password`, `address`, `city`, `created`) VALUES
(170, 'Swadesh Raj', 'swadesh@gmail.com', '1234567890', '$2a$10$251b3c3d020155f7553c1ugKfEH04BD6nbCbo78AIDVOqS3GVYQ46', 'Jalan Simpang Tiga', 'Kuching', '2017-04-15 18:21:20'),
(171, 'Leslie Ling', 'leslie@gmail.com', '1111111111', '$2a$10$d84ffcf46967db4e1718buENHT7GVpcC7FfbSqCLUJDkKPg4RcgV2', 'Jalan Wan Alwi', 'Kuching', '2017-04-15 18:30:58'),
(172, 'Nurul Hidayah', 'nurul@gmail.com', '2222222222', '$2a$10$c9b32f5baa3315554bffcuWfjiXNhO1Rn4hVxMXyJHJaesNHL9U/O', 'C/ Moralzarzal, 86', 'Burlingame', '2017-04-15 18:32:03')
;

