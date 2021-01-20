-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-01-2021 a las 11:50:47
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcarrito`
--

CREATE TABLE `tcarrito` (
  `id_carrito` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(4, 'Linea Gris', 1),
(5, 'Linea Marron', 1);

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
(1, 'Edificios', '001', 5),
(2, 'Maquinaria', '002', 20),
(3, 'Vehiculos', '003', 25),
(4, 'Otros bienes muebles', '004', 50);

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
(3, 2, 'Marcos Josue', 'Ramirez Lopez', 'Santo tomas , apastepeque San vicente', '12832738-7', '1278-372883-827-8', 'Contador', 'Remesa', 525, '2389-2898', '7787-8788', 'Antoni@gmail.com', 'se considera un cliente con capacidad para pagar deuda', 100, 1),
(4, 2, 'Esteban Guillermo', 'Hernandez Amaya', 'COl san benito #45 san Isisdro San salavador', '29389829-8', '7281-728738-273-4', 'Lic. Contadora', 'Salario', 1500, '2239-8928', '7887-8788', 'fernando97@gmai.com', 'una persona con posibilidad de pagar el credito', 200, 2),
(5, 4, 'Maria Azucena', 'Garcia Mata', 'Colonia el manantial #45 SUchitoto', '28298398-9', '7876-767565-777-7', 'Contador', 'Salario', 600, '2342-2222', '7837-8738', 'MariaAzu@hotmail.com', 'buena condicion de pago', 0, 5),
(10, 1, 'Sandra Liseth', 'Arevalo Carranza', 'Colonia la monserrath, san esteban obrajuelo San Otrillo', '02321112-2', '2342-342342-221-1', 'Lic. Contadora', 'Salario', 800, '2332-3232', '7899-8989', 'Sandra@gmail.com', 'el cliente cumple con los requisitos', 0, 6),
(11, 2, 'Maria Aurelia', 'Mira Perez', 'urbanizacion santa elena block a', '05294607-4', '6534-345566-778-8', 'Contador', 'Salario', 100, '2345-6778', '7342-3124', 'mees@gmail.com', 'cliente con posibilidad de pago', 0, 3),
(12, 4, 'Kike jesus', 'Carranza Garcia', 'Colonia santa elena pasaje 3 casa 3', '62737737-7', '6262-3627-277-23', 'Contador', 'Remesa', 800, '989-8686', '686867', 'KJ@gmail.com', 'cliente con posibilidad de pago', 0, 7),
(14, 4, 'Jose Manuel', 'Rivera Perez', 'Calle Oriente Medio casa #45', '65619873-1', '1958-479033-641-9', 'Lic. Contadora', 'Salario', 400, '2323-5684', '7896-6583', 'silkfirmyn@gmail.com', 'cliente con posibilidad de pago', 200, 8),
(15, 2, 'Kevin Moises', 'Jimenez Elias', 'Calle Oriente Medio casa #45', '023666555', '1010-140596-102-2', 'Lic. Contadora', 'Salario', 1111, '2323-5684', '7412-2322', 'rmyn@gmail.com', 'cumple con los requisitos', 222, 9),
(16, 1, 'Jessica Marcela', 'Rivera Perez', 'Calle Oriente paje 3 casa #45', '01236544-2', '1010-090395-101-2', 'Contador', 'Salario', 600, '2240-5689', '7987-3255', 'myn@gmail.com', 'cumple con los requisitos', 222, 10),
(20, 1, 'Ana Julia', 'Gonzalez Martinez ', 'Calle 4 ave. los almendros ', '04588788-9', '1010-140592-101-9', 'Contador', 'Salario', 500, '2396-9997', '7996-9109', 'Ayn@gmail.com', 'Posee posibilidad de pago', 200, 11),
(21, 1, 'Fatima Yohana', 'Cea Barahona', 'Colinia Ivu pasaje 4 casa#88 ', '02330141-9', '1010-170196-102-9', 'Lic. Contadora', 'Salario', 500, '2393-9999', '7852-4522', 'Fatima15@gmail.com', 'Cumple con los requisitos', 200, 12),
(22, 2, 'Abigail Valeria', 'Rosales Martinez', 'Santo Felipe, apastepeque San vicente', '00258888-2', '1010-150292-102-2', 'Lic. Contadora', 'Salario', 400, '2396-2369', '7896-2258', 'abi67@gmail.com', 'Cumple con los requisitos', 222, 13);

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
(4, 2, 'Finanzas', '0004'),
(5, 3, 'Recursos HUmanos', '0005'),
(6, 4, 'Marketing', '0006'),
(7, 7, 'Logistica', '0007');

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
(1, 'Jose Isamael', 'Hernandez Amaya', 'Colonia Obrera Pasaje 3 casa 21', '1289283-4', 'nestor', 'hola', 'Vendedor'),
(2, 'kevin Alexander', 'Arevalo Gonzalez', 'colonia el cafetal casa 33', '23482773-9', 'kevin123', 'holamundo', 'Administrador'),
(3, 'Erick Xavier ', 'Flores Alvarado ', 'Colonia espiga de oro psaje 3', '87987987-9', 'Erick', 'erick123', 'Vendedor'),
(4, 'Roberto Enrique', 'Rivas Alfaro', 'san benito', '23234234-3', 'roberto123', 'hola', 'Vendedor'),
(16, ' Abigail Maria', 'Ramirez Lopez', 'Colonia la monserrath, san esteban obrajuelo San Otrillo', '05412997-1', 'user 4', '1234', 'Vendedor'),
(17, 'Veronica Maria', 'Rodiguez  Perez ', 'POLIGONO 2, CANTON JOYA GALANA, LOT. AGRICOLA, LOTE N. 1. HACIENDA EL ANGEL, APOPA, SAN SALVADOR', '02548782-2', 'Maria', 'maria123', 'Vendedor'),
(18, 'Jose Luis', 'Perez Perez', 'AVENIDA INDEPENDENCIA NO. 526, SAN SALVADOR .', '01478552-2', 'jose', 'jose123', 'Vendedor'),
(19, 'Micaela de los Angeles', 'Baarrera Romero', 'KM 5 1/2 BOULEVAR DEL EJERCITO NACIONAL, NO. 5500, SOYAPANGO.', '04562588-8', 'Micaela', 'micaela123', 'Vendedor'),
(20, 'Marshal Owen', 'Flores Alvarado', 'CALLE SIEMENS NO. 1 PARQUE INDUSTRIAL STA. ELENA, ANTIGUO CUSCATLAN, LA LIBERTAD.', '05478995-2', 'Marshall', 'hola123', 'Vendedor'),
(21, 'Nelson Augusto', 'Morales Rivas', 'AV. EL BOQUERON LOTE H BLOCL A, EDIFICIO SAFIRO 2DO. NIVEL', '02369875-4', 'Nelson', 'nelson123', 'Vendedor'),
(22, 'Ernestina Fatima', 'Oseguda Ruiz', '5A Calle Oriente, 6A Avenida Norte y 6A Avenida Sur', '01245788-8', 'Ernes', '1727', 'Vendedor'),
(23, 'Alberto Eliseo', 'Umaña Ruiz', 'Oriente/Calle Dr Jaun Crisostomo Segovia', '04785521-5', 'Alberto', 'hola', 'Vendedor');

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
(1, 'kevin Antonio', 'Perez Perez', 'colonia espiga de oro pasaje #3', '2838329', '3989283', 'kevinA@gmail.com', 'estudiante', 500, '2233234', '79887852'),
(2, 'Jose de la Cruz', 'Flores Garcia', 'col santa fe pol e casa $34', '298899-9', '289-234232-234-2', 'jose@gmail.com', 'ingeniero de Sistemas', 1600, '23334433', '78773667'),
(3, 'Maria Antonia ', 'Gonzalez Gonzalez', 'Colonia San Jacinto pasaje #3 ', '09687644-5', '7643-368907-653-', 'gdj@gmail.com', 'Maestra', 700, '2393-8796', '7789-5412'),
(4, 'Natalie Josabeth', 'Castillo Elias', 'Colonia santa elena pasaje 10', '04563255-5', '1010-170196-101-', 'nat45@gmail.com', 'Ing. Sistemas', 700, '2393-5869', '7984-5752'),
(5, 'Oscar Armando ', 'Castillo Quintanilla', 'Colonia ivu pasaje 4 casa#10', '04789696-2', '1010-311096-102-', 'OscarA@gmail.com', 'Soldador', 500, '2369-7458', '7489-5122'),
(6, 'Juana Hilda ', 'Elias Barrera', 'Barrio Concepcion ', '04236982-0', '1010-104525-566-', 'Hildace@gmail.com', 'Secretaria', 400, '2393-5678', '7146-8240'),
(7, 'Daniela Cecilia', 'Orellana Castillo', 'Avenida crecencio miranda ', '01452287-7', '1010-100220-102-', 'DaC@gmail.com', 'Cajera', 400, '2393-5468', '7145-8693'),
(8, 'Carlos Josue', 'Portillo Umaña', 'Barrio el santuario casa #3 ', '01452366-9', '1010-040119-355-', 'Josue12@gmail.com', 'Interino', 450, '2393-5687', '7485-9632'),
(9, 'Juan Francisco', 'Elias Barrera', 'Barrio Concepcion ', '04563217-8', '1010-104785-222-', 'JuanF@gmail.com', 'Agricultor', 300, '2393-6544', '7478-7569'),
(10, 'Adriana Valentina', 'Perez Mira', 'Colonia San Jose casa #3 ', '02336541-2', '1010-104578-102-', 'AVa@gmail.com', 'Estudiante', 300, '2358-7966', '7145-6321'),
(11, 'Maria Dolores ', 'Villanueva Elias', 'Calle San Antonio Caminos pasaje 2', '02366999-9', '1010-140236-102-', 'MariaD@gmail.com', 'Cajera', 400, '2393-5823', '7412-5878'),
(12, 'Flor Idalia', 'Peda Huezo', 'Canton san antonio caminos 600 mts al oriente', '02555626-5', '1010-115522-102-', 'FIda@gmail.com', 'Cocinera', 300, '2393-6578', '7985-0640'),
(13, 'Alma Marisol', 'Mejia Sanchez', 'colonia San Jacinto casa #33', '02133445-5', '1010-141203-102-', 'SAM@gmail.com', 'Maestra', 600, '2393-5487', '7412-3669');

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
(3, 'Sucursal Cojutepeque', '0003'),
(4, 'Sucursal San Sebastian', '1004'),
(5, 'Sucursal Tecoluca', '1005'),
(6, 'Sucursal San Esteban Catarina', '1006'),
(7, 'Sucursal San Cayetano', '1007'),
(8, 'Sucursal Apastepeque', '1008');

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
(3, 2, 1, 'Refrigeradora', 'dos puertas frio seco', 100, 115, 15, 20, 0, 'HKJH6937', 1),
(4, 2, 1, 'Cocina', 'sjdkshfes', 400, 480, 20, 15, 0, 'HKJH9695', 1),
(5, 1, 5, 'Televisor LG', 'Smart tv entrada usb ', 150, 400, 22, 20, 0, 'ARTI3558', 0),
(6, 1, 1, 'Lavadora LG', 'producto en buen estado', 300, 360, 20, 10, 0, 'LAVA1172', 1),
(7, 11, 1, 'Secadora', 'nueva', 300, 360, 20, 15, 0, 'SECA1508', 1),
(8, 4, 1, 'Bocina', ' Bluetooth speakers / parlantes móviles: dispositivos portátiles de audio', 250, 300, 20, 20, 0, 'BOCI2147', 1),
(11, 3, 1, 'Batidora', 'Juego de fijación versátil,290 Volts de potencia,Botón Bowl Rest', 0, 0, 20, 40, 0, 'BATI7704', 1),
(12, 10, 1, 'Procesador de Alimentos', 'Motor de 900,Extracción de nutrientes', 30, 36, 20, 60, 0, 'PROC9487', 1),
(13, 3, 1, 'Horno Electrico', 'Ideal para hornear, asar, tostar y calentar,Interior con antiadherente,Fácil de usar y fácil de limp', 50, 60, 20, 15, 0, 'HORN8953', 1);

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
(1, ' DPLgroup', 'Blv. santa cruz #42 Santa Tecla, La Libertad', '2342-3212', 'Jose ignacio Martinez Zavala', '83829898-9', '2001-299399-901-0', '7829-9388', 'Jose234@gmail.com'),
(2, ' Tervama ', 'KM. 11 CARRETERA AL PUERTO LA LIBERTAD', '2939-9299', 'oscar Marcos Perez Osegueda', '23989898-9', '2817-287987-287-9', '7876-5524', 'oscar@yahoo.com'),
(3, 'C. Imberton, S.A. DE C.V', 'BOULEVARD DEL EJERCITO NACIONAL KM 7 1/2 SOYAPANGO', '2224-3580', 'Corina Asusena Martinez Perez', '02258855-2', '1010-140292-102-2', '7789-6333', 'CorinaA@gmail.com'),
(4, 'Curtis Industrial, S.A. DE C.V.', '53 AV. SUR, COL. FLOR BLCA. #123, SAN SALVADOR', '2223-6913', 'LIC. RICARDO COHEN', '00025555-5', '1010-120395-102-3', '7889-9921', 'RicarC@gmail.com'),
(5, 'Comersal, S.A. DE C.V.', 'KM. 10 CARRETERA A LA LIBERTAD,LA LIBERTAD', '2278-1111', 'LIC. JORGE LUIS SALUME', '00254789-7', '1010-140588-102-2', '7478-5222', 'JorgeL@gmail.com'),
(6, 'Comercial Pozuelo de El Salvador, S.A. DE C.V', '85 AVENIDA NORTE COLONIA ESCALÓN #320 SAN SALVADOR', '2209-3800', ' LIC. BEATRIZ EUGENIA RODRIGUEZ', '02458778-7', '1010-140388-103-3', '7898-8745', 'BER@gmail.com'),
(7, 'Dizac, S.A. de C.V.', 'C. PANAMERICANA KM 10 1/2 SANTA TECLA, LA LIBERTAD', '2511-4000', 'SR.EDGAR ZACARIAS', '02457889-9', '1010-120687-102-2', '7987-4521', 'Edgar78@gmail.com'),
(8, 'D’CASA, S.A. DE C.V.', 'CARRETERA AL PUERTO DE LA LIBERTAD, KM 10 1/4 STA, TECLA LA LIBERTAD', '2212-7000', 'LIC. ERNESTO AVILES', '01458763-3', '1010-130488-102-6', '7896-3358', 'ERA@gmail.com'),
(9, 'DISTRIBUIDORA SALVADOREÑA, S.A. DE C.V.', 'FINAL AV. SAN MARTIN 4-7, ENTRE 6TA Y 8VA CALLE OTE. SANTA TECLA, LA LIBERTAD', '2241-0400', 'LIC. JOSE MAYORGA', '02525472-2', '1010-070690-102-6', '7841-5542', 'Jose12@gmail.com'),
(10, 'DIMPULSO, S.A. DE C.V.', '11 CALLE PONIENTE, COLONIA ESCALON, CALLE 4131', '2264-5629', 'LIC. LUIS ARMANDO CALDERON', '01236547-8', '1010-120389-101-5', '7145-8963', 'LAC12@gmail.com'),
(11, 'CODINEX, S.A. DE C.V.', ' PASEO GRAL. ESCALÓN #3700, CUARTO NIVEL, COLONIA ESCALÓN, SAN SALVADOR', '2250-2433', 'ING. TEÓFILO SIMÁN DADA', '02369877-4', '1010-040887-102-2', '7789-4555', 'TeoSD@gmail.com');

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
(3, 3, 'Transporte', '0003'),
(4, 1, 'Mesa', '0004'),
(5, 4, 'Equipo Procesos Informaticos', '0005');

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
  MODIFY `id_kardex` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tactivo`
--
ALTER TABLE `tactivo`
  MODIFY `id_activo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tarticulos_vendidos`
--
ALTER TABLE `tarticulos_vendidos`
  MODIFY `id_articulos_vendidos` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbanco`
--
ALTER TABLE `tbanco`
  MODIFY `id_banco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `tcarrito`
--
ALTER TABLE `tcarrito`
  MODIFY `id_carrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tcartera`
--
ALTER TABLE `tcartera`
  MODIFY `id_categoria` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tcategoria`
--
ALTER TABLE `tcategoria`
  MODIFY `id_categoria` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id_compras` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tdepartamento`
--
ALTER TABLE `tdepartamento`
  MODIFY `id_departamento` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tdetalle_venta`
--
ALTER TABLE `tdetalle_venta`
  MODIFY `id_detalleventa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `tdevolucion`
--
ALTER TABLE `tdevolucion`
  MODIFY `id_devolucion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `templeados`
--
ALTER TABLE `templeados`
  MODIFY `id_empleado` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `tfiador`
--
ALTER TABLE `tfiador`
  MODIFY `id_fiador` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tinstitucion`
--
ALTER TABLE `tinstitucion`
  MODIFY `id_institucion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tpago`
--
ALTER TABLE `tpago`
  MODIFY `id_pago` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tproducto`
--
ALTER TABLE `tproducto`
  MODIFY `id_producto` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `tproveedor`
--
ALTER TABLE `tproveedor`
  MODIFY `id_proveedor` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `ttipo_activo`
--
ALTER TABLE `ttipo_activo`
  MODIFY `id_tipo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tventas`
--
ALTER TABLE `tventas`
  MODIFY `id_venta` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
