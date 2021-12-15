-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 15-12-2021 a las 16:18:47
-- Versión del servidor: 5.7.36-0ubuntu0.18.04.1
-- Versión de PHP: 7.2.24-0ubuntu0.18.04.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `admin_invernadero`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`admin_admin`@`localhost` PROCEDURE `actualizar_cantidad` (`n_cantidad` INT, `codigo` INT)  BEGIN
    	DECLARE nueva_existencia int;
        
        DECLARE cant_actual int;
        
        DECLARE actual_existencia int;
                
        SELECT cantidad INTO actual_existencia FROM registro_produccion WHERE idfrutilla = codigo;
        SET nueva_existencia = actual_existencia + n_cantidad;
        
        UPDATE registro_produccion SET cantidad = nueva_existencia, estado = 0 WHERE idfrutilla = codigo;
        
        SELECT nueva_existencia;
        
       
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `idcargo` int(11) NOT NULL,
  `cargo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`idcargo`, `cargo`) VALUES
(1, 'Administrador'),
(2, 'Jefe Cultivo'),
(3, 'Empleado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_sensores`
--

CREATE TABLE `datos_sensores` (
  `idarduino` int(11) NOT NULL,
  `idinvernadero` int(11) NOT NULL,
  `temperatura` float(4,2) NOT NULL,
  `humedad` float(4,2) NOT NULL,
  `riego` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datos_sensores`
--

INSERT INTO `datos_sensores` (`idarduino`, `idinvernadero`, `temperatura`, `humedad`, `riego`) VALUES
(1, 1, 72.00, 45.00, 1),
(2, 1, 50.00, 30.00, 1),
(3, 1, 50.00, 72.00, 0),
(4, 1, 55.00, 99.99, 0),
(5, 1, 50.00, 50.00, 0),
(6, 1, 30.00, 12.30, 1),
(7, 1, 25.68, 29.32, 1),
(8, 1, 25.20, 29.30, 0),
(9, 1, 65.00, 45.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `correlativo` int(11) NOT NULL,
  `idfrutilla` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cantidad` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`correlativo`, `idfrutilla`, `fecha`, `cantidad`, `usuario_id`, `estado`) VALUES
(1, 3, '2020-05-20 14:37:35', 0, 3, 1),
(2, 4, '2020-05-21 16:33:27', 0, 3, 1),
(3, 5, '2020-11-20 11:21:33', 0, 1, 1),
(4, 6, '2020-11-20 11:54:38', 0, 1, 1),
(5, 7, '2020-11-20 12:07:16', 0, 1, 1),
(6, 8, '2020-12-04 14:43:42', 0, 3, 1),
(7, 9, '2020-12-11 13:20:44', 0, 3, 1),
(8, 1, '2021-12-11 03:06:58', 10, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `espacios`
--

CREATE TABLE `espacios` (
  `ides` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `disponible` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `espacios`
--

INSERT INTO `espacios` (`ides`, `numero`, `disponible`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 1),
(7, 7, 1),
(8, 8, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `color` varchar(255) NOT NULL,
  `textColor` varchar(255) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `title`, `descripcion`, `color`, `textColor`, `start`, `end`) VALUES
(1, 'Mantenimiento Sensor', 'cambiar sensor de temperatura', '#FF0F0', '#FFFFFF', '2020-06-07 00:00:00', '2020-06-10 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invernadero`
--

CREATE TABLE `invernadero` (
  `idinvernadero` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `ubicacion` varchar(100) NOT NULL,
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estatus` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `invernadero`
--

INSERT INTO `invernadero` (`idinvernadero`, `idusuario`, `nombre`, `ubicacion`, `date_add`, `estatus`) VALUES
(1, 3, 'Frutillas', 'Al fondo a la derecha', '2020-05-10 21:37:10', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invernaderos`
--

CREATE TABLE `invernaderos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ubicacion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `invernaderos`
--

INSERT INTO `invernaderos` (`id`, `nombre`, `ubicacion`, `created_at`, `updated_at`) VALUES
(1, 'Frutillita 1', 'El alto', NULL, '2020-04-23 00:19:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mqtt_acl`
--

CREATE TABLE `mqtt_acl` (
  `id` int(11) UNSIGNED NOT NULL,
  `allow` int(1) DEFAULT NULL COMMENT '0: deny, 1: allow',
  `ipaddr` varchar(60) DEFAULT NULL COMMENT 'IpAddress',
  `username` varchar(100) DEFAULT NULL COMMENT 'Username',
  `clientid` varchar(100) DEFAULT NULL COMMENT 'ClientId',
  `access` int(2) NOT NULL COMMENT '1: subscribe, 2: publish, 3: pubsub',
  `topic` varchar(100) NOT NULL DEFAULT '' COMMENT 'Topic Filter'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mqtt_acl`
--

INSERT INTO `mqtt_acl` (`id`, `allow`, `ipaddr`, `username`, `clientid`, `access`, `topic`) VALUES
(1, 1, NULL, '$all', NULL, 2, '#'),
(2, 0, NULL, '$all', NULL, 1, '$SYS/#'),
(3, 0, NULL, '$all', NULL, 1, 'eq #'),
(5, 1, '127.0.0.1', NULL, NULL, 2, '$SYS/#'),
(6, 1, '127.0.0.1', NULL, NULL, 2, '#'),
(7, 1, NULL, 'dashboard', NULL, 1, '$SYS/#');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mqtt_user`
--

CREATE TABLE `mqtt_user` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `is_superuser` tinyint(1) DEFAULT '0',
  `created` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mqtt_user`
--

INSERT INTO `mqtt_user` (`id`, `username`, `password`, `salt`, `is_superuser`, `created`) VALUES
(1, 'david', 'david', NULL, 0, '2021-11-17 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_produccion`
--

CREATE TABLE `registro_produccion` (
  `idfrutilla` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `idinvernadero` int(11) NOT NULL,
  `tiempoCosecha` int(11) NOT NULL,
  `dia_siembra` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dia_cosecha` date NOT NULL,
  `temperatura` float(4,2) NOT NULL,
  `humedad` float(4,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `diasrestantes` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `estado` int(11) NOT NULL DEFAULT '1',
  `eliminar` int(11) NOT NULL DEFAULT '1',
  `espacio` int(11) NOT NULL,
  `textColor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `registro_produccion`
--

INSERT INTO `registro_produccion` (`idfrutilla`, `usuario_id`, `idinvernadero`, `tiempoCosecha`, `dia_siembra`, `dia_cosecha`, `temperatura`, `humedad`, `cantidad`, `diasrestantes`, `descripcion`, `estado`, `eliminar`, `espacio`, `textColor`) VALUES
(1, 3, 1, 10, '2020-05-14 20:32:22', '2020-05-24', 10.00, 10.00, 12, 0, '', 1, 1, 1, '#FFFFFF'),
(2, 3, 1, 18, '2020-05-14 21:37:12', '2020-08-14', 23.00, 12.00, 26, 0, '', 1, 1, 2, ''),
(3, 3, 1, 10, '2020-05-20 14:37:35', '2020-08-20', 20.00, 20.00, 25, 0, '', 1, 1, 3, ''),
(4, 3, 1, 12, '2020-05-21 16:33:27', '2020-11-06', 12.00, 12.00, 85, 0, '', 0, 1, 4, ''),
(5, 1, 1, 8, '2020-11-20 11:21:33', '2020-12-01', 18.00, 45.00, 26, 0, '2 salieron podridas', 0, 1, 4, '#FFFFFF'),
(6, 1, 1, 12, '2020-11-20 11:54:38', '2021-12-10', 18.00, 45.00, 12, 0, 'todas salieron bien', 0, 1, 2, '#FFFFFF'),
(7, 1, 1, 5, '2021-11-20 12:07:16', '2021-12-04', 18.00, 45.00, 10, 0, 'Frutillas todas correctas', 0, 1, 1, '#FFFFFF'),
(8, 3, 1, 45, '2021-12-04 14:43:42', '2021-12-26', 18.00, 45.00, 12, 0, 'Frutillas en germinaciÃ³n', 0, 1, 1, '#FFFFFF'),
(9, 3, 1, 12, '2021-12-11 13:20:44', '2021-12-26', 18.00, 45.00, 89, 0, 'Frutillas en germinaciÃ³n', 0, 1, 2, '#FFFFFF');

--
-- Disparadores `registro_produccion`
--
DELIMITER $$
CREATE TRIGGER `entradas_A_I` AFTER INSERT ON `registro_produccion` FOR EACH ROW BEGIN
 	INSERT INTO entradas(idfrutilla, cantidad, usuario_id)
    VALUES(new.idfrutilla, new.cantidad, new.usuario_id);
 END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `id` int(11) NOT NULL,
  `comando` text NOT NULL,
  `respuesta` text NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salida`
--

CREATE TABLE `salida` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cantidad` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `idfrutilla` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguridad`
--

CREATE TABLE `seguridad` (
  `id` int(11) NOT NULL,
  `fotografía` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuarioid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sensor`
--

CREATE TABLE `sensor` (
  `id` int(11) NOT NULL,
  `temperatura` float(4,2) NOT NULL,
  `humedad` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `riego` int(11) NOT NULL,
  `ventilador` int(11) NOT NULL,
  `foco_noche` int(11) NOT NULL,
  `foco_seco` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `sensor`
--

INSERT INTO `sensor` (`id`, `temperatura`, `humedad`, `fecha`, `riego`, `ventilador`, `foco_noche`, `foco_seco`) VALUES
(1, 25.00, 85, '2021-11-20 17:16:54', 1, 1, 1, 1),
(2, 21.00, 95, '2021-11-20 17:17:22', 0, 0, 0, 0),
(3, 21.00, 100, '2021-11-20 17:18:33', 0, 0, 1, 0),
(4, 20.00, 150, '2021-11-20 17:28:52', 0, 0, 0, 0),
(5, 19.00, 100, '2021-11-20 18:09:23', 0, 0, 0, 0),
(6, 21.00, 100, '2021-11-20 18:09:43', 0, 0, 0, 0),
(7, 21.00, 100, '2021-11-20 18:09:54', 0, 0, 1, 0),
(8, 21.00, 100, '2021-11-20 18:10:14', 0, 1, 0, 0),
(9, 18.00, 100, '2021-11-20 18:10:31', 0, 0, 0, 0),
(10, 19.00, 100, '2021-11-20 18:10:48', 0, 0, 0, 0),
(11, 18.00, 100, '2021-11-20 18:10:59', 0, 0, 0, 0),
(12, 17.00, 100, '2021-11-20 18:11:07', 0, 0, 0, 0),
(13, 18.00, 100, '2021-12-04 17:45:08', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `cargo` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `celular` int(11) NOT NULL,
  `genero` int(11) NOT NULL,
  `foto` text,
  `estado` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `cargo`, `nombre`, `apellido`, `usuario`, `password`, `celular`, `genero`, `foto`, `estado`) VALUES
(1, 1, 'David', 'Pinto Saavedra', 'david', '172522ec1028ab781d9dfd17eaca4427', 76275987, 1, 'img_producto.png', 1),
(2, 1, 'Sebastian', 'Perez Gutierrez', 'sebas', '4d6993543cd9203435aa92560d5aaba1', 7528864, 2, 'img_producto.png', 1),
(3, 1, 'Fernando ', 'Murguia', 'Fernando', 'cebdd715d4ecaafee8f147c2e85e0754', 76587841, 3, 'img_producto.png', 1),
(4, 2, 'Alguien', 'Nombre', 'Alguien', '7815696ecbf1c96e6894b779456d330e', 123, 1, 'img_producto.png', 1),
(5, 1, 'asda', 'asfas', 'bjsdbfjh', '24357c8440cb1a296ef06a4f0826460e', 123165465, 1, 'img_producto.png', 1),
(6, 1, 'asdva', 'sasj', 'kkjasbn', '1bceebf8d874660d9c29457c830e9dbe', 54687686, 1, 'img_producto.png', 1),
(7, 1, 'asdc', 'asd', 'asd', '7815696ecbf1c96e6894b779456d330e', 456132, 1, 'img_producto.png', 1),
(8, 1, 'bhbj', 'klkjl', 'jlkjsld', 'cf52a88a8f44f922637d53a49ceebc50', 456789, 3, 'img_producto.png', 1),
(9, 1, 'bhjhbhj', 'bjkbsjdb', 'bjkbasdkjf', '13bee1c5f5928c660fb2c00ce8964cf4', 125, 1, 'img_producto.png', 1),
(10, 1, 'sdas', 'asdas', 'afasfa', '5056c14f303fabcc8e0b4f90d5ccb900', 256456465, 1, 'img_producto.png', 1),
(11, 1, 'bhjbhjb', 'ioioioirq', 'oiyu', '7d1435bda821791b99b65df9a8491741', 7896546, 1, 'img_producto.png', 1),
(12, 3, 'sdas', 'hghhtet', 'sdf', '84d9cfc2f395ce883a41d7ffc1bbcf4e', 564654, 3, 'img_producto.png', 1),
(13, 3, 'poior', 'vidaurre', 'Vida', 'e71bd1525007dd7221a3c8a8187eefeb', 4561123, 3, 'img_producto.png', 1),
(14, 1, 'adsaaa', 'juliana', 'juli', '87359bbec7574c911493bd02e239f2ce', 445578, 3, 'img_producto.png', 1),
(15, 2, 'kjjjkjk', 'jjkjkjk', 'jkjkjk', '4ac3c7989fc9f5e7866ffbd90e0038dd', 44666465, 3, 'img_producto.png', 1),
(16, 2, 'asbkb', 'kbkbk', 'bkbjbkj', '162655150fe374623d791bb79075d35e', 4654651, 3, 'img_producto.png', 1),
(17, 1, 'asd', 'asd', 'sad', 'd1028fe4e017e65d1a840ad32851f151', 1231654654, 3, 'img_d07eab8217b7327778397bc6bde80f88.jpg', 1),
(18, 1, 'Mariano', 'Bondar', 'Mari', 'd40b913237b22c538b948e7e44aeb9cf', 7456512, 2, 'img_producto.png', 1),
(19, 1, 'Fernando', 'Hinojosa', 'hinojosa', '0fcfe249cf1f2c42bf15a36a19301ef8', 76411878, 2, 'img_producto.png', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`idcargo`);

--
-- Indices de la tabla `datos_sensores`
--
ALTER TABLE `datos_sensores`
  ADD PRIMARY KEY (`idarduino`),
  ADD KEY `idinvernadero` (`idinvernadero`);

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`correlativo`),
  ADD KEY `idfrutilla` (`idfrutilla`),
  ADD KEY `idfrutilla_2` (`idfrutilla`),
  ADD KEY `usuarioid` (`usuario_id`);

--
-- Indices de la tabla `espacios`
--
ALTER TABLE `espacios`
  ADD PRIMARY KEY (`ides`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `invernadero`
--
ALTER TABLE `invernadero`
  ADD PRIMARY KEY (`idinvernadero`),
  ADD KEY `idusuario` (`idusuario`);

--
-- Indices de la tabla `invernaderos`
--
ALTER TABLE `invernaderos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mqtt_acl`
--
ALTER TABLE `mqtt_acl`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mqtt_user`
--
ALTER TABLE `mqtt_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mqtt_username` (`username`);

--
-- Indices de la tabla `registro_produccion`
--
ALTER TABLE `registro_produccion`
  ADD PRIMARY KEY (`idfrutilla`),
  ADD KEY `idusuario` (`usuario_id`),
  ADD KEY `idinvernadero` (`idinvernadero`),
  ADD KEY `idusuario_2` (`usuario_id`),
  ADD KEY `espacio` (`espacio`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `salida`
--
ALTER TABLE `salida`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `idfrutilla` (`idfrutilla`);

--
-- Indices de la tabla `seguridad`
--
ALTER TABLE `seguridad`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sensor`
--
ALTER TABLE `sensor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `cargo` (`cargo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `idcargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `datos_sensores`
--
ALTER TABLE `datos_sensores`
  MODIFY `idarduino` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `correlativo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `espacios`
--
ALTER TABLE `espacios`
  MODIFY `ides` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `invernadero`
--
ALTER TABLE `invernadero`
  MODIFY `idinvernadero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `mqtt_acl`
--
ALTER TABLE `mqtt_acl`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `mqtt_user`
--
ALTER TABLE `mqtt_user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `registro_produccion`
--
ALTER TABLE `registro_produccion`
  MODIFY `idfrutilla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
