-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-07-2025 a las 21:13:46
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Artin_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart`
--

CREATE TABLE `cart` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `price` varchar(10) NOT NULL,
  `qty` varchar(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `price`, `qty`) VALUES
('4b1CDOdrPRt0JoKC5lNm', 'TAl1Ck3GFt1Bilg2sS64', 'JPrztZw0rmxzfr89iGpg', '20', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `message`
--

CREATE TABLE `message` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `subject`, `message`) VALUES
('EtY2g2H9Snr583y80e4r', 'ELKGnGt8Rypa2dsOZYiB', 'Camila', 'camila1@gmail.com', 'Sugerencias', 'Hola Hola soy un mensaje'),
('YYCJYQ9F0hWKjgMUjvUj', 'NcF48ItqHTGg8CSTr7q9', 'Marcos', 'testing@gmail.com', 'Sugerencias', 'Hola estoy probando la página'),
('gOyzjEmkioPpvQVXTpSH', 'y8eNbLQnDQmatLiE4dQX', 'Camila', 'camila@gmail.com', 'Sugerencias', 'Hola hola no me gusta el color');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `seller_id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `address_type` varchar(10) NOT NULL,
  `method` varchar(50) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `price` varchar(10) NOT NULL,
  `qty` varchar(2) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL DEFAULT 'in progress',
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `seller_id`, `name`, `number`, `email`, `address`, `address_type`, `method`, `product_id`, `price`, `qty`, `date`, `status`, `payment_status`) VALUES
('7EmyvOPsfuqgQBIlR4kj', 'y8eNbLQnDQmatLiE4dQX', 'AR7ktiueFqxTtsnzVuY1', 'Lucia Camila Madjarian', '1173611014', 'camila.madjarian@gmail.com', 'Aconquija 620, 123, 3_1770, Argentina, 1774', 'home', 'cash on delivery', 'JPrztZw0rmxzfr89iGpg', '20', '1', '2025-04-30', 'in progress', 'pending'),
('FMGlXcoVdzKuBNThvGph', 'ELKGnGt8Rypa2dsOZYiB', 'AR7ktiueFqxTtsnzVuY1', 'Julio', '1122334455', 'JulioLeppen@gmail.com', 'Av Corrientes 2343, Av Corrientes 2000, Buenos Aires, Argtentina, 1526', 'home', 'cash on delivery', 'Rp6ZMjRulaWhpR16cuZw', '20', '1', '2025-05-28', 'in progress', 'pending'),
('zw57ijA6htTWKMv6ctjO', 'ELKGnGt8Rypa2dsOZYiB', 'TirHYtp28OMPg1wgOhMi', 'Yo', '1524798633', 'camila1@gmail.com', 'Av siempreviva 1234, Av siempreviva 1234, Buenos Aires, Argentina, 1459', 'home', 'cash on delivery', 'HiJA3d49e5WysNuScTci', '22000', '1', '2025-05-28', 'in progress', 'complete'),
('E4Qr2YY3d4GSYIX6LY2W', 'NcF48ItqHTGg8CSTr7q9', 'vHzPzEr2CoB3GLU4fZIK', 'Marcos', '1122556644', 'testing@gmail.com', 'Florida 2525, Av Corrientes 2000, Buenos Aires , Argentina, 1626', 'home', 'net banking', 'irTt2KT6TxF8fpdxYbtk', '50', '3', '2025-07-09', 'in progress', 'pending'),
('xDIDivlOmIdp8VSOsaMG', 'y8eNbLQnDQmatLiE4dQX', 'TirHYtp28OMPg1wgOhMi', 'Lucia Camila Madjarian', '1173611014', 'camila.madjarian@gmail.com', 'Aconquija 620, , 3_1770, , 1774', 'home', 'cash on delivery', '309qIkyEmwcqVrajv5Gm', '30000', '1', '2025-07-11', 'in progress', 'pending'),
('MMiHgBVRyTBzDGCq2xHY', 'y8eNbLQnDQmatLiE4dQX', 'admin_id', 'Lucia Camila Madjarian', '1173611014', 'camila.madjarian@gmail.com', 'Aconquija 620, , 3_1770, , 1774', 'home', 'cash on delivery', 'cyVsYRDK7GUmTnDnpfGc', '8000', '1', '2025-07-11', 'in progress', 'Completado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` varchar(255) NOT NULL,
  `seller_id` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `stock` int(100) NOT NULL,
  `product_detail` varchar(500) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `seller_id`, `name`, `price`, `image`, `stock`, `product_detail`, `status`) VALUES
('NRhuqCoW0pBaDddju3OK', 'TirHYtp28OMPg1wgOhMi', 'Kefte', '22000', 'Kefte.jpg', 10, 'Kefte x 6 Unidades', 'active'),
('Muk8yaSbkwPfIWYQk9Jv', 'TirHYtp28OMPg1wgOhMi', 'Lemenyuh', '18000', 'Lemenyuh.jpg', 10, 'Lemenyuh x 3 unidades', 'active'),
('309qIkyEmwcqVrajv5Gm', 'TirHYtp28OMPg1wgOhMi', 'Pilaf de pollo', '30000', 'Pilaf.jpg', 10, 'Pilaf de pollo con trigo ', 'active'),
('BpWfkbmRW7BGwkVTeTLS', 'admin_id', 'Sfijas', '15000', 'sfijas.jpg', 10, '1 unidad', 'active'),
('cyVsYRDK7GUmTnDnpfGc', 'admin_id', 'Sarma', '8000', 'Sarma Grapes.jpg', 10, 'Apto vegano', 'deactive'),
('XjV1lrknDnR2nbsBTjOx', 'admin_id', 'khorovats', '20000', 'khorovats.jpg', 20, 'lomo de cerdo y pollo', 'active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sellers`
--

CREATE TABLE `sellers` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `image` varchar(100) NOT NULL,
  `is_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sellers`
--

INSERT INTO `sellers` (`id`, `name`, `email`, `password`, `image`, `is_admin`) VALUES
('88Ygt7tFppJPWBQ7NM3I', 'Camila', 'camilam@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'TL3KHdk6kvNI8TX5g79h.png', 0),
('FV4v2ZynUqxcE3EcPeJR', 'Julio', 'JulioLeppen@gmail.co', '8cb2237d0679ca88db6464eac60da96345513964', 'fHgNDdN38ETofnEj2o6v.png', 0),
('INevNJqOzWyIRLLRsAg5', 'Carlos', 'carlos@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'EFmnWiRogiHI6w2nUB6l.jpg', 0),
('admin_id', 'Admin', 'camila22@gmail.com', '$2y$10$cG1t6uXO/cA2hdpwxMuuyuFfPBS.PKS30qpT5BqHTjeB6IGXuhqg2', 'he2rA1FQteaOJDHuvxdt.jpeg', 1),
('cN7MKqxjgNXsTD1Bv302', 'Camila', 'camila123@gmail.com', '$2y$10$aQMPjbVBRpDBWDoEZK1egupcGqgMQh.HXBsA4yEjFx9Q670TV0Prq', '518151488_012c012ccc@2x.jpg', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`) VALUES
('9vDgMn82BNswp7zmhX23', 'Camila', 'camila1@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'hqMwHkdAFIqCSUFym05U.jpg'),
('y8eNbLQnDQmatLiE4dQX', 'Camila', 'camila@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'OJbmyJPhY9lCQ64vRRzE.jpeg'),
('ELKGnGt8Rypa2dsOZYiB', 'Camila', 'madjariancam@gmail.c', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '3klT8csBR41apphg8IZm.png'),
('NC0lEGOoErhK9ooKpPGj', 'Julio', 'julio@gmail.com', 'f7c3bc1d808e04732adf679965ccc34ca7ae3441', 'cLQLPwbe2iEYAj3emQlq.jpg'),
('NcF48ItqHTGg8CSTr7q9', 'Testing', 'testing@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'aFVp5ItRaF1JPUKPNS4x.jpg'),
('UMZovKhFJub7QOtUJLrP', 'Lucia', 'lucia@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'xKW3ztI2O7rHMgGIsT6P.jpg'),
('jrGso2ON4B4ZFD7irsQW', 'Ernesto', 'ernesto@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'kqFK8LlDhK3K1OZVrnZZ.jpg'),
('M0JuUCDxbZt9LYMILs6B', 'Enrique', 'Enrique@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'KcyXV0BbKoFUhhOYRCOx.png'),
('JLPDYHnxvnydmJNZIF1w', 'Lara', 'Lara@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'sFI4fF4kwlYrOUWup08B.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `wishlist`
--

CREATE TABLE `wishlist` (
  `id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `price`) VALUES
('fjJwqmiBRUoVtmfhcGdM', 'TAl1Ck3GFt1Bilg2sS64', 'Rp6ZMjRulaWhpR16cuZw', '20'),
('yxiJpnBvUg8HNbHMHA86', 'y8eNbLQnDQmatLiE4dQX', 'NRhuqCoW0pBaDddju3OK', '22000'),
('zTvVBagC7uY3atlHoMa1', 'y8eNbLQnDQmatLiE4dQX', 'Muk8yaSbkwPfIWYQk9Jv', '18000'),
('8XcbeJzOxEx8WV3FvMra', 'y8eNbLQnDQmatLiE4dQX', '309qIkyEmwcqVrajv5Gm', '30000');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
