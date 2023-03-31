/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump de tabela tv_series
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tv_series`;

CREATE TABLE `tv_series` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `channel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tv_series_title_index` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `tv_series` WRITE;
/*!40000 ALTER TABLE `tv_series` DISABLE KEYS */;

INSERT INTO `tv_series` (`id`, `title`, `channel`, `gender`)
VALUES
	(1,'Game of Thrones','HBO','drama'),
	(2,'Breaking Bad','AMC','crime'),
	(3,'Halt and Catch Fire','AMC','drama');

/*!40000 ALTER TABLE `tv_series` ENABLE KEYS */;
UNLOCK TABLES;


# Dump de tabela tv_series_intervals
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tv_series_intervals`;

CREATE TABLE `tv_series_intervals` (
  `tv_series_id` bigint unsigned NOT NULL,
  `week_day` tinyint unsigned NOT NULL COMMENT '0=Sunday, 1=Monday, 2=Tuesday, 3=Wednesday, 4=Thursday, 5=Friday, 6=Saturday',
  `show_time` time NOT NULL,
  KEY `tv_series_intervals_tv_series_id_foreign` (`tv_series_id`),
  CONSTRAINT `tv_series_intervals_tv_series_id_foreign` FOREIGN KEY (`tv_series_id`) REFERENCES `tv_series` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `tv_series_intervals` WRITE;
/*!40000 ALTER TABLE `tv_series_intervals` DISABLE KEYS */;

INSERT INTO `tv_series_intervals` (`tv_series_id`, `week_day`, `show_time`)
VALUES
	(1,0,'21:00:00'),
	(1,2,'18:00:00'),
	(2,4,'13:00:00'),
	(2,6,'20:00:00'),
	(3,5,'14:00:00'),
	(3,3,'22:00:00');

/*!40000 ALTER TABLE `tv_series_intervals` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
