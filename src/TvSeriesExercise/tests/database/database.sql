PRAGMA journal_mode = MEMORY;
PRAGMA synchronous = OFF;
PRAGMA foreign_keys = OFF;
PRAGMA ignore_check_constraints = OFF;
PRAGMA auto_vacuum = NONE;
PRAGMA secure_delete = OFF;
BEGIN TRANSACTION;

DROP TABLE IF EXISTS `tv_series`;

CREATE TABLE `tv_series` (
  `id` INTEGER PRIMARY KEY AUTOINCREMENT,
  `title` TEXT NOT NULL,
  `channel` TEXT NOT NULL,
  `gender` TEXT NOT NULL
);

INSERT INTO `tv_series` (`id`, `title`, `channel`, `gender`)
VALUES
    (1, 'Game of Thrones', 'HBO', 'drama'),
    (2, 'Breaking Bad', 'AMC', 'crime'),
    (3, 'Halt and Catch Fire', 'AMC', 'drama');

DROP TABLE IF EXISTS `tv_series_intervals`;

CREATE TABLE `tv_series_intervals` (
  `tv_series_id` INTEGER NOT NULL,
  `week_day` INTEGER NOT NULL,
  `show_time` TEXT NOT NULL,
  FOREIGN KEY (`tv_series_id`) REFERENCES `tv_series` (`id`) ON DELETE CASCADE
);

INSERT INTO `tv_series_intervals` (`tv_series_id`, `week_day`, `show_time`)
VALUES
    (1, 0, '21:00:00'),
    (1, 5, '18:00:00'),
    (2, 4, '13:00:00'),
    (2, 6, '20:00:00'),
    (3, 5, '14:00:00'),
    (3, 1, '22:00:00');

CREATE INDEX `tv_series_tv_series_title_index` ON `tv_series` (`title`);
CREATE INDEX `tv_series_intervals_tv_series_intervals_tv_series_id_foreign` ON `tv_series_intervals` (`tv_series_id`);

COMMIT;
PRAGMA ignore_check_constraints = ON;
PRAGMA foreign_keys = ON;
PRAGMA journal_mode = WAL;
PRAGMA synchronous = NORMAL;
