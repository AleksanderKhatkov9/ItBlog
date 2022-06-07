use blog;
create DATABASE blog;

CREATE TABLE blog.news (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `file`  VARCHAR(500) NOT NULL,
  `title` VARCHAR(500) NOT NULL,
  'description' LONGTEXT NOT NULL,
  `content` LONGTEXT NOT NULL,
  `date` VARCHAR(45) NOT NULL
);

CREATE TABLE blog.users (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `fio` VARCHAR(45) NOT NULL,
  `login` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `token` VARCHAR(100) NOT NULL,
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE blog.rules (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `rules_user` VARCHAR(45) NOT NULL,
  `rules_code` VARCHAR(45) NOT NULL
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE blog.users_rules (
  `users_id` INT PRIMARY KEY NOT NULL,
  `rules_id` INT NOT NULL
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- new version table blog.comments
CREATE TABLE blog.comments  (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `comments` TINYTEXT NOT NULL,
  `id_news` INT(11) NOT NULL,
  `date_com` VARCHAR(45) NOT NULL,
   `login` VARCHAR(45) NOT NULL,
   `fio` VARCHAR(45) NOT NULL,
  FOREIGN KEY (id_news)  REFERENCES news (id)
)ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- CREATE TABLE blog.comments  (
--   `id` INT PRIMARY KEY AUTO_INCREMENT,
--   `comments` TINYTEXT NOT NULL,
--   `id_news` INT(11) NOT NULL,
--   `date_com` VARCHAR(45) NOT NULL,
--   FOREIGN KEY (id_news)  REFERENCES news (id)
-- )ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



SELECT * FROM news JOIN comments ON news.id = comments.id_news;
SELECT * FROM news JOIN comments ON news.id = comments.id_news Where news.id=6;