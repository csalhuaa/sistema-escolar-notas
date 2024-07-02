-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-07-2024 a las 16:06:20
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd-4`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id_asistencia` int(11) NOT NULL,
  `id_estudiante` int(11) DEFAULT NULL,
  `id_aula` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `presente` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id_asistencia`, `id_estudiante`, `id_aula`, `fecha`, `presente`) VALUES
(1, 1, 1, '2024-06-29', 1),
(3, 2, 1, '2024-06-30', 1),
(4, 3, 1, '2024-06-30', 1),
(5, 4, 1, '2024-06-30', 1),
(6, 2, 1, '2024-06-30', 1),
(7, 3, 1, '2024-06-30', 1),
(8, 1, 1, '2024-06-30', 1),
(9, 3, 1, '2024-06-30', 1),
(10, 1, 1, '2024-06-30', 1),
(11, 3, 1, '2024-06-30', 1),
(12, 1, 1, '2024-06-30', 1),
(13, 2, 1, '2024-06-30', 1),
(14, 1, 1, '2024-06-30', 1),
(15, 2, 1, '2024-06-30', 1),
(16, 3, 1, '2024-06-30', 0),
(17, 4, 1, '2024-06-30', 0),
(18, 1, 1, '2024-06-30', 1),
(19, 2, 1, '2024-06-30', 1),
(20, 3, 1, '2024-06-30', 0),
(21, 4, 1, '2024-06-30', 0),
(22, 1, 1, '2024-06-30', 0),
(23, 2, 1, '2024-06-30', 0),
(24, 3, 1, '2024-06-30', 0),
(25, 4, 1, '2024-06-30', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aulas`
--

CREATE TABLE `aulas` (
  `id_aula` int(11) NOT NULL,
  `id_grado` int(11) NOT NULL,
  `id_seccion` int(11) NOT NULL,
  `est_reg` char(1) DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `aulas`
--

INSERT INTO `aulas` (`id_aula`, `id_grado`, `id_seccion`, `est_reg`) VALUES
(1, 1, 1, 'A'),
(2, 2, 2, 'A'),
(3, 3, 3, 'A'),
(4, 4, 4, 'A'),
(5, 5, 5, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competencia`
--

CREATE TABLE `competencia` (
  `id_competencia` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `descripcion` varchar(110) NOT NULL,
  `estado_registro` char(1) DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `competencia`
--

INSERT INTO `competencia` (`id_competencia`, `id_curso`, `descripcion`, `estado_registro`) VALUES
(1, 1, 'Resuelve problemas de cantidad', 'A'),
(2, 1, 'Resuelve problemas de regularidad, equivalencia y cambio', 'A'),
(3, 1, 'Resuelve problemas de forma, movimiento y localización', 'A'),
(4, 1, 'Resuelve problemas de gestión de datos e incertidumbre', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id_curso` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `est_reg` char(1) DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id_curso`, `nombre`, `descripcion`, `est_reg`) VALUES
(1, 'Matemáticas', 'Curso de matemáticas básicas', 'A'),
(2, 'Lenguaje', 'Curso de lenguaje y comunicación', 'A'),
(3, 'Ciencias', 'Curso de ciencias naturales', 'A'),
(4, 'Historia', 'Curso de historia general', 'A'),
(5, 'Arte', 'Curso de arte y creatividad', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente_aula`
--

CREATE TABLE `docente_aula` (
  `id_docente` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_aula` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docente_aula`
--

INSERT INTO `docente_aula` (`id_docente`, `id_curso`, `id_aula`) VALUES
(1, 1, 1),
(1, 3, 1),
(1, 5, 1),
(2, 2, 2),
(2, 4, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente_especialidades`
--

CREATE TABLE `docente_especialidades` (
  `id_docente` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docente_especialidades`
--

INSERT INTO `docente_especialidades` (`id_docente`, `id_curso`) VALUES
(1, 1),
(1, 3),
(1, 5),
(2, 2),
(2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `id_estudiante` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido_paterno` varchar(100) NOT NULL,
  `apellido_materno` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `id_aula` int(1) NOT NULL,
  `id_tutor` int(11) NOT NULL,
  `est_reg` char(1) DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`id_estudiante`, `nombre`, `apellido_paterno`, `apellido_materno`, `fecha_nacimiento`, `direccion`, `id_aula`, `id_tutor`, `est_reg`) VALUES
(1, 'Juan', 'Pérez', 'García', '2010-01-01', 'Calle Falsa 123', 1, 3, 'A'),
(2, 'Ana', 'López', 'Martínez', '2011-02-02', 'Avenida Siempre Viva 456', 1, 4, 'A'),
(3, 'Luis', 'Rodríguez', 'Fernández', '2012-03-03', 'Calle Secundaria 789', 1, 5, 'A'),
(4, 'María', 'Gómez', 'Sánchez', '2013-04-04', 'Boulevard Principal 101', 1, 3, 'A'),
(5, 'Carlos', 'Díaz', 'Hernández', '2014-05-05', 'Calle Central 202', 2, 4, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id_evento` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha` date NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `est_reg` char(1) DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id_evento`, `titulo`, `descripcion`, `fecha`, `id_usuario`, `est_reg`) VALUES
(1, 'Día del Estudiante', 'Celebración del Día del Estudiante', '2024-07-01', 1, 'A'),
(2, 'Feria de Ciencias', 'Presentación de proyectos de ciencia', '2024-08-15', 2, 'A'),
(3, 'Competencia Deportiva', 'Competencia anual de deportes', '2024-09-10', 3, 'A'),
(4, 'Exposición de Arte', 'Exposición de trabajos de arte', '2024-10-05', 4, 'A'),
(5, 'Concurso de Matemáticas', 'Concurso intercolegial de matemáticas', '2024-11-20', 5, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grados`
--

CREATE TABLE `grados` (
  `id_grado` int(11) NOT NULL,
  `nombre_grado` varchar(50) NOT NULL,
  `est_reg` char(1) DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grados`
--

INSERT INTO `grados` (`id_grado`, `nombre_grado`, `est_reg`) VALUES
(1, 'Primero', 'A'),
(2, 'Segundo', 'A'),
(3, 'Tercero', 'A'),
(4, 'Cuarto', 'A'),
(5, 'Quinto', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matriculas`
--

CREATE TABLE `matriculas` (
  `id_matricula` int(11) NOT NULL,
  `id_estudiante` int(11) NOT NULL,
  `id_grado` int(11) NOT NULL,
  `id_seccion` int(11) NOT NULL,
  `año` int(11) NOT NULL,
  `est_reg` char(1) DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `matriculas`
--

INSERT INTO `matriculas` (`id_matricula`, `id_estudiante`, `id_grado`, `id_seccion`, `año`, `est_reg`) VALUES
(1, 1, 1, 1, 2023, 'A'),
(2, 2, 2, 2, 2023, 'A'),
(3, 3, 3, 3, 2023, 'A'),
(4, 4, 4, 4, 2023, 'A'),
(5, 5, 5, 5, 2023, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `id_nota` int(11) NOT NULL,
  `id_estudiante` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `id_competencia` int(11) DEFAULT NULL,
  `id_periodo` int(11) DEFAULT NULL,
  `nota` decimal(5,2) DEFAULT NULL,
  `est_reg` char(1) DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`id_nota`, `id_estudiante`, `id_curso`, `id_competencia`, `id_periodo`, `nota`, `est_reg`) VALUES
(1, 1, 1, 1, 1, 12.00, 'A'),
(2, 1, 1, 2, 1, 11.99, 'A'),
(3, 1, 1, 3, 1, 12.00, 'A'),
(4, 1, 1, 4, 1, 12.00, 'A'),
(5, 1, 1, 1, 2, 11.00, 'A'),
(6, 1, 1, 2, 2, 11.00, 'A'),
(7, 1, 1, 3, 2, 12.00, 'A'),
(8, 1, 1, 4, 2, 12.00, 'A'),
(9, 2, 1, 1, 1, 13.00, 'A'),
(10, 2, 1, 2, 1, 13.00, 'A'),
(11, 2, 1, 3, 1, 13.00, 'A'),
(12, 2, 1, 4, 1, 13.00, 'A'),
(13, 2, 1, 1, 2, 14.00, 'A'),
(14, 2, 1, 2, 2, 14.00, 'A'),
(15, 2, 1, 3, 2, 16.00, 'A'),
(16, 2, 1, 4, 2, 16.00, 'A'),
(17, 3, 1, 1, 1, 12.00, 'A'),
(18, 3, 1, 2, 1, 12.00, 'A'),
(19, 3, 1, 3, 1, 13.00, 'A'),
(20, 3, 1, 4, 1, 13.00, 'A'),
(21, 3, 1, 1, 2, 11.00, 'A'),
(22, 3, 1, 2, 2, 12.00, 'A'),
(23, 3, 1, 3, 2, 12.00, 'A'),
(24, 3, 1, 4, 2, 12.00, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodos`
--

CREATE TABLE `periodos` (
  `id_periodo` int(11) NOT NULL,
  `nombre_periodo` varchar(50) NOT NULL,
  `estado_registro` char(1) DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `periodos`
--

INSERT INTO `periodos` (`id_periodo`, `nombre_periodo`, `estado_registro`) VALUES
(1, 'Primer Bimestre', 'A'),
(2, 'Segundo Bimestre', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permiso` int(11) NOT NULL,
  `nombre_permiso` varchar(100) NOT NULL,
  `est_reg` char(1) DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_permiso`, `nombre_permiso`, `est_reg`) VALUES
(1, 'Leer', 'A'),
(2, 'Escribir', 'A'),
(3, 'Editar', 'A'),
(4, 'Eliminar', 'A'),
(5, 'Administrar', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos_roles`
--

CREATE TABLE `permisos_roles` (
  `id_rol` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos_roles`
--

INSERT INTO `permisos_roles` (`id_rol`, `id_permiso`) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4),
(3, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

CREATE TABLE `reportes` (
  `id_reporte` int(11) NOT NULL,
  `id_estudiante` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `observaciones` text DEFAULT NULL,
  `fecha` date NOT NULL,
  `est_reg` char(1) DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reportes`
--

INSERT INTO `reportes` (`id_reporte`, `id_estudiante`, `id_curso`, `observaciones`, `fecha`, `est_reg`) VALUES
(1, 1, 1, 'Buen desempeño', '2024-06-01', 'A'),
(2, 2, 2, 'Necesita mejorar', '2024-06-15', 'A'),
(3, 3, 3, 'Excelente participación', '2024-06-30', 'A'),
(4, 4, 4, 'Trabajo en equipo', '2024-07-10', 'A'),
(5, 5, 5, 'Alta dedicación', '2024-07-20', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(50) NOT NULL,
  `est_reg` char(1) DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre_rol`, `est_reg`) VALUES
(1, 'Docente', 'A'),
(2, 'Tutor', 'A'),
(3, 'Estudiante', 'A'),
(4, 'Administrador', 'A'),
(5, 'Supervisor', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

CREATE TABLE `secciones` (
  `id_seccion` int(11) NOT NULL,
  `nombre_seccion` varchar(50) NOT NULL,
  `est_reg` char(1) DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `secciones`
--

INSERT INTO `secciones` (`id_seccion`, `nombre_seccion`, `est_reg`) VALUES
(1, 'A', 'A'),
(2, 'B', 'A'),
(3, 'C', 'A'),
(4, 'D', 'A'),
(5, 'E', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `tipo_usuario` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido_paterno` varchar(100) NOT NULL,
  `apellido_materno` varchar(100) NOT NULL,
  `numero_contacto` varchar(20) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `info_contacto` varchar(255) DEFAULT NULL,
  `est_reg` char(1) DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `contraseña`, `tipo_usuario`, `nombre`, `apellido_paterno`, `apellido_materno`, `numero_contacto`, `id_rol`, `info_contacto`, `est_reg`) VALUES
(1, 'jdoe', '$2y$10$4oAtmf9OrVNo5MHMQgo5x.mafrhVyCtwqU2NY0QFdvbAHneP0y7ua', 'docente', 'John', 'Doe', 'Smith', '123456789', 1, 'john.doe@example.com', 'A'),
(2, 'asmith', '$2y$10$UvvEXH2FsyQIbiJdH/6iLu.KYQ.Ku3.tyMbJQn62ZnFpGgZcunnd2', 'docente', 'Alice', 'Smith', 'Johnson', '987654321', 1, 'alice.smith@example.com', 'A'),
(3, 'bwilliams', 'pass123', 'tutor', 'Bob', 'Williams', 'Brown', '123123123', 2, 'bob.williams@example.com', 'A'),
(4, 'cwilliams', 'pass123', 'tutor', 'Charlie', 'Williams', 'Brown', '321321321', 2, 'charlie.williams@example.com', 'A'),
(5, 'dwilson', '$2y$10$pD501yVHb1faXHKg6wyreOg3O3v5xD1D.R73Q7TWR/dhstaeaewB.', 'tutor', 'David', 'Wilson', 'Green', '456456456', 2, 'david.wilson@example.com', 'A'),
(6, 'admin', '$2y$10$eMuM0pcjvm87zSJ9NzgO2OSlo0XoOsV6TRMVNmHT8Jht.Dp2jruNi', 'admin', 'Navi', 'Leandros', 'Mercado', '931316402', 4, 'admin@gmail.com', 'A');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id_asistencia`),
  ADD KEY `id_estudiante` (`id_estudiante`),
  ADD KEY `id_aula` (`id_aula`);

--
-- Indices de la tabla `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`id_aula`),
  ADD KEY `id_grado` (`id_grado`),
  ADD KEY `id_seccion` (`id_seccion`);

--
-- Indices de la tabla `competencia`
--
ALTER TABLE `competencia`
  ADD PRIMARY KEY (`id_competencia`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_curso`);

--
-- Indices de la tabla `docente_aula`
--
ALTER TABLE `docente_aula`
  ADD PRIMARY KEY (`id_docente`,`id_curso`,`id_aula`),
  ADD KEY `id_curso` (`id_curso`),
  ADD KEY `id_aula` (`id_aula`);

--
-- Indices de la tabla `docente_especialidades`
--
ALTER TABLE `docente_especialidades`
  ADD PRIMARY KEY (`id_docente`,`id_curso`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`id_estudiante`),
  ADD KEY `id_tutor` (`id_tutor`),
  ADD KEY `estudiantes_ibfk_1` (`id_aula`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id_evento`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `grados`
--
ALTER TABLE `grados`
  ADD PRIMARY KEY (`id_grado`);

--
-- Indices de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD PRIMARY KEY (`id_matricula`),
  ADD KEY `id_estudiante` (`id_estudiante`),
  ADD KEY `id_grado` (`id_grado`),
  ADD KEY `id_seccion` (`id_seccion`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id_nota`),
  ADD KEY `id_estudiante` (`id_estudiante`),
  ADD KEY `id_curso` (`id_curso`),
  ADD KEY `id_competencia` (`id_competencia`),
  ADD KEY `id_bimestre` (`id_periodo`);

--
-- Indices de la tabla `periodos`
--
ALTER TABLE `periodos`
  ADD PRIMARY KEY (`id_periodo`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permiso`);

--
-- Indices de la tabla `permisos_roles`
--
ALTER TABLE `permisos_roles`
  ADD PRIMARY KEY (`id_rol`,`id_permiso`),
  ADD KEY `id_permiso` (`id_permiso`);

--
-- Indices de la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD PRIMARY KEY (`id_reporte`),
  ADD KEY `id_estudiante` (`id_estudiante`),
  ADD KEY `id_curso` (`id_curso`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `secciones`
--
ALTER TABLE `secciones`
  ADD PRIMARY KEY (`id_seccion`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id_asistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `aulas`
--
ALTER TABLE `aulas`
  MODIFY `id_aula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `id_estudiante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `grados`
--
ALTER TABLE `grados`
  MODIFY `id_grado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `matriculas`
--
ALTER TABLE `matriculas`
  MODIFY `id_matricula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `reportes`
--
ALTER TABLE `reportes`
  MODIFY `id_reporte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `secciones`
--
ALTER TABLE `secciones`
  MODIFY `id_seccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiantes` (`id_estudiante`),
  ADD CONSTRAINT `asistencia_ibfk_2` FOREIGN KEY (`id_aula`) REFERENCES `aulas` (`id_aula`);

--
-- Filtros para la tabla `aulas`
--
ALTER TABLE `aulas`
  ADD CONSTRAINT `aulas_ibfk_1` FOREIGN KEY (`id_grado`) REFERENCES `grados` (`id_grado`),
  ADD CONSTRAINT `aulas_ibfk_2` FOREIGN KEY (`id_seccion`) REFERENCES `secciones` (`id_seccion`);

--
-- Filtros para la tabla `docente_aula`
--
ALTER TABLE `docente_aula`
  ADD CONSTRAINT `docente_aula_ibfk_1` FOREIGN KEY (`id_docente`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `docente_aula_ibfk_2` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`),
  ADD CONSTRAINT `docente_aula_ibfk_3` FOREIGN KEY (`id_aula`) REFERENCES `aulas` (`id_aula`);

--
-- Filtros para la tabla `docente_especialidades`
--
ALTER TABLE `docente_especialidades`
  ADD CONSTRAINT `docente_especialidades_ibfk_1` FOREIGN KEY (`id_docente`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `docente_especialidades_ibfk_2` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`);

--
-- Filtros para la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD CONSTRAINT `estudiantes_ibfk_1` FOREIGN KEY (`id_aula`) REFERENCES `aulas` (`id_aula`),
  ADD CONSTRAINT `estudiantes_ibfk_2` FOREIGN KEY (`id_tutor`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `matriculas`
--
ALTER TABLE `matriculas`
  ADD CONSTRAINT `matriculas_ibfk_1` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiantes` (`id_estudiante`),
  ADD CONSTRAINT `matriculas_ibfk_2` FOREIGN KEY (`id_grado`) REFERENCES `grados` (`id_grado`),
  ADD CONSTRAINT `matriculas_ibfk_3` FOREIGN KEY (`id_seccion`) REFERENCES `secciones` (`id_seccion`);

--
-- Filtros para la tabla `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiantes` (`id_estudiante`),
  ADD CONSTRAINT `notas_ibfk_2` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`),
  ADD CONSTRAINT `notas_ibfk_3` FOREIGN KEY (`id_competencia`) REFERENCES `competencia` (`id_competencia`),
  ADD CONSTRAINT `notas_ibfk_4` FOREIGN KEY (`id_periodo`) REFERENCES `periodos` (`id_periodo`);

--
-- Filtros para la tabla `permisos_roles`
--
ALTER TABLE `permisos_roles`
  ADD CONSTRAINT `permisos_roles_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`),
  ADD CONSTRAINT `permisos_roles_ibfk_2` FOREIGN KEY (`id_permiso`) REFERENCES `permisos` (`id_permiso`);

--
-- Filtros para la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD CONSTRAINT `reportes_ibfk_1` FOREIGN KEY (`id_estudiante`) REFERENCES `estudiantes` (`id_estudiante`),
  ADD CONSTRAINT `reportes_ibfk_2` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
