CREATE TABLE `User` (

	`id`			INT(11)						NOT NULL	AUTO_INCREMENT,
	`screenName`	VARCHAR(255)				NOT NULL	COMMENT 'nick',
	`oauthProvider`	ENUM('twitter','facebook')	NOT NULL,
	`oauthKey1`		VARCHAR(64)					NOT NULL,
	`oauthKey2`		VARCHAR(64)					NOT NULL,
	`createTime`	TIMESTAMP					NOT NULL	DEFAULT CURRENT_TIMESTAMP,
	`updateTime`	TIMESTAMP					NULL		DEFAULT NULL,

	PRIMARY KEY (`id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8;
