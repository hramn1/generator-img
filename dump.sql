CREATE DATABASE imgtest
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;
  USE imgtest;
CREATE TABLE imgsize (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name CHAR(64),
 width INT,
 height INT
);
INSERT INTO imgsize (name, width, height)
VALUES
('big', 800, 600),
('med', 640, 480),
('min', 320, 240),
('mic', 150, 150);
