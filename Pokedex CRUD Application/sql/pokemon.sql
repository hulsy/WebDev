/*
 * Student Name: Alex Hulford
 * Student Number: 041066068
 * Date: April 2, 2023
 * Description: Assignment 2 - Pokemon Database SQL Script for Creating Database and Table and Inserting Data
 */

CREATE DATABASE pokemon;
GRANT USAGE ON *.* TO 'appuser'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON pokemon.* TO 'appuser'@'localhost';
FLUSH PRIVILEGES;

USE pokemon;


CREATE TABLE IF NOT EXISTS `my_pokemon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `level` int(3) NOT NULL,
  `img` varchar(100),
  `date` varchar(30) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


INSERT INTO `my_pokemon` (`id`, `name`, `type`, `level`, `date`) VALUES
(1, 'Pikachu', 'Electric', 25,'2023-03-01'),
(2, 'Charazard', 'Fire', 71, '2023-03-01'),
(3, 'Bulbasaur', 'Grass', 45, '2023-03-01'),
(4, 'Squirtle', 'Water', 50, '2023-03-01'),
(5, 'Mewtwo', 'Psychic', 100, '2023-03-01');



