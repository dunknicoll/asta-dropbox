CREATE TABLE `#__dropbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` text NOT NULL,
  `token_secret` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ;

