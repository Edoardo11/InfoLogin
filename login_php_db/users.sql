
CREATE TABLE `users` (
  `uid` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

ALTER TABLE `users`
  MODIFY `uid` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;
