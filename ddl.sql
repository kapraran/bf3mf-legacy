-- php.clans definition

CREATE TABLE `clans` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` text,
  `name_down` text,
  `tag` text,
  `email` text,
  `password` text,
  `coninfo` text,
  `rights` text,
  `avatar` text,
  `country` varchar(256) DEFAULT 'none',
  `battlelog` varchar(100) DEFAULT NULL,
  `from_id` bigint DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- php.challenges definition

CREATE TABLE `challenges` (
  `id` int NOT NULL AUTO_INCREMENT,
  `match_id` varchar(256) DEFAULT NULL,
  `match_clan_id` varchar(256) DEFAULT NULL,
  `match_clan_name` varchar(256) DEFAULT NULL,
  `from_clan_id` varchar(256) DEFAULT NULL,
  `from_clan_name` varchar(256) DEFAULT NULL,
  `accepted` int DEFAULT NULL,
  `rejected` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- php.matches definition

CREATE TABLE `matches` (
  `id` int NOT NULL AUTO_INCREMENT,
  `clan_name` varchar(256) DEFAULT NULL,
  `clan_id` int DEFAULT NULL,
  `active` int DEFAULT NULL,
  `start_time` bigint DEFAULT NULL,
  `end_time` bigint DEFAULT NULL,
  `server_region` varchar(256) DEFAULT NULL,
  `server_own` varchar(256) DEFAULT NULL,
  `dlc_own` varchar(256) DEFAULT NULL,
  `preset` varchar(256) DEFAULT NULL,
  `mode` varchar(256) DEFAULT NULL,
  `platform` varchar(256) DEFAULT NULL,
  `tsize` int DEFAULT NULL,
  `map1` varchar(256) DEFAULT NULL,
  `map2` varchar(256) DEFAULT NULL,
  `map3` varchar(256) DEFAULT NULL,
  `notes` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- php.notifications definition

CREATE TABLE `notifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `to_id` int DEFAULT NULL,
  `opened` int DEFAULT NULL,
  `from_name` varchar(256) DEFAULT NULL,
  `time` varchar(256) DEFAULT NULL,
  `content` varchar(256) DEFAULT NULL,
  `from_Id` bigint DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `to_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


