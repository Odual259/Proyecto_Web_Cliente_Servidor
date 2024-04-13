-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-04-2024 a las 04:57:51
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_kdn`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `ID_Area` int(11) NOT NULL,
  `Area` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`ID_Area`, `Area`) VALUES
(5, 'Indirect Tax'),
(6, 'Direct Tax'),
(7, 'Transfer Pricing'),
(8, 'Stats'),
(9, 'Projects'),
(10, 'Fiscal Updates');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `business_type`
--

CREATE TABLE `business_type` (
  `ID_Business_Type` int(11) NOT NULL,
  `Type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `business_type`
--

INSERT INTO `business_type` (`ID_Business_Type`, `Type`) VALUES
(1, 'Agriculture'),
(2, 'Automotive'),
(3, 'Banking'),
(4, 'Construction'),
(5, 'Consulting'),
(6, 'Education'),
(7, 'Energy'),
(8, 'Entertainment'),
(9, 'Finance'),
(10, 'Food and Beverage'),
(11, 'Healthcare'),
(12, 'Hospitality'),
(13, 'Information Technology'),
(14, 'Insurance'),
(15, 'Legal'),
(16, 'Manufacturing'),
(17, 'Media'),
(18, 'Non-Profit'),
(19, 'Pharmaceutical'),
(20, 'Real Estate'),
(21, 'Retail'),
(22, 'Telecommunications'),
(23, 'Transportation'),
(24, 'Travel'),
(25, 'Utilities'),
(26, 'Aerospace'),
(27, 'Biotechnology'),
(28, 'Chemical'),
(29, 'Communications'),
(30, 'Electronics'),
(31, 'Engineering'),
(32, 'Environmental'),
(33, 'Government'),
(34, 'Internet'),
(35, 'Logistics'),
(36, 'Marketing'),
(37, 'Military'),
(38, 'Mining'),
(39, 'Public Relations'),
(40, 'Publishing'),
(41, 'Research'),
(42, 'Security'),
(43, 'Software'),
(44, 'Sports'),
(45, 'Technology'),
(46, 'Textiles'),
(47, 'Waste Management'),
(48, 'Other');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `ID_Category` int(11) NOT NULL,
  `Category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`ID_Category`, `Category`) VALUES
(1, 'VAT'),
(2, 'WHT'),
(3, 'Survey'),
(4, 'CIT'),
(5, 'TP Study'),
(6, 'Informative'),
(7, 'Only Payment');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clients`
--

CREATE TABLE `clients` (
  `ID_Client` int(11) NOT NULL,
  `Engagement` varchar(50) NOT NULL,
  `Client_Name` varchar(100) NOT NULL,
  `Complexity` varchar(50) NOT NULL,
  `Client_Status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clients`
--

INSERT INTO `clients` (`ID_Client`, `Engagement`, `Client_Name`, `Complexity`, `Client_Status`) VALUES
(63, '16', 'Test 1', 'High', 'Active'),
(65, '1', 'Test 1', 'High', 'Active'),
(66, '2', 'Test 1', 'High', 'Active');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clusters`
--

CREATE TABLE `clusters` (
  `ID_Cluster` int(11) NOT NULL,
  `Cluster` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clusters`
--

INSERT INTO `clusters` (`ID_Cluster`, `Cluster`) VALUES
(1, 'Latin America'),
(2, 'North America'),
(3, 'South America'),
(4, 'Europe'),
(5, 'Asia'),
(6, 'Africa'),
(7, 'Oceania');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `countries`
--

CREATE TABLE `countries` (
  `ID_Country` int(11) NOT NULL,
  `Country` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `countries`
--

INSERT INTO `countries` (`ID_Country`, `Country`) VALUES
(1, 'Argentina'),
(2, 'Australia'),
(3, 'Brazil'),
(4, 'Canada'),
(5, 'China'),
(6, 'France'),
(7, 'Germany'),
(8, 'India'),
(9, 'Indonesia'),
(10, 'Italy'),
(11, 'Japan'),
(12, 'Mexico'),
(13, 'Netherlands'),
(14, 'New Zealand'),
(15, 'Nigeria'),
(16, 'Pakistan'),
(17, 'Russia'),
(18, 'Saudi Arabia'),
(19, 'South Africa'),
(20, 'South Korea'),
(21, 'Spain'),
(22, 'Sweden'),
(23, 'Switzerland'),
(24, 'Thailand'),
(25, 'Turkey'),
(26, 'United Kingdom'),
(27, 'United States'),
(28, 'Vietnam'),
(29, 'Austria'),
(30, 'Belgium'),
(31, 'Chile'),
(32, 'Colombia'),
(33, 'Czech Republic'),
(34, 'Denmark'),
(35, 'Egypt'),
(36, 'Finland'),
(37, 'Greece'),
(38, 'Hungary'),
(39, 'Ireland'),
(40, 'Israel'),
(41, 'Malaysia'),
(42, 'Norway'),
(43, 'Philippines'),
(44, 'Poland'),
(45, 'Portugal'),
(46, 'Singapore'),
(47, 'Taiwan'),
(48, 'Ukraine'),
(49, 'United Arab Emirates');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entities`
--

CREATE TABLE `entities` (
  `ID_Entity` int(11) NOT NULL,
  `Entity_Name` varchar(100) NOT NULL,
  `ID_Client` int(11) NOT NULL,
  `ID_Cluster` int(11) NOT NULL,
  `ID_Country` int(11) NOT NULL,
  `ID_Business_Type` int(11) NOT NULL,
  `Company_Internal_ID` varchar(100) NOT NULL,
  `Legal_ID` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `entities`
--

INSERT INTO `entities` (`ID_Entity`, `Entity_Name`, `ID_Client`, `ID_Cluster`, `ID_Country`, `ID_Business_Type`, `Company_Internal_ID`, `Legal_ID`) VALUES
(1, 'Test Entity 1', 59, 1, 1, 1, '0001', '0001');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `news`
--

CREATE TABLE `news` (
  `News_ID` int(11) NOT NULL,
  `Title` varchar(535) NOT NULL,
  `Body` text NOT NULL,
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodicity`
--

CREATE TABLE `periodicity` (
  `ID_Periodicity` int(11) NOT NULL,
  `Periodicity` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `periodicity`
--

INSERT INTO `periodicity` (`ID_Periodicity`, `Periodicity`) VALUES
(1, 'Daily'),
(2, 'Weekly'),
(3, 'Bi-Weekly'),
(4, 'Monthly'),
(5, 'Bi-Monthly'),
(6, 'Quarterly'),
(7, 'Semi-Annual'),
(8, 'Annual');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `processes`
--

CREATE TABLE `processes` (
  `ID_Process` int(11) NOT NULL,
  `Process` varchar(100) NOT NULL,
  `ID_Client` int(11) NOT NULL,
  `ID_Entity` int(11) NOT NULL,
  `ID_Cluster` int(11) NOT NULL,
  `ID_Country` int(11) NOT NULL,
  `ID_Area` int(11) NOT NULL,
  `ID_Category` int(11) NOT NULL,
  `ID_Periodicity` int(11) NOT NULL,
  `ID_User_Approver` int(11) NOT NULL,
  `ID_User_Analyst` int(11) NOT NULL,
  `Period` varchar(30) NOT NULL,
  `Year` varchar(4) NOT NULL,
  `Due_date` date NOT NULL,
  `Final_Status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `processes`
--

INSERT INTO `processes` (`ID_Process`, `Process`, `ID_Client`, `ID_Entity`, `ID_Cluster`, `ID_Country`, `ID_Area`, `ID_Category`, `ID_Periodicity`, `ID_User_Approver`, `ID_User_Analyst`, `Period`, `Year`, `Due_date`, `Final_Status`) VALUES
(1, 'Prueba', 63, 1, 2, 2, 6, 2, 3, 7, 1, 'January', '2021', '2024-04-13', 'Rejected'),
(2, 'Prueba', 63, 1, 2, 3, 6, 3, 3, 2, 1, 'January', '2020', '2024-04-21', 'Pending Approval'),
(6, 'Prueba', 63, 1, 2, 4, 6, 2, 2, 2, 2, 'April', '2020', '2024-04-13', 'Approved');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `User_ID` int(11) NOT NULL,
  `First_Name` varchar(30) NOT NULL,
  `Last_Name` varchar(30) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`User_ID`, `First_Name`, `Last_Name`, `Email`, `Password`) VALUES
(1, 'Odual', 'Bonilla', 'odualbc@gmail.com', '*146DF612842000C2663BA7F324037AA7C61228E0'),
(2, 'Fanny', 'Bonilla', 'fannybc@gmail.com', '*146DF612842000C2663BA7F324037AA7C61228E0'),
(6, 'Prueba', 'Prueba', 'Prueba@prueba', '123'),
(7, 'Prueba', '', 'odualbc@gmail.com', '$2y$10$U3.K9r0stHc13VfXvwzpnOuNdAt0jAHXNpcBvZLB.ahfhcStxUF/y'),
(8, 'Odual', '', 'odualbc@gmail.com', '$2y$10$WMZzk2QrRv0ak2wEH3CaMOP1bpRMWmoQUvwhxbSi5qHw1p0Wj2/VO');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`ID_Area`);

--
-- Indices de la tabla `business_type`
--
ALTER TABLE `business_type`
  ADD PRIMARY KEY (`ID_Business_Type`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`ID_Category`);

--
-- Indices de la tabla `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`ID_Client`);

--
-- Indices de la tabla `clusters`
--
ALTER TABLE `clusters`
  ADD PRIMARY KEY (`ID_Cluster`);

--
-- Indices de la tabla `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`ID_Country`);

--
-- Indices de la tabla `entities`
--
ALTER TABLE `entities`
  ADD PRIMARY KEY (`ID_Entity`),
  ADD KEY `ID_Cluster` (`ID_Cluster`),
  ADD KEY `ID_Country` (`ID_Country`),
  ADD KEY `ID_Business_Type` (`ID_Business_Type`),
  ADD KEY `ID_Client` (`ID_Client`);

--
-- Indices de la tabla `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`News_ID`);

--
-- Indices de la tabla `periodicity`
--
ALTER TABLE `periodicity`
  ADD PRIMARY KEY (`ID_Periodicity`);

--
-- Indices de la tabla `processes`
--
ALTER TABLE `processes`
  ADD PRIMARY KEY (`ID_Process`),
  ADD KEY `ID_User_Approver` (`ID_User_Approver`),
  ADD KEY `ID_User_Analyst` (`ID_User_Analyst`),
  ADD KEY `ID_Cluster` (`ID_Cluster`),
  ADD KEY `ID_Country` (`ID_Country`),
  ADD KEY `ID_Entitiy` (`ID_Entity`),
  ADD KEY `ID_Client` (`ID_Client`),
  ADD KEY `ID_Periodicity` (`ID_Periodicity`),
  ADD KEY `ID_Category` (`ID_Category`),
  ADD KEY `ID_Area` (`ID_Area`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `ID_Area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `business_type`
--
ALTER TABLE `business_type`
  MODIFY `ID_Business_Type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `ID_Category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `clients`
--
ALTER TABLE `clients`
  MODIFY `ID_Client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT de la tabla `clusters`
--
ALTER TABLE `clusters`
  MODIFY `ID_Cluster` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `countries`
--
ALTER TABLE `countries`
  MODIFY `ID_Country` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `entities`
--
ALTER TABLE `entities`
  MODIFY `ID_Entity` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `news`
--
ALTER TABLE `news`
  MODIFY `News_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `periodicity`
--
ALTER TABLE `periodicity`
  MODIFY `ID_Periodicity` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `processes`
--
ALTER TABLE `processes`
  MODIFY `ID_Process` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
