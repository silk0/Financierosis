-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-01-2021 a las 05:02:10
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `finanzadb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `kardex`
--

CREATE TABLE `kardex` (
  `id_kardex` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `movimiento` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `vunitario` float NOT NULL,
  `cantidads` int(11) NOT NULL,
  `vunitarios` float NOT NULL,
  `vtotals` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `kardex`
--

INSERT INTO `kardex` (`id_kardex`, `id_producto`, `fecha`, `descripcion`, `movimiento`, `cantidad`, `vunitario`, `cantidads`, `vunitarios`, `vtotals`) VALUES
(3, 5, '2021-01-07', 'Primer ingreso de productos.', 1, 10, 100, 10, 100, 1000),
(4, 5, '2021-01-07', 'Devolucion de producto.', 2, 10, 100, 0, 0, 0),
(5, 3, '2021-01-16', 'Venta  No.000023 al contado.', 2, 50, 100, 150, 100, 15000),
(6, 4, '2021-01-16', 'Venta  No.000023 al contado.', 2, 50, 400, 100, 400, 40000),
(8, 3, '2021-01-16', 'Venta  No.000024 al contado.', 2, 5, 100, 145, 100, 14500),
(9, 3, '2021-01-16', 'Venta  No.000025 al contado.', 2, 5, 100, 140, 100, 14000),
(10, 3, '2021-01-16', 'Venta  No.000026 al contado.', 2, 5, 100, 135, 100, 13500),
(11, 3, '2021-01-16', 'Venta  No.000027 al contado.', 2, 1, 100, 134, 100, 13400),
(12, 3, '2021-01-17', 'Venta  No.000029 al credito.', 2, 1, 100, 133, 100, 13300),
(13, 5, '2021-01-18', 'Compra de productos factura No.', 1, 10, 5, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tactivo`
--

CREATE TABLE `tactivo` (
  `id_activo` int(10) NOT NULL,
  `id_tipo` int(10) NOT NULL,
  `id_departamento` int(10) NOT NULL,
  `id_encargado` int(10) NOT NULL,
  `id_proveedor` int(10) NOT NULL,
  `correlativo` varchar(50) NOT NULL,
  `fecha_adquisicion` date NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `precio` double NOT NULL,
  `marca` varchar(50) NOT NULL,
  `depreciacionacum` double NOT NULL,
  `tipo_adquicicion` varchar(50) NOT NULL,
  `vidaUtil` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tactivo`
--

INSERT INTO `tactivo` (`id_activo`, `id_tipo`, `id_departamento`, `id_encargado`, `id_proveedor`, `correlativo`, `fecha_adquisicion`, `descripcion`, `estado`, `precio`, `marca`, `depreciacionacum`, `tipo_adquicicion`, `vidaUtil`) VALUES
(1, 1, 1, 1, 1, '101-201 - 301-401 - 0001', '2019-08-01', 'computadora HD', '1', 1600, 'Samnsung', 0, 'Nuevo', 6),
(2, 2, 2, 2, 2, '101-202 - 301-402 - 0002', '2018-12-06', 'silla nuevas', '1', 500, 'Hander', 100, 'Nuevo', 6),
(3, 1, 4, 2, 2, '0003', '2021-01-28', 'Servira?', '1', 3, 'cetron', 0, 'Donado', 6),
(4, 2, 4, 2, 1, '0004', '2018-07-04', '345345345345345345', '1', 5000, 'cetron', 0, 'Usado', 2),
(5, 2, 2, 3, 1, '0005', '2021-01-14', 'hh', '1', 555, 'cetron', 0, 'Nuevo', 6),
(6, 1, 4, 2, 1, '0006', '2021-01-13', 'Nuevo con correccion', '1', 555, 'cetron', 0, 'Donado', 6),
(7, 2, 2, 2, 1, '0001-0002-0002-0007', '2021-01-12', '55555hhh', '1', 55, 'cetron', 0, 'Nuevo', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarticulos_vendidos`
--

CREATE TABLE `tarticulos_vendidos` (
  `id_articulos_vendidos` int(10) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `nombre` varchar(50) NOT NULL,
  `tasa` float NOT NULL,
  `cuotas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tarticulos_vendidos`
--

INSERT INTO `tarticulos_vendidos` (`id_articulos_vendidos`, `id_producto`, `nombre`, `tasa`, `cuotas`) VALUES
(1, NULL, 'Credito', 0, 1),
(2, NULL, 'Contado', 0, 1),
(3, NULL, 'Contado', 0, 1),
(4, NULL, 'Contado', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbanco`
--

CREATE TABLE `tbanco` (
  `id_banco` int(11) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `cantidad` float DEFAULT NULL,
  `id_venta` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbanco`
--

INSERT INTO `tbanco` (`id_banco`, `descripcion`, `cantidad`, `id_venta`) VALUES
(1, 'Venta al contado el 16/01/2021 Factura No.000020', 0, 22),
(2, 'Venta al contado el 16/01/2021 Factura No.000023', 0, 23),
(3, 'Venta al contado el 16/01/2021 Factura No.000025', 0, 25),
(4, 'Venta al contado el 16/01/2021 Factura No.000026', 649.75, 26),
(5, 'Venta al contado el 16/01/2021 No.000027', 129.95, 27),
(9, 'Pago de cuota No.00016 de la venta No.000028 al credito.', 35.46, 28),
(10, 'Pago de cuota No.00014 de la venta No.000028 al credito.', 35.46, 28),
(11, 'Pago de cuota No.00015 de la venta No.000028 al credito.', 35.46, 28),
(12, 'Pago de cuota No.00017 de la venta No.000028 al credito.', 35.46, 28),
(13, 'Pago de cuota No.00018 de la venta No.000028 al credito.', 35.46, 28),
(14, 'Pago de cuota No.00019 de la venta No.000028 al credito.', 35.46, 28),
(15, 'Pago de cuota No.00020 de la venta No.000028 al credito.', 35.46, 28),
(16, 'Pago de cuota No.00015 de la venta No.000028 al credito.', 35.46, 28),
(17, 'Pago de cuota No.00014 de la venta No.000028 al credito.', 35.46, 28),
(18, 'Pago de cuota No.00016 de la venta No.000028 al credito.', 35.46, 28),
(19, 'Pago de cuota No.00018 de la venta No.000028 al credito.', 35.46, 28),
(20, 'Pago de cuota No.00019 de la venta No.000028 al credito.', 35.46, 28),
(21, 'Pago de cuota No.00017 de la venta No.000028 al credito.', 35.46, 28),
(22, 'Pago de cuota No.00020 de la venta No.000028 al credito.', 35.46, 28),
(23, 'Pago de cuota No.00014 de la venta No.000028 al credito.', 35.46, 28),
(24, 'Pago de cuota No.00015 de la venta No.000028 al credito.', 35.46, 28),
(25, 'Pago de cuota No.00016 de la venta No.000028 al credito.', 35.46, 28),
(26, 'Pago de cuota No.00017 de la venta No.000028 al credito.', 35.46, 28),
(27, 'Pago de cuota No.00021 de la venta No.000029 al credito.', 35.4571, 29),
(28, 'Pago de cuota No.00022 de la venta No.000029 al credito.', 35.4571, 29),
(29, 'Pago de cuota No.00023 de la venta No.000029 al credito.', 35.4571, 29);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcarrito`
--

CREATE TABLE `tcarrito` (
  `id_carrito` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tcarrito`
--

INSERT INTO `tcarrito` (`id_carrito`, `id_producto`, `cantidad`) VALUES
(1, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcartera`
--

CREATE TABLE `tcartera` (
  `id_categoria` int(10) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tcartera`
--

INSERT INTO `tcartera` (`id_categoria`, `nombre`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C'),
(4, 'D');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcategoria`
--

CREATE TABLE `tcategoria` (
  `id_categoria` int(10) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tcategoria`
--

INSERT INTO `tcategoria` (`id_categoria`, `categoria`, `estado`) VALUES
(1, 'Linea blanca', 1),
(2, 'Linea negra', 0),
(3, 'linea negra', 0),
(4, 'nuevo', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tclasificacion`
--

CREATE TABLE `tclasificacion` (
  `id_clasificaion` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correlativo` varchar(50) NOT NULL,
  `tiempo_depreciacion` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tclasificacion`
--

INSERT INTO `tclasificacion` (`id_clasificaion`, `nombre`, `correlativo`, `tiempo_depreciacion`) VALUES
(1, 'Edificios', '301', 5),
(2, 'Maquinaria', '302', 20),
(3, 'Vehiculos', '303', 25),
(4, 'Otros bienes muebles', '304', 50),
(5, 'No', '305', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tclientes`
--

CREATE TABLE `tclientes` (
  `id_cliente` int(10) NOT NULL,
  `id_cartera` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `dui` varchar(20) NOT NULL,
  `nit` varchar(20) NOT NULL,
  `profecion` varchar(50) NOT NULL,
  `tipo_ingreso` varchar(50) NOT NULL,
  `salario` float NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `correo` varchar(40) NOT NULL,
  `observaciones` varchar(200) NOT NULL,
  `egreso` float DEFAULT NULL,
  `id_fiador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tclientes`
--

INSERT INTO `tclientes` (`id_cliente`, `id_cartera`, `nombre`, `apellido`, `direccion`, `dui`, `nit`, `profecion`, `tipo_ingreso`, `salario`, `telefono`, `celular`, `correo`, `observaciones`, `egreso`, `id_fiador`) VALUES
(3, 2, 'Nose que nombre', 'Ramirez Lopez', 'Santo tomas abajo cantos los hernandez, apastepeque San vicente', '12832738-7', '1278-372883-827-8', 'Contador', 'Remesa', 525, '2389-2898', '7787-8788', 'jessica@gmail.com', 'Esta es una nueva Descripcion', 100, NULL),
(4, 2, 'Fernando Josue', 'Hernandez Arevalo', 'COl san benito #45 san Isisdro San salavador', '29389829-8', '7281-728738-273-4', 'Lic. Contadora', 'Salario', 1500, '2239-8928', '7887-8788', 'fernando97@gmai.com', 'una persona con posibilidad de pagar el credito', 200, NULL),
(5, 4, 'Maria Azucena', 'Garcia Mata', 'Colonia el manantial #45 SUchitoto', '28298398-9', '7876-767565-777-7', 'Contador', 'Salario', 600, '2342-2222', '7837-8738', 'MariaAzu@hotmail.com', 'buena condicion de pago', 0, NULL),
(10, 1, 'Sandra Liseth', 'Arevalo Carranza', 'Colonia la monserrath, san esteban obrajuelo San Otrillo', '12321112-2', '2342-342342-221-1', 'Lic. Contadora', 'Salario', 800, '2332-3232', '7899-8989', 'Sandra@gmail.com', 'el cliente cumple con los requisitos', 0, NULL),
(11, 2, 'Ileana Liseth ', 'Oliva', 'apastepeque', '05294607-4', '6534-345566-778-8', 'Contador', 'Salario', 100, '2345-6778', '7342-3124', 'eticas@gmail.com', 'kljh;ljycdykxsdtyikljjhgff', 0, NULL),
(12, 4, 'Kike jesus', 'Jovel', 'Bxndjd', '62737737-7', '6262-3627-277-23', 'Contador', 'Remesa', 800, '989-8686', '686867', 'Kgjjkll', 'Jfhdbfnkuec', 0, NULL),
(14, 4, 'Jose Manuel', 'Rivera Perez', 'Calle Oriente Medio casa #45', '65619873-1', '1958-479033-641-9', 'Lic. Contadora', 'Salario', 400, '2323-5684', '7896-6583', 'silkfirmyn@gmail.com', 'Esta es una prueba ojala salga de puta madre', 200, NULL),
(15, 2, 'Erick2', 'Rivera Perez', 'Calle Oriente Medio casa #45', '22222222-2', '2222-222222-222-2', 'Lic. Contadora', 'Salario', 1111, '2323-5684', '2222-2222', 'silkfirmyn@gmail.com', 'wqeeeeeeeeeeeeeee', 222, NULL),
(16, 1, 'Erick3', 'Rivera Perez', 'Calle Oriente Medio casa #45', '22222222-2', '2222-222222-222-2', 'Contador1', 'Salario', 1111, '1111-1111', '2222-2222', 'silkfirmyn@gmail.com', 'wqeeeeeeeeeeeeeee', 222, NULL),
(20, 1, 'articulo', 'Rivera Perez', 'Calle Oriente Medio casa #45', '99999999-9', '9999-999999-999-9', 'Contador', 'Salario', 500, '9999-9999', '9999-9999', 'silkfirmyn@gmail.com', 'Esta es una prueba ojala salga de puta madre', 200, NULL),
(21, 1, 'articulo', 'Rivera Perez', 'Calle Oriente Medio casa #45', '99999999-9', '9999-999999-999-9', 'Lic. Contadora', 'Salario', 500, '9999-9999', '9999-9999', 'silkfirmyn@gmail.com', 'Esta es una prueba ojala salga de puta madre', 200, NULL),
(22, 2, 'Jessica Abigail', 'Rosales Martinez', 'Santo tomas abajo cantos los hernandez, apastepeque San vicente', '22222222-2', '2222-222222-222-2', 'Lic. Contadora', 'Salario', 222, '2222-2222', '2222-2222', 'jessica@gmail.com', 'Nueva descripcion', 222, NULL),
(23, 4, 'articulo', 'Rosales', 'Santo tomas abajo can2tos los hernandez, apastepeque San vicente', '22222222-2', '2222-222222-222-2', 'Lic. Contadora', 'Remesa', -1, '2222-2222', '2222-2222', 'jessica@gmail.com', '22', -1, NULL),
(24, 4, 'articulo', 'Rosales', 'Santo tomas abajo can2tos los hernandez, apastepeque San vicente', '22222222-2', '2222-222222-222-2', 'Lic. Contadora', 'Remesa', -1, '2222-2222', '2222-2222', 'jessica@gmail.com', '22', -1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcompras`
--

CREATE TABLE `tcompras` (
  `id_compras` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `precio` float NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tcompras`
--

INSERT INTO `tcompras` (`id_compras`, `id_producto`, `id_proveedor`, `fecha`, `precio`, `cantidad`) VALUES
(1, 2, 1, '2021-01-06', 15, 7),
(2, 2, 1, '2021-01-06', 5, 5),
(3, 5, 1, '2021-01-06', 100, 10),
(4, 5, 1, '2021-01-18', 0, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdepartamento`
--

CREATE TABLE `tdepartamento` (
  `id_departamento` int(10) NOT NULL,
  `id_institucion` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correlativo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tdepartamento`
--

INSERT INTO `tdepartamento` (`id_departamento`, `id_institucion`, `nombre`, `correlativo`) VALUES
(1, 1, 'Ventas', '0001'),
(2, 1, 'Produccion', '0002'),
(3, 1, 'Administracion', '0003'),
(4, 2, 'Finanzas', '0004');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdetalle_compra`
--

CREATE TABLE `tdetalle_compra` (
  `id_cliente` int(10) NOT NULL,
  `id_venta` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdetalle_venta`
--

CREATE TABLE `tdetalle_venta` (
  `id_detalleventa` int(11) NOT NULL,
  `id_venta` int(10) NOT NULL,
  `id_producto` int(10) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `preciovendido` double NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tdetalle_venta`
--

INSERT INTO `tdetalle_venta` (`id_detalleventa`, `id_venta`, `id_producto`, `cantidad`, `preciovendido`, `tipo`) VALUES
(1, 20, 3, 2, 115, 0),
(2, 22, 3, 3, 115, 0),
(3, 22, 4, 50, 480, 0),
(5, 23, 3, 50, 115, 0),
(6, 23, 4, 50, 480, 0),
(8, 24, 3, 5, 115, 0),
(9, 25, 3, 5, 115, 0),
(10, 26, 3, 5, 115, 0),
(11, 27, 3, 1, 115, 0),
(12, 28, 3, 1, 115, 1),
(13, 29, 3, 1, 115, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tdevolucion`
--

CREATE TABLE `tdevolucion` (
  `id_devolucion` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `precio` float NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tdevolucion`
--

INSERT INTO `tdevolucion` (`id_devolucion`, `id_producto`, `id_proveedor`, `fecha`, `precio`, `cantidad`) VALUES
(1, 5, 1, '2021-01-06', 100, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `templeados`
--

CREATE TABLE `templeados` (
  `id_empleado` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `zona` varchar(100) NOT NULL,
  `dui` varchar(20) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `rol` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `templeados`
--

INSERT INTO `templeados` (`id_empleado`, `nombre`, `apellido`, `zona`, `dui`, `usuario`, `pass`, `rol`) VALUES
(1, 'Jose Isamael', 'Hernandez Amaya', 'ventas', '1289283-4', 'nestor', 'hola', ''),
(2, 'kevin Alexander', 'Jovel Arevalo', 'san sebastian, San V', '23482773-9', 'kevin123', 'holamundo', 'Administrador'),
(3, 'Erick Alexander', 'kjhkhkhk', 'hkhkkjh', '87987987-9', 'sdhj3', 'jskdh', ''),
(4, 'Roberto Enrique', 'Rivas Alfaro', 'san benito', '23234234-3', 'roberto123', 'hola', 'Vendedor'),
(16, 'Jessica Abigail', 'Ramirez Lopez', 'Colonia la monserrath, san esteban obrajuelo San Otrillo', '11111111-1', 'user 4', '1234', 'Vendedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tfiador`
--

CREATE TABLE `tfiador` (
  `id_fiador` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `dui` varchar(15) NOT NULL,
  `nit` varchar(16) NOT NULL,
  `correo` varchar(30) NOT NULL,
  `profecion` varchar(40) NOT NULL,
  `salario` float NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `celular` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tfiador`
--

INSERT INTO `tfiador` (`id_fiador`, `nombre`, `apellido`, `direccion`, `dui`, `nit`, `correo`, `profecion`, `salario`, `telefono`, `celular`) VALUES
(1, 'kevin', 'jovel', 'san sebas', '2838329', '3989283', 'kevin@gmail.com', 'estudiante', 500, '2233234', '777777'),
(2, 'Jose de la Cruz', 'Flores Garcia', 'col santa fe pol e casa $34', '298899-9', '289-234232-234-2', 'jose@gmail.com', 'ingeniero de Sistemas', 1600, '23334433', '78773667'),
(3, 'Erick Alexander', 'Ticas', 'mjfjsgdxj', '09687644-5', '7643-368907-653-', 'gdj@gmail.com', 'yyyyyyyyyy', 700, '2222-2222', '7777-7777');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tinstitucion`
--

CREATE TABLE `tinstitucion` (
  `id_institucion` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correlativo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tinstitucion`
--

INSERT INTO `tinstitucion` (`id_institucion`, `nombre`, `correlativo`) VALUES
(1, 'Sucursal San Vicente', '0001'),
(2, 'Sucursal San Salvador', '0002'),
(3, 'Sucursal Cojutepeque', '0003');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tpago`
--

CREATE TABLE `tpago` (
  `id_pago` int(10) NOT NULL,
  `id_venta` int(10) NOT NULL,
  `monto` float NOT NULL,
  `fecha` date NOT NULL,
  `mora` float DEFAULT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tpago`
--

INSERT INTO `tpago` (`id_pago`, `id_venta`, `monto`, `fecha`, `mora`, `estado`) VALUES
(13, 26, 35.46, '2019-01-21', 0, 2),
(14, 28, 35.46, '2021-01-17', 4.6098, 2),
(15, 28, 35.46, '2021-02-17', 0, 1),
(16, 28, 35.46, '2021-03-17', 0, 1),
(17, 28, 35.46, '2021-04-17', 0, 1),
(18, 28, 35.46, '2021-05-17', 0, 0),
(19, 28, 35.46, '2021-06-17', 0, 0),
(20, 28, 35.46, '2021-07-17', 0, 1),
(21, 29, 35.4571, '2021-01-18', 0, 1),
(22, 29, 35.4571, '2021-02-18', 0, 1),
(23, 29, 35.4571, '2021-02-18', 0, 1),
(24, 29, 35.4571, '2021-02-18', 0, 0),
(25, 29, 35.4571, '2021-02-18', 0, 0),
(26, 29, 35.4571, '2021-02-18', 0, 0),
(27, 29, 35.4571, '2021-02-18', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tproducto`
--

CREATE TABLE `tproducto` (
  `id_producto` int(10) NOT NULL,
  `id_proveedor` int(10) NOT NULL,
  `id_categoria` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `precio_compra` float NOT NULL,
  `precio_venta` float NOT NULL,
  `margen` float NOT NULL,
  `stock_minimo` int(10) NOT NULL,
  `stock` int(10) NOT NULL,
  `codigo` varchar(8) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tproducto`
--

INSERT INTO `tproducto` (`id_producto`, `id_proveedor`, `id_categoria`, `nombre`, `descripcion`, `precio_compra`, `precio_venta`, `margen`, `stock_minimo`, `stock`, `codigo`, `estado`) VALUES
(2, 1, 1, 'Lavadora LG', 'Lavadora con capacidad de 20 libras, extra clean.', 5, 5.25, 5, 20, 0, 'HKJH9000', 1),
(3, 2, 1, 'Refrigeradora', 'sjdfkshd', 100, 115, 15, 20, 133, 'HKJH6937', 1),
(4, 2, 1, 'Cocina', 'sjdkshfes', 400, 480, 20, 15, 100, 'HKJH9695', 1),
(5, 1, 1, 'articulo', '233333 descrip', 0, 0, 22, 222, 10, 'ARTI3558', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tproveedor`
--

CREATE TABLE `tproveedor` (
  `id_proveedor` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `representante` varchar(75) NOT NULL,
  `dui` varchar(20) NOT NULL,
  `nit` varchar(20) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tproveedor`
--

INSERT INTO `tproveedor` (`id_proveedor`, `nombre`, `direccion`, `telefono`, `representante`, `dui`, `nit`, `celular`, `email`) VALUES
(1, 'SIMmAN', 'Blv. santa cruz #42 Santa Tecla, La Libertad', '2342-3212', 'Jose ignacio Martinez Zavala', '83829898-9', '2001-299399-901-0', '7829-9388', 'Jose234@gmail.com'),
(2, 'CACAOOPERA ', 'el paso', '2939-9299', 'oscar', '23989898-9', '2817-287987-287-9', '7876-5524', 'oscar@yahoo.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ttipo_activo`
--

CREATE TABLE `ttipo_activo` (
  `id_tipo` int(10) NOT NULL,
  `id_clasificacion` int(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correlativo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ttipo_activo`
--

INSERT INTO `ttipo_activo` (`id_tipo`, `id_clasificacion`, `nombre`, `correlativo`) VALUES
(1, 1, 'Computadora', '0001'),
(2, 2, 'Sillas', '0002'),
(3, 5, 'Camion', '0003'),
(4, 1, 'Mesa', '0004');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tventas`
--

CREATE TABLE `tventas` (
  `id_venta` int(10) NOT NULL,
  `id_cliente` int(10) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `id_plan` int(10) DEFAULT NULL,
  `id_empleado` int(10) NOT NULL,
  `prestamo_original` float NOT NULL,
  `saldo_actual` float NOT NULL,
  `mora_acumulada` float NOT NULL,
  `intereses_acumulados` float DEFAULT NULL,
  `estado` varchar(20) NOT NULL,
  `proximo_pago` date NOT NULL,
  `fecha` date NOT NULL,
  `interes` float DEFAULT NULL,
  `prima` float DEFAULT NULL,
  `meses` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tventas`
--

INSERT INTO `tventas` (`id_venta`, `id_cliente`, `codigo`, `id_plan`, `id_empleado`, `prestamo_original`, `saldo_actual`, `mora_acumulada`, `intereses_acumulados`, `estado`, `proximo_pago`, `fecha`, `interes`, `prima`, `meses`) VALUES
(13, 4, '0013', NULL, 4, 1364.48, 0, 0, NULL, 'Cancelada', '2019-01-21', '2019-01-21', NULL, NULL, NULL),
(20, 12, '000020', NULL, 4, 0, 0, 0, NULL, 'Cancelado', '2021-01-15', '2021-01-15', 0, NULL, NULL),
(22, 3, '000022', NULL, 4, 0, 0, 0, NULL, 'Cancelado', '2021-01-16', '2021-01-16', 0, NULL, NULL),
(23, 3, '000023', NULL, 4, 0, 0, 0, NULL, 'Cancelado', '2021-01-16', '2021-01-16', 0, NULL, NULL),
(24, 10, '000024', NULL, 4, 0, 0, 0, NULL, 'Cancelado', '2021-01-16', '2021-01-16', 0, NULL, NULL),
(25, 11, '000025', NULL, 4, 0, 0, 0, NULL, 'Cancelado', '2021-01-16', '2021-01-16', 0, NULL, NULL),
(26, 21, '000026', NULL, 4, 649.75, 649.75, 0, NULL, 'Cancelado', '2021-01-16', '2021-01-16', 0, NULL, NULL),
(27, 5, '000027', NULL, 4, 129.95, 129.95, 0, NULL, 'Cancelado', '2021-01-16', '2021-01-16', 0, NULL, NULL),
(28, 4, '000028', NULL, 4, 248.2, 106.36, 4.6098, NULL, 'Pendiente', '2021-01-17', '2021-01-16', 13, NULL, 7),
(29, 4, '000029', NULL, 4, 248.2, 141.829, 0, 0, 'Pendiente', '2021-01-18', '2021-01-17', 13, 0, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `kardex`
--
ALTER TABLE `kardex`
  ADD PRIMARY KEY (`id_kardex`),
  ADD KEY `fk_producto` (`id_producto`);

--
-- Indices de la tabla `tactivo`
--
ALTER TABLE `tactivo`
  ADD PRIMARY KEY (`id_activo`),
  ADD KEY `fk_tipo` (`id_tipo`),
  ADD KEY `fk_departamento` (`id_departamento`),
  ADD KEY `fk_usuario` (`id_encargado`),
  ADD KEY `fk_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `tarticulos_vendidos`
--
ALTER TABLE `tarticulos_vendidos`
  ADD PRIMARY KEY (`id_articulos_vendidos`),
  ADD KEY `fk_carterapago` (`id_producto`);

--
-- Indices de la tabla `tbanco`
--
ALTER TABLE `tbanco`
  ADD PRIMARY KEY (`id_banco`),
  ADD KEY `tbanco_tventas_id_venta_fk` (`id_venta`);

--
-- Indices de la tabla `tcarrito`
--
ALTER TABLE `tcarrito`
  ADD PRIMARY KEY (`id_carrito`),
  ADD KEY `fk_productocarrito` (`id_producto`);

--
-- Indices de la tabla `tcartera`
--
ALTER TABLE `tcartera`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `tcategoria`
--
ALTER TABLE `tcategoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `tclasificacion`
--
ALTER TABLE `tclasificacion`
  ADD PRIMARY KEY (`id_clasificaion`);

--
-- Indices de la tabla `tclientes`
--
ALTER TABLE `tclientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `fk_cartera` (`id_cartera`),
  ADD KEY `tclientes_tfiador_id_fiador_fk` (`id_fiador`);

--
-- Indices de la tabla `tcompras`
--
ALTER TABLE `tcompras`
  ADD PRIMARY KEY (`id_compras`),
  ADD KEY `fk_productocompra` (`id_producto`),
  ADD KEY `fk_proveedorcompra` (`id_proveedor`);

--
-- Indices de la tabla `tdepartamento`
--
ALTER TABLE `tdepartamento`
  ADD PRIMARY KEY (`id_departamento`),
  ADD KEY `fk_institucion` (`id_institucion`);

--
-- Indices de la tabla `tdetalle_compra`
--
ALTER TABLE `tdetalle_compra`
  ADD KEY `fk_cliente` (`id_cliente`),
  ADD KEY `fk_venta` (`id_venta`);

--
-- Indices de la tabla `tdetalle_venta`
--
ALTER TABLE `tdetalle_venta`
  ADD PRIMARY KEY (`id_detalleventa`),
  ADD KEY `fk_ventas` (`id_venta`),
  ADD KEY `fk_producto` (`id_producto`);

--
-- Indices de la tabla `tdevolucion`
--
ALTER TABLE `tdevolucion`
  ADD PRIMARY KEY (`id_devolucion`),
  ADD KEY `fk_devpro` (`id_producto`),
  ADD KEY `fk_devprov` (`id_proveedor`);

--
-- Indices de la tabla `templeados`
--
ALTER TABLE `templeados`
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `tfiador`
--
ALTER TABLE `tfiador`
  ADD PRIMARY KEY (`id_fiador`);

--
-- Indices de la tabla `tinstitucion`
--
ALTER TABLE `tinstitucion`
  ADD PRIMARY KEY (`id_institucion`);

--
-- Indices de la tabla `tpago`
--
ALTER TABLE `tpago`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `fk_ventapro` (`id_venta`);

--
-- Indices de la tabla `tproducto`
--
ALTER TABLE `tproducto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `fk_proveedores` (`id_proveedor`),
  ADD KEY `fk_categoria` (`id_categoria`);

--
-- Indices de la tabla `tproveedor`
--
ALTER TABLE `tproveedor`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `ttipo_activo`
--
ALTER TABLE `ttipo_activo`
  ADD PRIMARY KEY (`id_tipo`),
  ADD KEY `fk_clasificacion` (`id_clasificacion`);

--
-- Indices de la tabla `tventas`
--
ALTER TABLE `tventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_plan` (`id_plan`),
  ADD KEY `fk_idempleado` (`id_empleado`),
  ADD KEY `fk_clienteventa` (`id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `kardex`
--
ALTER TABLE `kardex`
  MODIFY `id_kardex` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tactivo`
--
ALTER TABLE `tactivo`
  MODIFY `id_activo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tarticulos_vendidos`
--
ALTER TABLE `tarticulos_vendidos`
  MODIFY `id_articulos_vendidos` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tbanco`
--
ALTER TABLE `tbanco`
  MODIFY `id_banco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `tcarrito`
--
ALTER TABLE `tcarrito`
  MODIFY `id_carrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tcartera`
--
ALTER TABLE `tcartera`
  MODIFY `id_categoria` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tcategoria`
--
ALTER TABLE `tcategoria`
  MODIFY `id_categoria` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tclasificacion`
--
ALTER TABLE `tclasificacion`
  MODIFY `id_clasificaion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tclientes`
--
ALTER TABLE `tclientes`
  MODIFY `id_cliente` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `tcompras`
--
ALTER TABLE `tcompras`
  MODIFY `id_compras` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tdepartamento`
--
ALTER TABLE `tdepartamento`
  MODIFY `id_departamento` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tdetalle_venta`
--
ALTER TABLE `tdetalle_venta`
  MODIFY `id_detalleventa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tdevolucion`
--
ALTER TABLE `tdevolucion`
  MODIFY `id_devolucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `templeados`
--
ALTER TABLE `templeados`
  MODIFY `id_empleado` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `tfiador`
--
ALTER TABLE `tfiador`
  MODIFY `id_fiador` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tinstitucion`
--
ALTER TABLE `tinstitucion`
  MODIFY `id_institucion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tpago`
--
ALTER TABLE `tpago`
  MODIFY `id_pago` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `tproducto`
--
ALTER TABLE `tproducto`
  MODIFY `id_producto` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tproveedor`
--
ALTER TABLE `tproveedor`
  MODIFY `id_proveedor` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ttipo_activo`
--
ALTER TABLE `ttipo_activo`
  MODIFY `id_tipo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tventas`
--
ALTER TABLE `tventas`
  MODIFY `id_venta` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `kardex`
--
ALTER TABLE `kardex`
  ADD CONSTRAINT `kardex_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `tproducto` (`id_producto`);

--
-- Filtros para la tabla `tactivo`
--
ALTER TABLE `tactivo`
  ADD CONSTRAINT `fk_departamento` FOREIGN KEY (`id_departamento`) REFERENCES `tdepartamento` (`id_departamento`),
  ADD CONSTRAINT `fk_encargado` FOREIGN KEY (`id_encargado`) REFERENCES `templeados` (`id_empleado`),
  ADD CONSTRAINT `fk_proveedor` FOREIGN KEY (`id_proveedor`) REFERENCES `tproveedor` (`id_proveedor`),
  ADD CONSTRAINT `fk_tipo` FOREIGN KEY (`id_tipo`) REFERENCES `ttipo_activo` (`id_tipo`);

--
-- Filtros para la tabla `tarticulos_vendidos`
--
ALTER TABLE `tarticulos_vendidos`
  ADD CONSTRAINT `tplan_pago_tproducto_id_producto_fk` FOREIGN KEY (`id_producto`) REFERENCES `tproducto` (`id_producto`);

--
-- Filtros para la tabla `tbanco`
--
ALTER TABLE `tbanco`
  ADD CONSTRAINT `tbanco_tventas_id_venta_fk` FOREIGN KEY (`id_venta`) REFERENCES `tventas` (`id_venta`);

--
-- Filtros para la tabla `tcarrito`
--
ALTER TABLE `tcarrito`
  ADD CONSTRAINT `fk_productocarrito` FOREIGN KEY (`id_producto`) REFERENCES `tproducto` (`id_producto`);

--
-- Filtros para la tabla `tclientes`
--
ALTER TABLE `tclientes`
  ADD CONSTRAINT `fk_cartera` FOREIGN KEY (`id_cartera`) REFERENCES `tcartera` (`id_categoria`),
  ADD CONSTRAINT `tclientes_tfiador_id_fiador_fk` FOREIGN KEY (`id_fiador`) REFERENCES `tfiador` (`id_fiador`);

--
-- Filtros para la tabla `tcompras`
--
ALTER TABLE `tcompras`
  ADD CONSTRAINT `fk_productocompra` FOREIGN KEY (`id_producto`) REFERENCES `tproducto` (`id_producto`),
  ADD CONSTRAINT `fk_proveedorcompra` FOREIGN KEY (`id_proveedor`) REFERENCES `tproveedor` (`id_proveedor`);

--
-- Filtros para la tabla `tdepartamento`
--
ALTER TABLE `tdepartamento`
  ADD CONSTRAINT `fk_institucion` FOREIGN KEY (`id_institucion`) REFERENCES `tinstitucion` (`id_institucion`);

--
-- Filtros para la tabla `tdetalle_compra`
--
ALTER TABLE `tdetalle_compra`
  ADD CONSTRAINT `fk_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `tclientes` (`id_cliente`),
  ADD CONSTRAINT `fk_venta` FOREIGN KEY (`id_venta`) REFERENCES `tventas` (`id_venta`);

--
-- Filtros para la tabla `tdetalle_venta`
--
ALTER TABLE `tdetalle_venta`
  ADD CONSTRAINT `fk_producto` FOREIGN KEY (`id_producto`) REFERENCES `tproducto` (`id_producto`),
  ADD CONSTRAINT `fk_ventas` FOREIGN KEY (`id_venta`) REFERENCES `tventas` (`id_venta`);

--
-- Filtros para la tabla `tdevolucion`
--
ALTER TABLE `tdevolucion`
  ADD CONSTRAINT `fk_devpro` FOREIGN KEY (`id_producto`) REFERENCES `tproducto` (`id_producto`),
  ADD CONSTRAINT `fk_devprov` FOREIGN KEY (`id_proveedor`) REFERENCES `tproveedor` (`id_proveedor`);

--
-- Filtros para la tabla `tpago`
--
ALTER TABLE `tpago`
  ADD CONSTRAINT `fk_ventapro` FOREIGN KEY (`id_venta`) REFERENCES `tventas` (`id_venta`);

--
-- Filtros para la tabla `tproducto`
--
ALTER TABLE `tproducto`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `tcategoria` (`id_categoria`),
  ADD CONSTRAINT `fk_proveedores` FOREIGN KEY (`id_proveedor`) REFERENCES `tproveedor` (`id_proveedor`);

--
-- Filtros para la tabla `ttipo_activo`
--
ALTER TABLE `ttipo_activo`
  ADD CONSTRAINT `fk_clasificacion` FOREIGN KEY (`id_clasificacion`) REFERENCES `tclasificacion` (`id_clasificaion`);

--
-- Filtros para la tabla `tventas`
--
ALTER TABLE `tventas`
  ADD CONSTRAINT `fk_clienteventa` FOREIGN KEY (`id_cliente`) REFERENCES `tclientes` (`id_cliente`),
  ADD CONSTRAINT `fk_empleado` FOREIGN KEY (`id_empleado`) REFERENCES `templeados` (`id_empleado`),
  ADD CONSTRAINT `fk_plan` FOREIGN KEY (`id_plan`) REFERENCES `tarticulos_vendidos` (`id_articulos_vendidos`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
