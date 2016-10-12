#
# TABLE STRUCTURE FOR: album
#

DROP TABLE IF EXISTS `album`;

CREATE TABLE `album` (
  `album_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `album` varchar(255) NOT NULL,
  PRIMARY KEY (`album_id`),
  UNIQUE KEY `album` (`album`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `album` (`album_id`, `album`) VALUES ('1', 'Eskul');
INSERT INTO `album` (`album_id`, `album`) VALUES ('3', 'Lomba');
INSERT INTO `album` (`album_id`, `album`) VALUES ('2', 'Private');
INSERT INTO `album` (`album_id`, `album`) VALUES ('4', 'Project');
INSERT INTO `album` (`album_id`, `album`) VALUES ('5', 'Workshop Inorobo');


#
# TABLE STRUCTURE FOR: banner
#

DROP TABLE IF EXISTS `banner`;

CREATE TABLE `banner` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `url` varchar(100) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `gambar` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: captcha
#

DROP TABLE IF EXISTS `captcha`;

CREATE TABLE `captcha` (
  `captcha_id` bigint(13) unsigned NOT NULL AUTO_INCREMENT,
  `captcha_time` int(10) unsigned NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `word` varchar(20) NOT NULL,
  PRIMARY KEY (`captcha_id`),
  KEY `word` (`word`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

INSERT INTO `captcha` (`captcha_id`, `captcha_time`, `ip_address`, `word`) VALUES ('42', '1470733231', '::1', '25406');


#
# TABLE STRUCTURE FOR: category
#

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `category_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category` (`category`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `category` (`category_id`, `category`) VALUES ('2', 'Belajar robotik');
INSERT INTO `category` (`category_id`, `category`) VALUES ('1', 'lomba robotic');


#
# TABLE STRUCTURE FOR: ci_sessions
#

DROP TABLE IF EXISTS `ci_sessions`;

CREATE TABLE `ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('71fc69c4af18f7b544e51bb114a4ed15648a6b77', '::1', '1468252395', '__ci_last_regenerate|i:1468252166;');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('5a3c266047f78923f17817b86523019f06479d7c', '::1', '1468252776', '__ci_last_regenerate|i:1468252506;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('2e5ca05fbf02c4a93163b35b5212bc18a707950e', '::1', '1468253004', '__ci_last_regenerate|i:1468252856;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('31dd39d81ea4cb38bdcefbab8413caae2c70a543', '::1', '1468253335', '__ci_last_regenerate|i:1468253190;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('3bb117cc3101522f6532753b4fd05ff7491c2520', '::1', '1468253693', '__ci_last_regenerate|i:1468253544;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('8e6afa0eaf95df905a1dbc42282b60c0322b66d6', '::1', '1468253872', '__ci_last_regenerate|i:1468253863;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('96483140567311a0c290ddb83591d6e3bcae2cc9', '::1', '1468254461', '__ci_last_regenerate|i:1468254169;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ad8262093bb5f2c70d838df8708f07306318eee4', '::1', '1468254655', '__ci_last_regenerate|i:1468254482;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('35337a18d793443730afb145e6d3efd326f9ed05', '::1', '1468254832', '__ci_last_regenerate|i:1468254831;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('733761056d4b8cc57276ca5c31c41feeab5e4872', '::1', '1468254832', '__ci_last_regenerate|i:1468254832;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('a59688f026a4ee91fb7d438046cb74829b49c381', '::1', '1468255123', '__ci_last_regenerate|i:1468254834;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('6c17465f28a7bebbfed3b96e0e65385dddbde998', '::1', '1468255137', '__ci_last_regenerate|i:1468255137;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('788f65aea4951f7db8a54136a0978c93a1ed988f', '::1', '1468256894', '__ci_last_regenerate|i:1468256656;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('f2b4b05cb8a9771b6078d8d1219336cabf83f6f7', '::1', '1468257178', '__ci_last_regenerate|i:1468256957;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('bd453aa0f72bdea7d29d0802c68d6c86d6ce449b', '::1', '1468258035', '__ci_last_regenerate|i:1468258035;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('d202bd8afd2bd19fceb68a4f1639cf790504ccc2', '::1', '1468330056', '__ci_last_regenerate|i:1468329955;');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('9f93c20398b069022dcf4d77b461bfe1f5d2073f', '::1', '1468329956', '__ci_last_regenerate|i:1468329955;');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('34c0afc73e5445ce105b9dd0ac3910b84b0fe96f', '::1', '1468333171', '__ci_last_regenerate|i:1468332933;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('917bdb018ddfa020904fc5f7895242f12f70f997', '::1', '1468333448', '__ci_last_regenerate|i:1468333287;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('f94d2d4db40a801ee1d35f102ec2330ecb319e7d', '::1', '1468379832', '__ci_last_regenerate|i:1468379696;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('512d16e1271bd24b4cd536b85fa5cd15f8e5c820', '::1', '1468381104', '__ci_last_regenerate|i:1468380959;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('51906bbc5bfe770296ce1bc90af7f0dd304c4ac0', '::1', '1468381719', '__ci_last_regenerate|i:1468381447;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('c11935c2d36b46bd027b898c603ac92f33981810', '::1', '1468382008', '__ci_last_regenerate|i:1468381759;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('df01db87cae241c4bff823b21510bff559f469ae', '::1', '1468382377', '__ci_last_regenerate|i:1468382082;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('1cf994421cdc0b32c7ebf268fa7a3b75afa4b77a', '::1', '1468382721', '__ci_last_regenerate|i:1468382427;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('a38509e201884f9b334ad44c6cbe5c5e09d18959', '::1', '1468383006', '__ci_last_regenerate|i:1468382748;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('2294dc330c6ef8231759a122f5c247976eb3e0d2', '::1', '1468383279', '__ci_last_regenerate|i:1468383132;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('abb27a12916e3869399eedcfb75e5444b4135fee', '::1', '1468383865', '__ci_last_regenerate|i:1468383567;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('9fe9efeba69b0bb9e137ee4e5ac3f2a17e0e833c', '::1', '1468384159', '__ci_last_regenerate|i:1468383872;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('7f06ae9df471e30ffbb628f74d04a45ec0e3d9b7', '::1', '1468384219', '__ci_last_regenerate|i:1468384189;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('12db9a0e5cf9f91fd7fd2c2ca716004cb24175cb', '::1', '1468391037', '__ci_last_regenerate|i:1468391008;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('75cb0d9645203206428d52e5344f3a8c7b6f7469', '::1', '1468392629', '__ci_last_regenerate|i:1468392470;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('996d4b7401b2dedad6042973406376df0941bcab', '::1', '1468393090', '__ci_last_regenerate|i:1468392796;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('979b3073f5b4e4ebcc11bd6d6712f43ff417ea0b', '::1', '1468393965', '__ci_last_regenerate|i:1468393962;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ee7707b1fc02e5b2d66bc52ea72e8777344c5b69', '::1', '1468394587', '__ci_last_regenerate|i:1468394587;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ead6c33bdb2e5759b8820f05286e95448ab05f3c', '::1', '1468396322', '__ci_last_regenerate|i:1468396299;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";alert|s:196:\"<div class=\"alert alert-success alert-dismissable\"><i class=\"fa fa-check\"></i><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>Data sudah diperbaharui !</div>\";__ci_vars|a:1:{s:5:\"alert\";s:3:\"old\";}');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('4d298ccb0e7491b0fb591ed759d451ee5f41b554', '::1', '1468460596', '__ci_last_regenerate|i:1468460452;');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('24dfbfe909d7fd8276ec6e1f4a05900de4296c70', '::1', '1468461055', '__ci_last_regenerate|i:1468460800;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('b86d5268d27b0d9b8565012963240428645b831a', '::1', '1468461486', '__ci_last_regenerate|i:1468461196;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('4dba28eb26824d09508e34e9a26cb05331b2c290', '::1', '1468461604', '__ci_last_regenerate|i:1468461505;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('075a0daca8625165a4860c963f8cf50cc6567a3f', '::1', '1468462892', '__ci_last_regenerate|i:1468462615;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ef7c5755a8b196c278b0f1b5dec9c54f7a7f05c6', '::1', '1468462992', '__ci_last_regenerate|i:1468462921;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";alert|s:196:\"<div class=\"alert alert-success alert-dismissable\"><i class=\"fa fa-check\"></i><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>Data sudah diperbaharui !</div>\";__ci_vars|a:1:{s:5:\"alert\";s:3:\"old\";}');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('34bc7c419a025bec2b14ccb3a9b1ea11c086b5f2', '::1', '1468463542', '__ci_last_regenerate|i:1468463299;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('e13987278f31bf08c2d8258fd2e2c0c8c667477a', '::1', '1468463934', '__ci_last_regenerate|i:1468463723;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('08bab0501dbeda95d656823d528e95a0850edc0a', '::1', '1468465158', '__ci_last_regenerate|i:1468465158;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('b7695142fa25874f0476da002e658639299c10c2', '::1', '1468465157', '__ci_last_regenerate|i:1468465155;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('3d9533ed5c0dc9fd52640d553205adc453587e2e', '::1', '1468465264', '__ci_last_regenerate|i:1468465160;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('41dd327204504160d8e393704869f5ec1d801643', '::1', '1468468595', '__ci_last_regenerate|i:1468468317;');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('1f5926433a0ec5e88f27d754d760c4868721b372', '::1', '1468468929', '__ci_last_regenerate|i:1468468641;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('8d52ea72813869c7979aeef552ac3805741a72e2', '::1', '1468469223', '__ci_last_regenerate|i:1468468970;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('3cf1a82b06f1c192d9ae649f878b7a4ea52e59b5', '::1', '1468469547', '__ci_last_regenerate|i:1468469346;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('62de25ed104440341c60497cb8124b32b6387f22', '::1', '1468469861', '__ci_last_regenerate|i:1468469650;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ec07a180474d945c35b08d2272bef2b4a8c60956', '::1', '1468470107', '__ci_last_regenerate|i:1468470039;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('d2d559e5325c2bef6460f1e94db6c9937c883b6a', '::1', '1468471000', '__ci_last_regenerate|i:1468470707;id|s:1:\"1\";username|s:13:\"administrator\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Administrator\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('86652e52bf58c7604b015827e8cabc35c6c3c814', '::1', '1468471118', '__ci_last_regenerate|i:1468471087;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('e321df4c7bfd0be5b657356d8b4026b2deae4ebd', '::1', '1468472406', '__ci_last_regenerate|i:1468472115;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";alert|s:203:\"<div class=\"alert alert-danger alert-dismissable\"><i class=\"fa fa-ban\"></i><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>The Content field is required.<br>\n</div>\";__ci_vars|a:1:{s:5:\"alert\";s:3:\"old\";}');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('0ab01a3013320f51d902cfd73de797cb86d5c6f3', '::1', '1468472116', '__ci_last_regenerate|i:1468472116;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('fd18122fef69d71e4df1170d1a7938369e03c1f4', '::1', '1468472696', '__ci_last_regenerate|i:1468472431;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('240c8fe6a893de8b459e1ecf62190cbe23d045d1', '::1', '1468473042', '__ci_last_regenerate|i:1468472749;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('7545feb3dcb9acbcb1418bb6875d6658c14815ac', '::1', '1468473398', '__ci_last_regenerate|i:1468473110;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('cf546edaeb8352ee902bcd23e9b5b0a468abac1c', '::1', '1468473716', '__ci_last_regenerate|i:1468473412;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('29080972325e468958e410a1f287d234eb82be51', '::1', '1468474042', '__ci_last_regenerate|i:1468473809;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('2e2019d750bbaab4399da632c3c8ef19a521b190', '::1', '1468474452', '__ci_last_regenerate|i:1468474163;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('fa94f808789a8b1393902f6d5c7dbc23a4d6b99c', '::1', '1468474635', '__ci_last_regenerate|i:1468474566;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('62b28d6233a4dbb6d877e15bc2aa38238f953d95', '::1', '1468475351', '__ci_last_regenerate|i:1468475273;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('7cafe8471d68f817424030b39be643eedcd06c80', '::1', '1468477123', '__ci_last_regenerate|i:1468476833;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('eacc38332fc9d1f027c4c5e2ca088d8d1697634b', '::1', '1468477318', '__ci_last_regenerate|i:1468477136;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('60af998dd85fe98b374882deff09a85e396a77bb', '::1', '1468477563', '__ci_last_regenerate|i:1468477451;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('bc9004cf7daa4fae9188aae4a918c6500595e49e', '::1', '1468478899', '__ci_last_regenerate|i:1468478605;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('6fd4cdf84b8cc111b0961750175fbee403ed3f96', '::1', '1468478909', '__ci_last_regenerate|i:1468478908;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";alert|s:196:\"<div class=\"alert alert-success alert-dismissable\"><i class=\"fa fa-check\"></i><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>Data sudah diperbaharui !</div>\";__ci_vars|a:1:{s:5:\"alert\";s:3:\"old\";}');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('72b77e374bf651f262bd248180ed99398cbdf98f', '::1', '1468479287', '__ci_last_regenerate|i:1468479235;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('33891b547a0af218236c811cc3a74cbfabbca727', '::1', '1468480017', '__ci_last_regenerate|i:1468479861;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('154dd118011d0b50744afced7724f1884e21bf3e', '::1', '1468480317', '__ci_last_regenerate|i:1468480195;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('df28416d4161a01c02be1ed7c39c5d5dd6b44e8e', '::1', '1468480970', '__ci_last_regenerate|i:1468480939;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('9571b881d7e67ae5f6e1df6667c9d07d65f8d617', '::1', '1468481841', '__ci_last_regenerate|i:1468481751;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('38a3d0f7989ab38e869db75aa1575b30b600351e', '::1', '1468482842', '__ci_last_regenerate|i:1468482616;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('6278a5fe8cee909245247ac74a8f037f7a163e09', '::1', '1468483134', '__ci_last_regenerate|i:1468482948;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('6f806e2c878f2b82ec105c43a02a9e4ac469e353', '::1', '1468484910', '__ci_last_regenerate|i:1468484864;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('fd862ab1a7fb1b1b44d77823bf08780f6e0b3202', '::1', '1468487490', '__ci_last_regenerate|i:1468487208;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('fd3c4d3fb1b494f70e138b5bef65ae77f569b305', '::1', '1468487766', '__ci_last_regenerate|i:1468487579;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('2511cf6428b36c4745f5493575c479a7061b2ecc', '::1', '1468488182', '__ci_last_regenerate|i:1468487890;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('b01f38047bcfdf1775e33600deafda7432b5b99c', '::1', '1468488261', '__ci_last_regenerate|i:1468488205;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('1f1ce825029773382a12a748a3c401bb446307ec', '::1', '1468496194', '__ci_last_regenerate|i:1468496004;');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('e6d82ae3249a411c28a6e657845bdf3e5a3e4b18', '::1', '1468496704', '__ci_last_regenerate|i:1468496433;');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('8fbe71120b614df5fd73d3cb42f673d607433944', '::1', '1468496737', '__ci_last_regenerate|i:1468496737;');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('5ad58a7c807f5958f3e5a14f5eb212d648643dd5', '::1', '1468554959', '__ci_last_regenerate|i:1468554690;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('d9769f92a2b3343d4c8288d9c43bc9d680b07bc5', '::1', '1468810380', '__ci_last_regenerate|i:1468810262;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('de2d391ea3e33bbd94322c3f9778cdcb381bd212', '::1', '1468810875', '__ci_last_regenerate|i:1468810873;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('ce45edee447e50baee607bf2002ad5c5ee37e84b', '::1', '1468814273', '__ci_last_regenerate|i:1468814272;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('62a305a8cba3b83ee834e7d05b61868857c34702', '::1', '1468814385', '__ci_last_regenerate|i:1468814273;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('961111ee4bc41e184eb61fac20828d4631c0101d', '::1', '1468814888', '__ci_last_regenerate|i:1468814880;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('dc7d7b353716fb25a8983a25d1a96d60aa40eb74', '::1', '1468815434', '__ci_last_regenerate|i:1468815329;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('be22cf11169a6b838e94dbe5a3aeadf54358e367', '::1', '1468817379', '__ci_last_regenerate|i:1468817379;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('df0ee71176389923dcc593ece15a37569340dd9b', '::1', '1468817379', '__ci_last_regenerate|i:1468817379;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('afb1c045b2dcb068cea8a1a4163e5f546d41a987', '::1', '1468817490', '__ci_last_regenerate|i:1468817381;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('8af0741a71b658562c1e036fc52169036b9d2925', '::1', '1468817837', '__ci_last_regenerate|i:1468817683;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('1be1c6dbecffd3887ddabe7ee05ad84fa82769bc', '::1', '1468818014', '__ci_last_regenerate|i:1468817994;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('f35266e3b9f8729d8ef428b0fc472f3a4acc874a', '::1', '1468818421', '__ci_last_regenerate|i:1468818319;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('c0626da9d12fdc2718f220cb0724560a19375d56', '::1', '1468845814', '__ci_last_regenerate|i:1468845814;');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('18c554db943feccd9493966b452ced5250d25cf8', '::1', '1468851534', '__ci_last_regenerate|i:1468851342;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('6db33797eef7dbaa42fa9d89c6d3f27db78401fa', '::1', '1468851833', '__ci_last_regenerate|i:1468851660;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";alert|s:196:\"<div class=\"alert alert-success alert-dismissable\"><i class=\"fa fa-check\"></i><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>Data sudah diperbaharui !</div>\";__ci_vars|a:1:{s:5:\"alert\";s:3:\"old\";}');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('0b4aa7f805a2ed42b07c3cbec87a13138c932dc1', '::1', '1469453251', '__ci_last_regenerate|i:1469452958;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('199b1c56f7f839049a342a9bcb8bad1996b10b32', '::1', '1469453557', '__ci_last_regenerate|i:1469453261;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('3b66aac94a90ebb0e40a9789a1f5ab29862a2c6f', '::1', '1469453729', '__ci_last_regenerate|i:1469453563;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('d46295935657ce16c02ec17ef64883254dcfd4ab', '::1', '1469599573', '__ci_last_regenerate|i:1469599329;');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('fd66b76e2f6369e9c9319fd1a9dece1639726f01', '::1', '1469663434', '__ci_last_regenerate|i:1469663332;');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('66c11959df070b50ba18f429f5544c3ee2ece6b0', '::1', '1469664140', '__ci_last_regenerate|i:1469664069;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('476f4f0188edfdf3049242de6a08134f1a841bee', '::1', '1469694890', '__ci_last_regenerate|i:1469694625;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('580deecacb0af39866b801dac99cb5bad13f89a9', '::1', '1469696482', '__ci_last_regenerate|i:1469696480;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('b86b22b98ab0a4f5aa7341c24035686503e23756', '::1', '1469696482', '__ci_last_regenerate|i:1469696482;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('0592e075208fc318190a1f79c2f690eb8babc759', '::1', '1469697062', '__ci_last_regenerate|i:1469697005;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('fe68a703e455bdfaa9ce34b136c39c80113ae8bf', '::1', '1469697705', '__ci_last_regenerate|i:1469697590;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('d9520df8c5ee8f90ad4b04731250021a31809bb0', '::1', '1469698807', '__ci_last_regenerate|i:1469698807;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('0d2f8a29315fb84946c81183a5594b92ebed756c', '::1', '1470014906', '__ci_last_regenerate|i:1470014659;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('232f147d68c23cc0bd2e054b973a8b258089833e', '::1', '1470015201', '__ci_last_regenerate|i:1470015110;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('8120c78d77d0c490382b886d8f50830c40a49604', '::1', '1470016297', '__ci_last_regenerate|i:1470016007;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('0d1fae50d08efb1d4b447940df155071a20eb5f2', '::1', '1470025489', '__ci_last_regenerate|i:1470025484;');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('c2f30a7f0e383528bcc74cec2369c07ab70b6d1d', '::1', '1470027017', '__ci_last_regenerate|i:1470026728;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('2363ff7db61181de20993f5bc55cf1c6f87dc671', '::1', '1470027341', '__ci_last_regenerate|i:1470027056;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('98961f2722c326bb3faa729c55d2132fc988a288', '::1', '1470623259', '__ci_last_regenerate|i:1470622982;');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('c335741759e4690900e46076dc03bbb9ad4e73d2', '::1', '1470623693', '__ci_last_regenerate|i:1470623503;alert|s:204:\"<div class=\"alert alert-success\">Data pendaftaran anda sudah tersimpan pada sistem kami. Berikut ini merupakan data yang anda masukan. Silahkan untuk mencetaknya dengan menekan tombol cetak dibawah!</div>\";__ci_vars|a:1:{s:5:\"alert\";s:3:\"old\";}');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('36e73e1be75b4ddaa9d24bbb7a7904fac3406fb1', '::1', '1470624825', '__ci_last_regenerate|i:1470624722;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('69c960b0e10ef069c990b3856e09715a63410d83', '::1', '1470626778', '__ci_last_regenerate|i:1470626778;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('fd94d72ee5fa9cfb1f6db2bcbaa56042d3902d71', '::1', '1470645469', '__ci_last_regenerate|i:1470645468;');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('3089f1c20b083d8c7f1f02a90908bc97377eec90', '::1', '1470732846', '__ci_last_regenerate|i:1470732688;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('5e1e394017c13540ec341d52d2a070d544bf708b', '::1', '1470733509', '__ci_last_regenerate|i:1470733209;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('109dc537411ad1b8ef7c1c9d00306f39f0edb00a', '::1', '1470733571', '__ci_last_regenerate|i:1470733514;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('93cde6d16654cd10722b32b2c20d59471dd79acc', '::1', '1470735085', '__ci_last_regenerate|i:1470735085;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('d6f9cde9b570312d3ffa644c28aee1728cec72da', '::1', '1470751885', '__ci_last_regenerate|i:1470751885;');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('98871c65953bf679e7ea60a7bab2f496af812c35', '::1', '1470752457', '__ci_last_regenerate|i:1470752456;');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('95af94f59883bbb82ec7be82fa056a2934dd382a', '::1', '1470752705', '__ci_last_regenerate|i:1470752457;');
INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES ('74399501987802daa2defcb5c11dbf8c09afcdc8', '::1', '1470752838', '__ci_last_regenerate|i:1470752823;id|s:1:\"1\";username|s:7:\"inorobo\";level|s:13:\"administrator\";is_logged_in|b:1;display_name|s:13:\"Admin Inorobo\";');


#
# TABLE STRUCTURE FOR: file
#

DROP TABLE IF EXISTS `file`;

CREATE TABLE `file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` smallint(6) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `size` int(11) NOT NULL,
  `file` varchar(100) NOT NULL,
  `counter` int(11) NOT NULL,
  `access` enum('public','private') NOT NULL DEFAULT 'public',
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`) USING BTREE,
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: file_category
#

DROP TABLE IF EXISTS `file_category`;

CREATE TABLE `file_category` (
  `category_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `parent` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: hubungi_kami
#

DROP TABLE IF EXISTS `hubungi_kami`;

CREATE TABLE `hubungi_kami` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `url` varchar(100) DEFAULT NULL,
  `pertanyaan` text NOT NULL,
  `jawaban` text,
  `tanggal` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip_address` varchar(20) NOT NULL DEFAULT '0.0.0.0',
  `access` enum('public','private') NOT NULL DEFAULT 'private',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `hubungi_kami` (`id`, `nama`, `email`, `url`, `pertanyaan`, `jawaban`, `tanggal`, `ip_address`, `access`) VALUES ('1', 'Yusran', 'yuz.antiexe@gmail.com', 'localhost/site1', 'kritik dan saran disini cek', NULL, '2016-07-14 11:36:27', '::1', 'private');


#
# TABLE STRUCTURE FOR: jalur_pendaftaran
#

DROP TABLE IF EXISTS `jalur_pendaftaran`;

CREATE TABLE `jalur_pendaftaran` (
  `jalur_pendaftaran_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `jalur_pendaftaran` varchar(255) NOT NULL,
  PRIMARY KEY (`jalur_pendaftaran_id`),
  UNIQUE KEY `jalur_pendaftaran` (`jalur_pendaftaran`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: jawaban
#

DROP TABLE IF EXISTS `jawaban`;

CREATE TABLE `jawaban` (
  `jawaban_id` int(11) NOT NULL AUTO_INCREMENT,
  `pertanyaan_id` int(11) NOT NULL,
  `jawaban` varchar(255) NOT NULL,
  PRIMARY KEY (`jawaban_id`),
  KEY `pertanyaan_id` (`pertanyaan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `jawaban` (`jawaban_id`, `pertanyaan_id`, `jawaban`) VALUES ('1', '1', 'Sangat Bagus');
INSERT INTO `jawaban` (`jawaban_id`, `pertanyaan_id`, `jawaban`) VALUES ('2', '1', 'Bagus');
INSERT INTO `jawaban` (`jawaban_id`, `pertanyaan_id`, `jawaban`) VALUES ('3', '1', 'Cukup Bagus');
INSERT INTO `jawaban` (`jawaban_id`, `pertanyaan_id`, `jawaban`) VALUES ('4', '1', 'Kurang menarik');


#
# TABLE STRUCTURE FOR: jurusan
#

DROP TABLE IF EXISTS `jurusan`;

CREATE TABLE `jurusan` (
  `jurusan_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `jurusan` varchar(255) NOT NULL,
  `nama_singkat` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`jurusan_id`),
  UNIQUE KEY `jurusan` (`jurusan`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `jurusan` (`jurusan_id`, `jurusan`, `nama_singkat`) VALUES ('1', 'Manajemen Sumber Daya Manusia', 'MSDM');


#
# TABLE STRUCTURE FOR: kata_motivasi
#

DROP TABLE IF EXISTS `kata_motivasi`;

CREATE TABLE `kata_motivasi` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO `kata_motivasi` (`id`, `content`, `author`) VALUES ('1', 'Be smart Be Creative Be inovative with Inorobo', 'inorobo');
INSERT INTO `kata_motivasi` (`id`, `content`, `author`) VALUES ('2', 'Jangan melihat Robot dari luaarnya Tapi lihat Kemampuannya', 'INOROBO');


#
# TABLE STRUCTURE FOR: kelas
#

DROP TABLE IF EXISTS `kelas`;

CREATE TABLE `kelas` (
  `kelas_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `kelas` varchar(100) NOT NULL,
  `sub_kelas` varchar(100) NOT NULL,
  `jurusan_id` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`kelas_id`),
  KEY `jurusan_id` (`jurusan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `kelas` (`kelas_id`, `kelas`, `sub_kelas`, `jurusan_id`) VALUES ('3', 'Beginer', 'robotik', NULL);
INSERT INTO `kelas` (`kelas_id`, `kelas`, `sub_kelas`, `jurusan_id`) VALUES ('4', 'robotik', 'robotik', '1');
INSERT INTO `kelas` (`kelas_id`, `kelas`, `sub_kelas`, `jurusan_id`) VALUES ('5', 'Beginer', 'robotik', '1');


#
# TABLE STRUCTURE FOR: mata_pelajaran
#

DROP TABLE IF EXISTS `mata_pelajaran`;

CREATE TABLE `mata_pelajaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(20) DEFAULT NULL,
  `mata_pelajaran` varchar(50) DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode` (`kode`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO `mata_pelajaran` (`id`, `kode`, `mata_pelajaran`) VALUES ('1', '01', 'Beginer 1D');
INSERT INTO `mata_pelajaran` (`id`, `kode`, `mata_pelajaran`) VALUES ('2', '02', 'Beginer 2D');
INSERT INTO `mata_pelajaran` (`id`, `kode`, `mata_pelajaran`) VALUES ('3', '03', 'Beginer 3D');
INSERT INTO `mata_pelajaran` (`id`, `kode`, `mata_pelajaran`) VALUES ('4', '04', 'Lego We Do');
INSERT INTO `mata_pelajaran` (`id`, `kode`, `mata_pelajaran`) VALUES ('5', '05', 'Basic Mechanic');


#
# TABLE STRUCTURE FOR: options
#

DROP TABLE IF EXISTS `options`;

CREATE TABLE `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `variable` varchar(255) DEFAULT NULL,
  `value` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

INSERT INTO `options` (`id`, `variable`, `value`) VALUES ('1', 'npsn', '100');
INSERT INTO `options` (`id`, `variable`, `value`) VALUES ('2', 'nama_sekolah', 'Inorobo Robotic School');
INSERT INTO `options` (`id`, `variable`, `value`) VALUES ('3', 'jenjang', 'SD');
INSERT INTO `options` (`id`, `variable`, `value`) VALUES ('4', 'alamat', 'Ruko MIM Blok E/2 Soekarno Hatta No.590 Bandung.');
INSERT INTO `options` (`id`, `variable`, `value`) VALUES ('5', 'kelurahan', 'Sekejati');
INSERT INTO `options` (`id`, `variable`, `value`) VALUES ('6', 'kecamatan', 'Buah batu');
INSERT INTO `options` (`id`, `variable`, `value`) VALUES ('7', 'kabupaten', 'kota Bandung');
INSERT INTO `options` (`id`, `variable`, `value`) VALUES ('8', 'propinsi', 'Jawa Barat');
INSERT INTO `options` (`id`, `variable`, `value`) VALUES ('9', 'website', 'inorobo.com');
INSERT INTO `options` (`id`, `variable`, `value`) VALUES ('10', 'email', 'robot@ternama.net');
INSERT INTO `options` (`id`, `variable`, `value`) VALUES ('11', 'telp', '+62 852 942 487 83');
INSERT INTO `options` (`id`, `variable`, `value`) VALUES ('12', 'ptk_id', '4');
INSERT INTO `options` (`id`, `variable`, `value`) VALUES ('13', 'why_robotic', '<p><span style=\"font-family:tahoma,geneva,sans-serif\">Kemajuan ilmu pengetahuan dan teknologi khususnya teknologi mekatronika dan robotika saat ini sedemikian pesatnya. Hal ini dapat kita lihat dari banyaknya alat alat atau mesin yg berbentuk robot baik dalam skala kecil untuk keperluan rumah tangga maupun dalam skala besar untuk keperluan industri dan juga robot cerdas untuk keperluan dunia kedokteran.</span></p>\r\n\r\n<p><span style=\"font-family:tahoma,geneva,sans-serif\">Robot adalah sebuah mesin pintar, mesin yang bekerja secara otomatis karena telah diprogram untuk melakukan pekerjaan tertentu. Robot dibuat dengan tujuan untuk memudahkan pekerjaan manusia. Negara Jepang dan Korea adalah negara di wilayah Asia yg sangat intens mengembangkan peralatan robot. Di Indonesia meskipun baru belum semaju negara-negara seperti Jepang dan Korea saat ini telah banyak pihak yg melakukan pengembangan dunia robotik baik industri, lebaga pendidikan maupun swasta.</span></p>\r\n\r\n<p><span style=\"font-family:tahoma,geneva,sans-serif\">Inorobo Robotics School salah satu lembaga pendidikan non formal di bidang pengajaran teknologi robotik ingin ikut mengambil bagian berperan aktif dalam mengembangan dunia robotik di Indonesia.</span></p>\r\n\r\n<h1><span style=\"font-family:tahoma,geneva,sans-serif\">Manfaat belajar robotik :</span></h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<ul>\r\n	<li><span style=\"font-family:tahoma,geneva,sans-serif\">Mengasah kreatifitas</span></li>\r\n	<li><span style=\"font-family:tahoma,geneva,sans-serif\">Melatih daya imajinasi</span></li>\r\n	<li><span style=\"font-family:tahoma,geneva,sans-serif\">Mengasah logika</span></li>\r\n	<li><span style=\"font-family:tahoma,geneva,sans-serif\">Melatih problem solving</span></li>\r\n	<li><span style=\"font-family:tahoma,geneva,sans-serif\">Mengembangkan team work</span></li>\r\n	<li><span style=\"font-family:tahoma,geneva,sans-serif\">Menyalurkan hobby dan bakat</span></li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:tahoma,geneva,sans-serif\"><strong>Mahalkah biaya sekolah robot ?</strong><br />\r\nInvestasi sekolah robot tidak mahal dibanding dengan apa yang akan didapat siswa</span></p>\r\n\r\n<p><span style=\"font-family:tahoma,geneva,sans-serif\"><strong>Siapa saja yang bisa belajar robotik ?</strong></span></p>\r\n\r\n<ul>\r\n	<li><span style=\"font-family:tahoma,geneva,sans-serif\">Mulai usia SD sampai dewasa / umum</span></li>\r\n	<li><span style=\"font-family:tahoma,geneva,sans-serif\">Laki-laki / perempuan</span></li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:tahoma,geneva,sans-serif\"><strong>Mengapa perlu belajar robotik ?</strong><br />\r\nBelajar robotik bisa membangun karakter :</span></p>\r\n\r\n<ul>\r\n	<li><span style=\"font-family:tahoma,geneva,sans-serif\">Sabar</span></li>\r\n	<li><span style=\"font-family:tahoma,geneva,sans-serif\">Ulet</span></li>\r\n	<li><span style=\"font-family:tahoma,geneva,sans-serif\">Mental yang kuat</span></li>\r\n	<li><span style=\"font-family:tahoma,geneva,sans-serif\">Menyelesaikan problem</span></li>\r\n	<li><span style=\"font-family:tahoma,geneva,sans-serif\">Kerjasama yang baik</span></li>\r\n</ul>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><span style=\"font-family:tahoma,geneva,sans-serif\"><strong>Beberapa negara maju menargetkan Robotika sebagai kompetensi dasar -&nbsp;<span style=\"color:red\">4R : Reading, wRiting, aRithmetic, Robotic</span>.</strong></span><br />\r\n<span style=\"font-family:tahoma,geneva,sans-serif\"><a href=\"http://wartawarga.gunadarma.ac.id/2010/04/kompetensi-profesi-ti-di-negara-maju/\" style=\"border: 0px; margin: 0px; padding: 0px; outline: 0px; text-decoration: none; display: block; font-size: 12px; color: rgb(80, 80, 80); font-weight: bold;\">Kebutuhan kompetensi TI untuk profesi di negara maju</a></span></p>');
INSERT INTO `options` (`id`, `variable`, `value`) VALUES ('14', 'logo', '92fd20fb5db4afe978e87f2c234361e1.jpg');
INSERT INTO `options` (`id`, `variable`, `value`) VALUES ('15', 'ppdb_tahun', '2016');
INSERT INTO `options` (`id`, `variable`, `value`) VALUES ('16', 'ppdb_status', 'open');
INSERT INTO `options` (`id`, `variable`, `value`) VALUES ('17', 'header_image', '26262652bab461a9e177d6264dbdd372.png');
INSERT INTO `options` (`id`, `variable`, `value`) VALUES ('18', 'facebook', 'http://facebook.com');
INSERT INTO `options` (`id`, `variable`, `value`) VALUES ('19', 'twitter', '@inorobo');
INSERT INTO `options` (`id`, `variable`, `value`) VALUES ('20', 'youtube', 'http://youtube.com');
INSERT INTO `options` (`id`, `variable`, `value`) VALUES ('21', 'google_plus', 'enikdr@gmail.com');
INSERT INTO `options` (`id`, `variable`, `value`) VALUES ('22', 'yahoo', 'inorobo');
INSERT INTO `options` (`id`, `variable`, `value`) VALUES ('23', 'word_filter', '');
INSERT INTO `options` (`id`, `variable`, `value`) VALUES ('24', 'set_menu_label', '');
INSERT INTO `options` (`id`, `variable`, `value`) VALUES ('25', 'cache_file', 'n');
INSERT INTO `options` (`id`, `variable`, `value`) VALUES ('26', 'themes', 'default');
INSERT INTO `options` (`id`, `variable`, `value`) VALUES ('27', 'meta_keywords', 'Sekolah robotik, robotik bandung, eskul robotik, privat robotik, inorobo //');
INSERT INTO `options` (`id`, `variable`, `value`) VALUES ('28', 'meta_description', 'inorobo robotic school bandung, kelas privat dan menerima eskul disekolah');
INSERT INTO `options` (`id`, `variable`, `value`) VALUES ('29', 'google_map', '-6.940892, 107.658449');


#
# TABLE STRUCTURE FOR: pertanyaan
#

DROP TABLE IF EXISTS `pertanyaan`;

CREATE TABLE `pertanyaan` (
  `pertanyaan_id` int(11) NOT NULL AUTO_INCREMENT,
  `pertanyaan` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `status` enum('y','n') NOT NULL DEFAULT 'n',
  PRIMARY KEY (`pertanyaan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `pertanyaan` (`pertanyaan_id`, `pertanyaan`, `tanggal`, `status`) VALUES ('1', 'Apakah website ini bagus ?', '2016-04-30', 'y');


#
# TABLE STRUCTURE FOR: photo
#

DROP TABLE IF EXISTS `photo`;

CREATE TABLE `photo` (
  `photo_id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_title` text NOT NULL,
  `photo_thumb` varchar(255) DEFAULT NULL,
  `photo_original` varchar(255) NOT NULL,
  `album_id` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`photo_id`),
  KEY `album_id` (`album_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

INSERT INTO `photo` (`photo_id`, `photo_title`, `photo_thumb`, `photo_original`, `album_id`) VALUES ('1', '', 'fe8e7eb7a642c7fd1cddd0c6f85a30db.jpg', 'fe8e7eb7a642c7fd1cddd0c6f85a30db.jpg', '1');
INSERT INTO `photo` (`photo_id`, `photo_title`, `photo_thumb`, `photo_original`, `album_id`) VALUES ('3', '', '1bc1ab911ce352b9c001476ceecff61b.png', '1bc1ab911ce352b9c001476ceecff61b.png', '1');
INSERT INTO `photo` (`photo_id`, `photo_title`, `photo_thumb`, `photo_original`, `album_id`) VALUES ('8', '', '6f82c1564bbf0d060d69a8953b520590.jpg', '6f82c1564bbf0d060d69a8953b520590.jpg', '2');
INSERT INTO `photo` (`photo_id`, `photo_title`, `photo_thumb`, `photo_original`, `album_id`) VALUES ('9', '', '5375a75711c41bfc2cbd1cfb14e54087.jpg', '5375a75711c41bfc2cbd1cfb14e54087.jpg', '2');
INSERT INTO `photo` (`photo_id`, `photo_title`, `photo_thumb`, `photo_original`, `album_id`) VALUES ('10', '', '1ab575c0f67befa8404a08746ff65612.jpg', '1ab575c0f67befa8404a08746ff65612.jpg', '4');
INSERT INTO `photo` (`photo_id`, `photo_title`, `photo_thumb`, `photo_original`, `album_id`) VALUES ('11', '', '6b385aab469e2682d3e1c678d0b87d84.jpg', '6b385aab469e2682d3e1c678d0b87d84.jpg', '4');
INSERT INTO `photo` (`photo_id`, `photo_title`, `photo_thumb`, `photo_original`, `album_id`) VALUES ('12', '', '2b1521ac3512ffd078d106403576c6a7.jpg', '2b1521ac3512ffd078d106403576c6a7.jpg', '3');
INSERT INTO `photo` (`photo_id`, `photo_title`, `photo_thumb`, `photo_original`, `album_id`) VALUES ('13', '', '13f1cc266086c0f3b5d3e30981c177b4.jpg', '13f1cc266086c0f3b5d3e30981c177b4.jpg', '3');
INSERT INTO `photo` (`photo_id`, `photo_title`, `photo_thumb`, `photo_original`, `album_id`) VALUES ('14', '', 'd84b27022f0b375bab83b9c1a8aefe3a.jpg', 'd84b27022f0b375bab83b9c1a8aefe3a.jpg', '1');
INSERT INTO `photo` (`photo_id`, `photo_title`, `photo_thumb`, `photo_original`, `album_id`) VALUES ('15', '', '8a19527739cf80a6fcd638008b94494b.jpg', '8a19527739cf80a6fcd638008b94494b.jpg', '3');
INSERT INTO `photo` (`photo_id`, `photo_title`, `photo_thumb`, `photo_original`, `album_id`) VALUES ('16', '', '610e6b8fbb4111daad6ba535efd5bde2.jpg', '610e6b8fbb4111daad6ba535efd5bde2.jpg', '3');
INSERT INTO `photo` (`photo_id`, `photo_title`, `photo_thumb`, `photo_original`, `album_id`) VALUES ('17', '', 'b9614fc544964a2df891e4a4c208a869.jpg', 'b9614fc544964a2df891e4a4c208a869.jpg', '3');
INSERT INTO `photo` (`photo_id`, `photo_title`, `photo_thumb`, `photo_original`, `album_id`) VALUES ('18', '', 'f72ddff653a282ff17c5f4c0811dbeb3.jpg', 'f72ddff653a282ff17c5f4c0811dbeb3.jpg', '3');
INSERT INTO `photo` (`photo_id`, `photo_title`, `photo_thumb`, `photo_original`, `album_id`) VALUES ('19', '', 'd8faaaff81066a681e4eaa9ebcafb570.jpg', 'd8faaaff81066a681e4eaa9ebcafb570.jpg', '2');
INSERT INTO `photo` (`photo_id`, `photo_title`, `photo_thumb`, `photo_original`, `album_id`) VALUES ('20', '', '290cbdae66de377a0a5ad6d4ae7c7631.jpg', '290cbdae66de377a0a5ad6d4ae7c7631.jpg', '4');
INSERT INTO `photo` (`photo_id`, `photo_title`, `photo_thumb`, `photo_original`, `album_id`) VALUES ('21', '', '845d78e6f5bfa5ce82420bb5f6647774.jpg', '845d78e6f5bfa5ce82420bb5f6647774.jpg', '4');
INSERT INTO `photo` (`photo_id`, `photo_title`, `photo_thumb`, `photo_original`, `album_id`) VALUES ('22', '', 'aa7e1e761394247265f268c71e5e1093.jpg', 'aa7e1e761394247265f268c71e5e1093.jpg', '4');
INSERT INTO `photo` (`photo_id`, `photo_title`, `photo_thumb`, `photo_original`, `album_id`) VALUES ('23', '', '314d4406010d07ff749dac94ad2c6302.jpg', '314d4406010d07ff749dac94ad2c6302.jpg', '4');
INSERT INTO `photo` (`photo_id`, `photo_title`, `photo_thumb`, `photo_original`, `album_id`) VALUES ('24', '', '2ff77af91574c3c77464039c961838ee.jpg', '2ff77af91574c3c77464039c961838ee.jpg', '4');


#
# TABLE STRUCTURE FOR: polling
#

DROP TABLE IF EXISTS `polling`;

CREATE TABLE `polling` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jawaban_id` int(11) NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jawaban_id` (`jawaban_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO `polling` (`id`, `jawaban_id`, `ip_address`, `tanggal`) VALUES ('1', '4', '::1', '2016-07-14');
INSERT INTO `polling` (`id`, `jawaban_id`, `ip_address`, `tanggal`) VALUES ('2', '3', '::1', '2016-07-14');
INSERT INTO `polling` (`id`, `jawaban_id`, `ip_address`, `tanggal`) VALUES ('3', '2', '::1', '2016-07-14');


#
# TABLE STRUCTURE FOR: posts
#

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `post_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `post_title` varchar(255) NOT NULL,
  `post_date` date NOT NULL DEFAULT '0000-00-00',
  `post_type` enum('post','page','pengumuman','sekilas_info','sambutan_kepala_sekolah','prestasi_sekolah','prestasi_ptk','prestasi_siswa','agenda') NOT NULL DEFAULT 'post',
  `post_content` text NOT NULL,
  `user_id` bigint(20) DEFAULT '1',
  `post_parent` bigint(20) DEFAULT '0',
  `category_id` smallint(6) DEFAULT NULL,
  `post_image` varchar(100) DEFAULT NULL,
  `order_pages` smallint(6) NOT NULL DEFAULT '0',
  `slug` varchar(255) DEFAULT NULL,
  `counter` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`post_id`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

INSERT INTO `posts` (`post_id`, `post_title`, `post_date`, `post_type`, `post_content`, `user_id`, `post_parent`, `category_id`, `post_image`, `order_pages`, `slug`, `counter`) VALUES ('1', 'postingan ke 1', '2016-07-14', 'post', '<p>Ini adalah postingan pertama silahkan isi postingan ini.</p>', '1', '0', '2', 'e41a9557f05b46d5642b30ebd60b1189.jpg', '0', 'postingan-ke-1', '1');
INSERT INTO `posts` (`post_id`, `post_title`, `post_date`, `post_type`, `post_content`, `user_id`, `post_parent`, `category_id`, `post_image`, `order_pages`, `slug`, `counter`) VALUES ('2', 'postingan ke 2`', '2016-07-14', 'post', '<p>ini adalh postingan ke dua hanya untuk test post</p>', '1', '0', '1', 'de9d9dffa4f4a7619509acbacd2acaa1.jpg', '0', 'postingan-ke-2', NULL);
INSERT INTO `posts` (`post_id`, `post_title`, `post_date`, `post_type`, `post_content`, `user_id`, `post_parent`, `category_id`, `post_image`, `order_pages`, `slug`, `counter`) VALUES ('3', 'Trainer baru', '2016-07-14', 'pengumuman', '<p>akan diadakan pelatihan untuk trainer baru pada hari sabtu</p>', '1', '0', NULL, '26e6dba394ff44ad5a034e96e03b190b.jpg', '0', NULL, '1');
INSERT INTO `posts` (`post_id`, `post_title`, `post_date`, `post_type`, `post_content`, `user_id`, `post_parent`, `category_id`, `post_image`, `order_pages`, `slug`, `counter`) VALUES ('4', 'sekilah info', '2016-07-14', 'sekilas_info', 'test sekilas info', '1', '0', NULL, NULL, '0', NULL, NULL);
INSERT INTO `posts` (`post_id`, `post_title`, `post_date`, `post_type`, `post_content`, `user_id`, `post_parent`, `category_id`, `post_image`, `order_pages`, `slug`, `counter`) VALUES ('5', 'About Us', '2016-07-14', 'page', '<p>inorobo robotic shcool bandung adalah lembaga pendidikan non formal yang bergerak dibidang jasa kependidikan.</p>', '1', '0', NULL, NULL, '0', 'about-us', '2');
INSERT INTO `posts` (`post_id`, `post_title`, `post_date`, `post_type`, `post_content`, `user_id`, `post_parent`, `category_id`, `post_image`, `order_pages`, `slug`, `counter`) VALUES ('6', 'Company Profile', '2016-07-14', 'page', '<p>Introduction</p>\r\n\r\n<p>Inorobo didirikan pada tahun 2011. Lembaga&nbsp;ini bertujuan untuk membawa perubahan di jalur pendidikan dengan menerapkan tangan pada pengalaman belajar di sekolah sebagai bagian dari kegiatan kurikulum ekstra.<br />\r\nTim EDU360 terdiri dari para profesional dari berbagai bidang, yang meliputi engineering, IT dan latar belakang desain. direktur, Chaman Singh, Ng Ka Fai (Keff Ng), Mervin Vijay Raj, membawa seluruh perusahaan yang berbasis pada motto yang mereka pikir itu tidak mungkin.<br />\r\nDengan pengalaman bersama lebih dari 15 tahun, tim di EDU360 didukung oleh misinya yaitu untuk menginspirasi anak muda untuk menjadi ilmu pengetahuan dan teknologi pemimpin, dengan melibatkan mereka dalam program-program berbasis mentor menarik yang membangun ilmu pengetahuan, teknik dan teknologi keterampilan, yang menginspirasi inovasi, dan yang mendorong baik-bulat kemampuan hidup termasuk kepercayaan diri, komunikasi, dan kepemimpinan.<br />\r\n&nbsp;<br />\r\nMotto kami</p>\r\n\r\n<p>Moto perusahaan, &quot;Memberdayakan Minds Muda&quot; yang dicita-citakan untuk membawa perubahan dalam pendekatan pembelajaran tradisional, dengan menciptakan pengalaman interaktif dan menghasut, dengan pendekatan modern yang lengkap.<br />\r\n&nbsp;<br />\r\nApa yang kita lakukan</p>\r\n\r\n<p>Saat ini, EDU360 mengkhususkan diri dalam melakukan Robotika dan kelas Animation, yang di antara ide-ide didekati terbaru pada anak-anak hari ini. silabus pembelajaran termasuk belajar keterampilan motorik, mekanisme, pemrograman, mesin sederhana, menggambar kreatif 2D dan editing suara.<br />\r\n&nbsp;EDU360 juga menyediakan layanan TI yang terkait untuk usaha kecil dan sekolah.<br />\r\n&nbsp;<br />\r\nMilestones kami &amp; Medali</p>\r\n\r\n<p>2010-2012<br />\r\nCelcom Pemuda 10 &#39;Festival Pemuda Tahap Penyajian dan demostration tentang&#39; Tujuan Robotika &#39;sebelum Menteri Pendidikan Dato&#39; Shaifuddin Abdullah<br />\r\nY! Majalah - &#39;Edu 360&#39; Ditampilkan dalam Page 24<br />\r\nRTM &#39;Hello atas 2&#39; - Live - Pengenalan Robotika Talk Show<br />\r\nGuinesse World Book of Record Mencoba - Sebagian jumlah Robot menari bersama-sama.<br />\r\nTerorganisir Childrens Charity event di bawah CSR Sponsorship Perusahaan<br />\r\n2013<br />\r\nASTRO Ch. 325 - &quot;Aku ingin tahu mengapa 2 &#39;Episode On Belajar Robotika<br />\r\nCHAMPIONS - Intel &#39;Level-Up&#39; Persaingan Usaha - http://technave.com/gadget/Intel-Malaysia-Level-Up-Your-Business-winners-get-RM30000-worth-Tech-Boosts-4666.html<br />\r\nFitur Worldwide Intel International sebagai Studi Kasus tentang Teknologi untuk Anak - http://smb.intel.sg/insights/case-study/edu360<br />\r\nDimulainya Kompetisi EDU360 Arena Bot Inter-Sekolah<br />\r\n2014<br />\r\nCHAMPION - Nasional Robotika Competiton (NRC) - Selangor Negara<br />\r\nCHAMPION - Nasional Robotika Competiton (NRC) - Tingkat Nasional<br />\r\nDunia Robotika Olympiad (WRO) (Sochi, Rusia) - Tempat 6<br />\r\nB.FM 89.9 - Live - Tek Bicara tentang EDU360 Academy Robotika &amp; Animation - http://www.bfm.my/tech-talk-intel-level-up-2014.html<br />\r\nNew Straites Kali Koran - 1 Full Page - &#39;Talent untuk Robotika&#39; - Page 3 - http://www.nst.com.my/news/2015/09/family-talent-robotics<br />\r\nMenjadi Official LEGO&reg; Pendidikan &amp; LEGO&reg; Mindstorms&reg; Pendidikan Dealer.<br />\r\n2015<br />\r\nCHAMPION - Nasional Robotika Competiton (NRC) - Selangor Negara<br />\r\nCHAMPION - Nasional Robotika Competiton (NRC) - Tingkat Nasional<br />\r\nDunia Robotika Olympiad (WRO) (Doha, Qatar) - CHAMPION<br />\r\nCHAMPION - SK St. Anne (Labuan) Kompetisi SumoBot<br />\r\nThe Star koran-koran 1/2 Halaman - &#39;Robots Lead Jalan&#39;<br />\r\nFokus Malaysia Koran - 2 Full Pages - &#39;Tempa 360 Pendidikan&#39; - http://focusweek.my/Article.aspx?ArticleId=15016<br />\r\nMajalah manajemen - 5 penuh Pages - &#39;The Yin dan Yang dari EDU360&#39; -<br />\r\nEDU360 Bangga disponsori 12 Underpriviledge siswa dari Rumah Amal Telaga Kasih untuk belajar LEGO Robotika.</p>\r\n\r\n<p>fakta menarik lain dari perusahaan termasuk yang ditampilkan dalam Bernama Berita, Umum Tahap Robotika Demonstrasi, yang disponsori oleh Y! Majalah, Hello di Dua Program TV2, panggung berbicara dengan Wakil Menteri Pendidikan Datuk Saifuddin Abdullah, di Youth&#39;10 Festival, dan menginspirasi anak-anak Kepemimpinan Camp.<br />\r\nSekarang, kami menawarkan robotika dan kelas animasi untuk lebih daerah yang meliputi Kelana Jaya Zenith perusahaan parkir (belakang mall paradigma), pusat Cheras Globalart dan Kota Damansara (Near Sunway Giza Mall) dan segera hadir di Klang. Pusat Robotika Anak-anak kami cukup accesible ke Taman Tun, Shah Alam, Puchong, Mont Kiara Hartamas dan keluarga Petaling Jaya.<br />\r\nAyo pengalaman menggambar digital dan membangun banyak robot! (Malaysia Anak / Anak-anak LEGO Robotika)</p>', '1', '5', NULL, NULL, '0', 'company-profile', '18');
INSERT INTO `posts` (`post_id`, `post_title`, `post_date`, `post_type`, `post_content`, `user_id`, `post_parent`, `category_id`, `post_image`, `order_pages`, `slug`, `counter`) VALUES ('7', 'Prog. Belajar', '2016-07-14', 'page', '<p>program belajar</p>', '1', '0', NULL, NULL, '0', 'prog-belajar', NULL);
INSERT INTO `posts` (`post_id`, `post_title`, `post_date`, `post_type`, `post_content`, `user_id`, `post_parent`, `category_id`, `post_image`, `order_pages`, `slug`, `counter`) VALUES ('8', 'Ekskul', '2016-07-14', 'page', '<p>Program ini untuk kegiatan Ektrakulikuler di sekolah, dimana para pengajar dari Inorobo Robotics School akan datang ke sekolah dengan membawa tool untuk proses perakitan dan pembelajaran robot.</p>\r\n\r\n<p>Dalam proses belajar/perakitan tool per kelompok</p>\r\n\r\n<p>Materi untuk SD dibedakan sesuai level klas 1 s/d klas 5</p>\r\n\r\n<table style=\"color:rgb(42, 42, 42); font-family:verdana,tahoma,arial,sans-serif; font-size:10.944px; line-height:normal\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Lama belajar</td>\r\n			<td>:</td>\r\n			<td>1 jam</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Periode</td>\r\n			<td>:</td>\r\n			<td>mingguan</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Pertemuan</td>\r\n			<td>:</td>\r\n			<td>28X dalam satu tahun ajaran</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Sifat</td>\r\n			<td>:</td>\r\n			<td>kelompok / team</td>\r\n		</tr>\r\n	</tbody>\r\n</table>', '1', '7', NULL, NULL, '0', 'ekskul', '12');
INSERT INTO `posts` (`post_id`, `post_title`, `post_date`, `post_type`, `post_content`, `user_id`, `post_parent`, `category_id`, `post_image`, `order_pages`, `slug`, `counter`) VALUES ('9', 'Private', '2016-07-14', 'page', '<p>Siswa datang ke tempat kursus tool sudah di sediakan.</p>\r\n\r\n<p>Tool sendiri-sendiri</p>\r\n\r\n<table style=\"color:rgb(42, 42, 42); font-family:verdana,tahoma,arial,sans-serif; font-size:10.944px; line-height:normal\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Lama belajar</td>\r\n			<td>:</td>\r\n			<td>75 menit</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Periode</td>\r\n			<td>:</td>\r\n			<td>mingguan (4X dalam sebulan / minggu ke-5 libur)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Sifat</td>\r\n			<td>:</td>\r\n			<td>privat / sendiri</td>\r\n		</tr>\r\n	</tbody>\r\n</table>', '1', '7', NULL, NULL, '0', 'private', '4');
INSERT INTO `posts` (`post_id`, `post_title`, `post_date`, `post_type`, `post_content`, `user_id`, `post_parent`, `category_id`, `post_image`, `order_pages`, `slug`, `counter`) VALUES ('10', 'online', '2016-07-14', 'page', '<p>Program belajar online sedang dalam proses..:)</p>', '1', '7', NULL, NULL, '0', 'online', '4');
INSERT INTO `posts` (`post_id`, `post_title`, `post_date`, `post_type`, `post_content`, `user_id`, `post_parent`, `category_id`, `post_image`, `order_pages`, `slug`, `counter`) VALUES ('11', 'Postingan ke 3', '2016-07-14', 'post', '<p>ini adalah tribot, robot ini bisa mengerjakan beberapa tugas</p>', '1', '0', '2', '648d7f3d9343b69a4ff908624c91cc47.png', '0', 'postingan-ke-3', '1');


#
# TABLE STRUCTURE FOR: ptk
#

DROP TABLE IF EXISTS `ptk`;

CREATE TABLE `ptk` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nik` varchar(100) DEFAULT NULL,
  `nip` varchar(100) DEFAULT NULL,
  `nuptk` varchar(100) DEFAULT NULL,
  `nama` varchar(100) NOT NULL DEFAULT '',
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL DEFAULT 'Laki-laki',
  `alamat` varchar(255) DEFAULT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(255) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT '0000-00-00',
  `pendidikan` smallint(6) NOT NULL DEFAULT '15',
  `jurusan` varchar(100) DEFAULT NULL,
  `status_kepegawaian` tinyint(2) DEFAULT '11',
  `jenis_ptk` tinyint(2) DEFAULT '11',
  `photo` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `ptk` (`id`, `nik`, `nip`, `nuptk`, `nama`, `jenis_kelamin`, `alamat`, `telp`, `email`, `tempat_lahir`, `tanggal_lahir`, `pendidikan`, `jurusan`, `status_kepegawaian`, `jenis_ptk`, `photo`) VALUES ('2', '425', 'inorobo', '62', 'Yusran', 'Laki-laki', 'jl. kopo Gg. lapang III no.16', '+628983875219', 'yuz.antiexe@gmail.com', 'Bandung', '1992-06-20', '15', 'Manajemen Sumber Daya Manusia', '2', '6', 'c6d1cadfd4a81d313f3189b41c6601e3.png');
INSERT INTO `ptk` (`id`, `nik`, `nip`, `nuptk`, `nama`, `jenis_kelamin`, `alamat`, `telp`, `email`, `tempat_lahir`, `tanggal_lahir`, `pendidikan`, `jurusan`, `status_kepegawaian`, `jenis_ptk`, `photo`) VALUES ('3', '123', 'inorobo1', '1234', 'Tiara khiyaarunnisa', 'Perempuan', 'jl. Nagrog1 no.5 rt/tw 03/07 Ujungb berung BAndung', '+628112319794', 'tiara.inorobo@gmail.com', 'Bandung', '1993-07-09', '6', 'Teknik Kimia', '2', '2', 'c74e4bfd57a7a0570450c54a9beb44c5.jpg');
INSERT INTO `ptk` (`id`, `nik`, `nip`, `nuptk`, `nama`, `jenis_kelamin`, `alamat`, `telp`, `email`, `tempat_lahir`, `tanggal_lahir`, `pendidikan`, `jurusan`, `status_kepegawaian`, `jenis_ptk`, `photo`) VALUES ('4', '1234', 'inorobo1w', '12344', 'Inorobo Robotics School', 'Laki-laki', 'Ruko Inorobo Robotic School MIM Blok E/2 Soekarno Hatta No.590 Bandung.', '+62 852 942 487', 'inorobogc@gmail.com', 'Bandung', '2010-08-06', '22', '', '4', '6', '0cb527a0ed442286904d6c6cb73b56d9.jpg');


#
# TABLE STRUCTURE FOR: siswa
#

DROP TABLE IF EXISTS `siswa`;

CREATE TABLE `siswa` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `no_daftar` varchar(10) DEFAULT NULL,
  `nis` varchar(50) DEFAULT NULL,
  `nisn` varchar(100) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `kelas_id` smallint(6) DEFAULT NULL,
  `status_siswa` enum('baru','aktif','pindah','dropout','lulus') NOT NULL DEFAULT 'aktif',
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT '0000-00-00',
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL DEFAULT 'Laki-Laki',
  `agama` enum('Islam','Kristen','Katholik','Hindu','Budha') NOT NULL DEFAULT 'Islam',
  `status_anak` enum('Anak Kandung','Anak Angkat') NOT NULL DEFAULT 'Anak Kandung',
  `anak_ke` smallint(6) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `telp_rumah` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `sekolah_asal` varchar(100) DEFAULT NULL,
  `diterima_dikelas` smallint(6) DEFAULT NULL,
  `pada_tanggal` date DEFAULT '0000-00-00',
  `ayah` varchar(100) DEFAULT NULL,
  `ibu` varchar(100) DEFAULT NULL,
  `alamat_ortu` varchar(255) DEFAULT NULL,
  `telp_ortu` varchar(50) DEFAULT NULL,
  `pekerjaan_ayah` varchar(255) DEFAULT NULL,
  `pekerjaan_ibu` varchar(255) DEFAULT NULL,
  `nama_wali` varchar(100) DEFAULT NULL,
  `alamat_wali` varchar(255) DEFAULT NULL,
  `telp_wali` varchar(50) DEFAULT NULL,
  `pekerjaan_wali` varchar(255) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `jalur_pendaftaran_id` smallint(6) DEFAULT NULL,
  `tanggal_daftar` date DEFAULT '0000-00-00',
  `pilihan_1` smallint(6) DEFAULT NULL,
  `pilihan_2` smallint(6) DEFAULT NULL,
  `hasil_seleksi` varchar(100) DEFAULT NULL,
  `tahun_lulus` year(4) DEFAULT NULL,
  `pin_bb` varchar(20) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `aktivitas_sekarang` text,
  `twitter` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `diterima_dikelas` (`diterima_dikelas`),
  KEY `kelas_id` (`kelas_id`),
  KEY `jalur_pendaftaran_id` (`jalur_pendaftaran_id`),
  KEY `pilihan_1` (`pilihan_1`),
  KEY `pilihan_2` (`pilihan_2`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO `siswa` (`id`, `no_daftar`, `nis`, `nisn`, `nama`, `kelas_id`, `status_siswa`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `status_anak`, `anak_ke`, `alamat`, `telp_rumah`, `email`, `sekolah_asal`, `diterima_dikelas`, `pada_tanggal`, `ayah`, `ibu`, `alamat_ortu`, `telp_ortu`, `pekerjaan_ayah`, `pekerjaan_ibu`, `nama_wali`, `alamat_wali`, `telp_wali`, `pekerjaan_wali`, `photo`, `jalur_pendaftaran_id`, `tanggal_daftar`, `pilihan_1`, `pilihan_2`, `hasil_seleksi`, `tahun_lulus`, `pin_bb`, `facebook`, `aktivitas_sekarang`, `twitter`) VALUES ('1', '201600001', NULL, NULL, 'inorobo', NULL, 'baru', 'Bandung', '2021-03-12', 'Laki-Laki', 'Islam', 'Anak Kandung', '3', '1231', '091048', NULL, 'bandung 12', NULL, '0000-00-00', 'page', 'post', '123d', '097340', 'wirausaha', 'irt', '', '', '', '', 'f3f7f22e1482076d240ddfa3f33cd6af.jpg', NULL, '2016-07-14', NULL, NULL, 'belum_diseleksi', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `siswa` (`id`, `no_daftar`, `nis`, `nisn`, `nama`, `kelas_id`, `status_siswa`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `status_anak`, `anak_ke`, `alamat`, `telp_rumah`, `email`, `sekolah_asal`, `diterima_dikelas`, `pada_tanggal`, `ayah`, `ibu`, `alamat_ortu`, `telp_ortu`, `pekerjaan_ayah`, `pekerjaan_ibu`, `nama_wali`, `alamat_wali`, `telp_wali`, `pekerjaan_wali`, `photo`, `jalur_pendaftaran_id`, `tanggal_daftar`, `pilihan_1`, `pilihan_2`, `hasil_seleksi`, `tahun_lulus`, `pin_bb`, `facebook`, `aktivitas_sekarang`, `twitter`) VALUES ('2', '201600002', NULL, NULL, 'tiaara', NULL, 'baru', 'Bandung', '2012-03-12', 'Laki-Laki', 'Islam', 'Anak Kandung', '3', 'bojongsoang', '089123756', NULL, 'null', NULL, '0000-00-00', 'ayah tiata', 'ibu tiara', 'jl. bojongsiang', '09723847805', 'wirausaha', 'irt', '', '', '', '', '7c8dba5fb851076c5f4c5b79591ab0a6.jpg', NULL, '2016-07-14', NULL, NULL, 'belum_diseleksi', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `siswa` (`id`, `no_daftar`, `nis`, `nisn`, `nama`, `kelas_id`, `status_siswa`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `status_anak`, `anak_ke`, `alamat`, `telp_rumah`, `email`, `sekolah_asal`, `diterima_dikelas`, `pada_tanggal`, `ayah`, `ibu`, `alamat_ortu`, `telp_ortu`, `pekerjaan_ayah`, `pekerjaan_ibu`, `nama_wali`, `alamat_wali`, `telp_wali`, `pekerjaan_wali`, `photo`, `jalur_pendaftaran_id`, `tanggal_daftar`, `pilihan_1`, `pilihan_2`, `hasil_seleksi`, `tahun_lulus`, `pin_bb`, `facebook`, `aktivitas_sekarang`, `twitter`) VALUES ('3', '201600003', NULL, NULL, 'Test pendaftaran', NULL, 'baru', 'Bandung', '1994-04-25', 'Laki-Laki', 'Islam', 'Anak Kandung', '3', 'jl.test', '091048', NULL, 'tidak ada', NULL, '0000-00-00', 'ayah tiata', 'ibu tiara', 'jl. pendaftaran', '09723847805', 'wirausaha', 'irt', '', '', '', '', 'c8afbc77ffd40b9004411205d31780ad.jpg', NULL, '2016-07-18', NULL, NULL, 'belum_diseleksi', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `siswa` (`id`, `no_daftar`, `nis`, `nisn`, `nama`, `kelas_id`, `status_siswa`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `status_anak`, `anak_ke`, `alamat`, `telp_rumah`, `email`, `sekolah_asal`, `diterima_dikelas`, `pada_tanggal`, `ayah`, `ibu`, `alamat_ortu`, `telp_ortu`, `pekerjaan_ayah`, `pekerjaan_ibu`, `nama_wali`, `alamat_wali`, `telp_wali`, `pekerjaan_wali`, `photo`, `jalur_pendaftaran_id`, `tanggal_daftar`, `pilihan_1`, `pilihan_2`, `hasil_seleksi`, `tahun_lulus`, `pin_bb`, `facebook`, `aktivitas_sekarang`, `twitter`) VALUES ('4', '201600004', NULL, NULL, 'Yusran', NULL, 'baru', 'Bandung', '1992-06-20', 'Laki-Laki', 'Islam', 'Anak Kandung', '5', 'jl. kopo aoekarno Hatta bandung', '08983975219', NULL, 'BAndung', NULL, '0000-00-00', 'M Rizal', 'Juju Juariah', 'jl. kopo Gg. Lapang III Soekarmmo Hatta Bandung', '0226122715', 'Wiraswasta', 'IRT', '', '', '', '', '5da959200dce5b2b2c069ab401944504.jpg', NULL, '2016-08-08', NULL, NULL, 'belum_diseleksi', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `siswa` (`id`, `no_daftar`, `nis`, `nisn`, `nama`, `kelas_id`, `status_siswa`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `status_anak`, `anak_ke`, `alamat`, `telp_rumah`, `email`, `sekolah_asal`, `diterima_dikelas`, `pada_tanggal`, `ayah`, `ibu`, `alamat_ortu`, `telp_ortu`, `pekerjaan_ayah`, `pekerjaan_ibu`, `nama_wali`, `alamat_wali`, `telp_wali`, `pekerjaan_wali`, `photo`, `jalur_pendaftaran_id`, `tanggal_daftar`, `pilihan_1`, `pilihan_2`, `hasil_seleksi`, `tahun_lulus`, `pin_bb`, `facebook`, `aktivitas_sekarang`, `twitter`) VALUES ('5', '201600005', NULL, NULL, 'Yusran', NULL, 'baru', 'Bandung', '1992-06-20', 'Laki-Laki', 'Islam', 'Anak Kandung', '5', 'jl. kopo aoekarno Hatta bandung', '08983975219', NULL, 'BAndung', NULL, '0000-00-00', 'M Rizal', 'Juju Juariah', 'jl. kopo Gg. Lapang III Soekarmmo Hatta Bandung', '0226122715', 'Wiraswasta', 'IRT', '', '', '', '', '1a5c16ea43caee8de0e3a604d6f43208.jpg', NULL, '2016-08-08', NULL, NULL, 'belum_diseleksi', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `siswa` (`id`, `no_daftar`, `nis`, `nisn`, `nama`, `kelas_id`, `status_siswa`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `status_anak`, `anak_ke`, `alamat`, `telp_rumah`, `email`, `sekolah_asal`, `diterima_dikelas`, `pada_tanggal`, `ayah`, `ibu`, `alamat_ortu`, `telp_ortu`, `pekerjaan_ayah`, `pekerjaan_ibu`, `nama_wali`, `alamat_wali`, `telp_wali`, `pekerjaan_wali`, `photo`, `jalur_pendaftaran_id`, `tanggal_daftar`, `pilihan_1`, `pilihan_2`, `hasil_seleksi`, `tahun_lulus`, `pin_bb`, `facebook`, `aktivitas_sekarang`, `twitter`) VALUES ('6', '201600006', NULL, NULL, 'inorobo', NULL, 'baru', 'Bandung', '1992-01-23', 'Laki-Laki', 'Islam', 'Anak Kandung', '3', 'ruko mtc', '08987360008', NULL, 'bandung 12', NULL, '0000-00-00', 'Eman Suherman', 'Dewi Medyayanti', 'jl cimuncang', '09723847805', 'wirausaha', 'IRT', '', '', '', '', 'd07499f1b3c0aeb2af803872ac777a4f.jpg', NULL, '2016-08-09', NULL, NULL, 'belum_diseleksi', NULL, NULL, NULL, NULL, NULL);


#
# TABLE STRUCTURE FOR: tautan
#

DROP TABLE IF EXISTS `tautan`;

CREATE TABLE `tautan` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#
# TABLE STRUCTURE FOR: users
#

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('administrator','operator','ptk','siswa') NOT NULL DEFAULT 'operator',
  `last_logged_in` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ip_address` varchar(20) NOT NULL DEFAULT '0.0.0.0',
  `display_name` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `activation_key` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `username`, `password`, `level`, `last_logged_in`, `ip_address`, `display_name`, `email`, `activation_key`) VALUES ('1', 'inorobo', '$2y$10$.eyXCO.CSIiNyZBPlv8lweZjdH7YzQPbu5OjoihGAWPg/15bnwNni', 'administrator', '2016-08-09 21:27:15', '::1', 'Admin Inorobo', 'admin@gmail.com', NULL);
INSERT INTO `users` (`id`, `username`, `password`, `level`, `last_logged_in`, `ip_address`, `display_name`, `email`, `activation_key`) VALUES ('2', '425', '$2y$10$A9r3mjuW.e57pum8/0PGee//dCjKLzxJni73encKs8rIRBbNAjLsO', 'ptk', '0000-00-00 00:00:00', '0.0.0.0', NULL, NULL, NULL);
INSERT INTO `users` (`id`, `username`, `password`, `level`, `last_logged_in`, `ip_address`, `display_name`, `email`, `activation_key`) VALUES ('3', '123', '$2y$10$FSQrTVVr4siO2GvCut8WdO7/TnFE2uQ2WnRKSgh2YYbpdE3/xpiFm', 'ptk', '0000-00-00 00:00:00', '0.0.0.0', NULL, NULL, NULL);
INSERT INTO `users` (`id`, `username`, `password`, `level`, `last_logged_in`, `ip_address`, `display_name`, `email`, `activation_key`) VALUES ('4', '1234', '$2y$10$volsZvh3BLnayxYdxwKX4eVnrs49LCN./g..FMn6a3XhjLACyeHt2', 'ptk', '0000-00-00 00:00:00', '0.0.0.0', NULL, NULL, NULL);


#
# TABLE STRUCTURE FOR: video
#

DROP TABLE IF EXISTS `video`;

CREATE TABLE `video` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `unique_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

