-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 12, 2026 at 07:03 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_buku_tamu_digital`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `visit_id` bigint UNSIGNED DEFAULT NULL,
  `visit_status_history_id` bigint UNSIGNED DEFAULT NULL,
  `activity` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `module` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `visit_id`, `visit_status_history_id`, `activity`, `module`, `description`, `created_at`) VALUES
(1, 1, NULL, NULL, 'test', 'system', 'Pengujian ActivityLogService.', '2026-09-24 13:13:24'),
(2, 1, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-09-24 13:18:45'),
(3, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-09-24 13:19:05'),
(4, 1, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-09-24 13:19:12'),
(5, NULL, NULL, NULL, 'login_failed', 'authentication', 'Percobaan login gagal karena username/email atau password tidak valid.', '2026-09-24 13:19:27'),
(6, NULL, NULL, NULL, 'login_failed', 'authentication', 'Percobaan login gagal karena username/email atau password tidak valid.', '2026-09-24 13:19:34'),
(7, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-09-24 13:29:30'),
(8, 1, NULL, NULL, 'create', 'users', 'Pengguna baru berhasil dibuat. ID: 3', '2026-09-24 14:12:31'),
(9, 1, NULL, NULL, 'update', 'users', 'Data pengguna berhasil diperbarui. ID: 3', '2026-09-24 14:55:26'),
(10, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-09-25 02:11:44'),
(11, 1, NULL, NULL, 'deactivate', 'users', 'Pengguna berhasil dinonaktifkan. ID: 3', '2026-09-25 02:21:07'),
(12, 1, NULL, NULL, 'activate', 'users', 'Pengguna berhasil diaktifkan. ID: 3', '2026-09-25 02:21:14'),
(13, 1, NULL, NULL, 'delete', 'users', 'Pengguna berhasil dihapus. ID: 3', '2026-09-25 02:25:52'),
(14, 1, NULL, NULL, 'restore', 'users', 'Pengguna berhasil dipulihkan. ID: 3', '2026-09-25 02:33:30'),
(15, 1, NULL, NULL, 'reset_password', 'users', 'Password pengguna berhasil direset. ID: 3', '2026-09-25 02:54:08'),
(16, 1, NULL, NULL, 'create', 'employees', 'Pegawai berhasil ditambahkan. ID: 5', '2026-09-25 03:13:38'),
(17, 1, NULL, NULL, 'update', 'employees', 'Pegawai berhasil diperbarui. ID: 5', '2026-09-25 03:25:58'),
(18, 1, NULL, NULL, 'delete', 'employees', 'Pegawai berhasil dihapus. ID: 5', '2026-09-25 03:31:35'),
(19, 1, NULL, NULL, 'create', 'departments', 'Bagian berhasil ditambahkan. ID: 5', '2026-09-25 03:56:12'),
(20, 1, NULL, NULL, 'update', 'departments', 'Bagian berhasil diperbarui. ID: 5', '2026-09-25 04:01:07'),
(21, 1, NULL, NULL, 'delete', 'departments', 'Bagian berhasil dihapus. ID: 5', '2026-09-25 04:06:52'),
(22, 1, NULL, NULL, 'delete', 'departments', 'Bagian berhasil dihapus. ID: 4', '2026-09-25 04:08:53'),
(23, 1, NULL, NULL, 'delete', 'users', 'Pengguna berhasil dihapus. ID: 3', '2026-09-25 04:27:37'),
(24, 1, NULL, NULL, 'restore', 'users', 'Pengguna berhasil dipulihkan. ID: 3', '2026-09-25 04:28:05'),
(25, 1, NULL, NULL, 'create', 'visit_purposes', 'Keperluan kunjungan berhasil ditambahkan. ID: 6', '2026-09-25 05:58:14'),
(26, 1, NULL, NULL, 'delete', 'visit_purposes', 'Keperluan kunjungan berhasil dihapus. ID: 6', '2026-09-25 06:04:31'),
(27, 1, NULL, NULL, 'create', 'visit_purposes', 'Keperluan kunjungan berhasil ditambahkan. ID: 7', '2026-09-25 06:08:41'),
(28, 1, NULL, NULL, 'delete', 'visit_purposes', 'Keperluan kunjungan berhasil dihapus. ID: 7', '2026-09-25 06:08:50'),
(29, 1, NULL, NULL, 'restore', 'visit_purposes', 'Keperluan kunjungan berhasil dipulihkan. ID: 7', '2026-09-25 06:11:27'),
(30, 1, NULL, NULL, 'delete', 'visit_purposes', 'Keperluan kunjungan berhasil dihapus. ID: 7', '2026-09-25 06:11:35'),
(31, 1, NULL, NULL, 'restore', 'visit_purposes', 'Keperluan kunjungan berhasil dipulihkan. ID: 7', '2026-09-25 06:11:48'),
(32, 1, NULL, NULL, 'delete', 'employees', 'Pegawai berhasil dihapus. ID: 1', '2026-09-25 06:14:38'),
(33, 1, NULL, NULL, 'restore', 'employees', 'Pegawai berhasil dipulihkan. ID: 5', '2026-09-25 06:15:38'),
(34, 1, NULL, NULL, 'update', 'institution_profiles', 'Identitas instansi berhasil diperbarui. ID: 1', '2026-09-25 06:41:25'),
(35, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-09-26 07:28:32'),
(36, 1, NULL, NULL, 'delete', 'users', 'Pengguna berhasil dihapus. ID: 3', '2026-09-26 08:14:14'),
(37, 1, NULL, NULL, 'deactivate', 'users', 'Pengguna berhasil dinonaktifkan. ID: 2', '2026-09-26 08:25:50'),
(38, 1, NULL, NULL, 'delete', 'users', 'Pengguna berhasil dihapus. ID: 1', '2026-09-26 08:30:54'),
(39, 1, NULL, NULL, 'restore', 'users', 'Pengguna berhasil dipulihkan. ID: 3', '2026-09-26 08:53:49'),
(40, 1, NULL, NULL, 'delete', 'users', 'Pengguna berhasil dihapus. ID: 2', '2026-09-26 08:53:59'),
(41, 1, NULL, NULL, 'restore', 'users', 'Pengguna berhasil dipulihkan. ID: 2', '2026-09-26 08:54:12'),
(42, 1, NULL, NULL, 'activate', 'users', 'Pengguna berhasil diaktifkan. ID: 2', '2026-09-26 09:30:11'),
(43, 1, NULL, NULL, 'restore', 'users', 'Pengguna berhasil dipulihkan. ID: 1', '2026-09-26 09:43:54'),
(44, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-09-26 13:23:23'),
(45, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-09-27 07:30:35'),
(46, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-09-27 14:07:26'),
(47, 1, NULL, NULL, 'delete', 'users', 'Pengguna berhasil dihapus. ID: 3', '2026-09-27 14:07:38'),
(48, 1, NULL, NULL, 'restore', 'users', 'Pengguna berhasil dipulihkan. ID: 3', '2026-09-27 14:12:45'),
(49, 1, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-09-27 14:14:45'),
(50, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-09-27 14:16:46'),
(51, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-09-27 14:17:47'),
(52, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-09-27 14:18:00'),
(53, 1, NULL, NULL, 'delete', 'users', 'Pengguna berhasil dihapus. ID: 3', '2026-09-27 14:20:27'),
(54, 1, NULL, NULL, 'reset_password', 'users', 'Password pengguna berhasil direset. ID: 2', '2026-09-27 14:59:32'),
(55, 1, NULL, NULL, 'deactivate', 'users', 'Pengguna berhasil dinonaktifkan. ID: 2', '2026-09-27 15:02:54'),
(56, 1, NULL, NULL, 'activate', 'users', 'Pengguna berhasil diaktifkan. ID: 2', '2026-09-27 15:03:13'),
(57, 1, NULL, NULL, 'restore', 'users', 'Pengguna berhasil dipulihkan. ID: 3', '2026-09-27 15:05:13'),
(58, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-09-28 02:12:59'),
(59, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-09-28 06:13:30'),
(60, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-09-28 12:23:44'),
(61, 1, NULL, NULL, 'deactivate', 'users', 'Pengguna berhasil dinonaktifkan. ID: 3', '2026-09-28 14:09:20'),
(62, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-09-29 02:02:13'),
(63, 1, NULL, NULL, 'create', 'users', 'Pengguna baru berhasil dibuat. ID: 4', '2026-09-29 02:45:52'),
(64, 1, NULL, NULL, 'update', 'users', 'Data pengguna berhasil diperbarui. ID: 4', '2026-09-29 02:50:33'),
(65, 1, NULL, NULL, 'reset_password', 'users', 'Password pengguna berhasil direset. ID: 4', '2026-09-29 02:51:06'),
(66, 1, NULL, NULL, 'deactivate', 'users', 'Pengguna berhasil dinonaktifkan. ID: 4', '2026-09-29 02:51:21'),
(67, 1, NULL, NULL, 'activate', 'users', 'Pengguna berhasil diaktifkan. ID: 4', '2026-09-29 02:51:42'),
(68, 1, NULL, NULL, 'delete', 'users', 'Pengguna berhasil dihapus. ID: 4', '2026-09-29 02:52:00'),
(69, 1, NULL, NULL, 'restore', 'users', 'Pengguna berhasil dipulihkan. ID: 4', '2026-09-29 02:52:29'),
(70, 1, NULL, NULL, 'delete', 'users', 'Pengguna berhasil dihapus. ID: 3', '2026-09-29 02:52:39'),
(71, 1, NULL, NULL, 'restore', 'users', 'Pengguna berhasil dipulihkan. ID: 3', '2026-09-29 02:52:48'),
(72, 1, NULL, NULL, 'create', 'users', 'Pengguna baru berhasil dibuat. ID: 5', '2026-09-29 03:17:59'),
(73, 1, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-09-29 04:32:34'),
(74, 1, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-09-29 04:34:03'),
(75, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-09-29 04:34:17'),
(76, 1, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-09-29 04:42:30'),
(77, 1, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-09-29 04:42:46'),
(78, 1, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-09-29 04:43:13'),
(79, 1, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-09-29 06:39:52'),
(80, 1, NULL, NULL, 'deactivate', 'employees', 'Pegawai berhasil dinonaktifkan. ID: 5', '2026-09-29 06:47:20'),
(81, 1, NULL, NULL, 'activate', 'employees', 'Pegawai berhasil diaktifkan. ID: 5', '2026-09-29 06:47:56'),
(82, 1, NULL, NULL, 'delete', 'employees', 'Pegawai berhasil dihapus. ID: 5', '2026-09-29 06:48:06'),
(83, 1, NULL, NULL, 'restore', 'employees', 'Pegawai berhasil dipulihkan. ID: 5', '2026-09-29 06:49:07'),
(84, 1, NULL, NULL, 'restore', 'employees', 'Pegawai berhasil dipulihkan. ID: 1', '2026-09-29 06:49:24'),
(85, 1, NULL, NULL, 'deactivate', 'employees', 'Pegawai berhasil dinonaktifkan. ID: 5', '2026-09-29 06:50:01'),
(86, 1, NULL, NULL, 'activate', 'employees', 'Pegawai berhasil diaktifkan. ID: 5', '2026-09-29 06:50:11'),
(87, 1, NULL, NULL, 'delete', 'employees', 'Pegawai berhasil dihapus. ID: 5', '2026-09-29 06:50:20'),
(88, 1, NULL, NULL, 'create', 'employees', 'Pegawai baru berhasil dibuat. ID: 6', '2026-09-29 07:46:57'),
(89, 1, NULL, NULL, 'update', 'employees', 'Pegawai berhasil diperbarui. ID: 6', '2026-09-29 07:47:26'),
(90, 1, NULL, NULL, 'deactivate', 'employees', 'Pegawai berhasil dinonaktifkan. ID: 6', '2026-09-29 08:21:50'),
(91, 1, NULL, NULL, 'update', 'departments', 'Bagian berhasil diperbarui. ID: 1', '2026-09-29 08:22:23'),
(92, 1, NULL, NULL, 'delete', 'departments', 'Bagian berhasil dihapus. ID: 1', '2026-09-29 08:22:45'),
(93, 1, NULL, NULL, 'restore', 'departments', 'Bagian berhasil dipulihkan. ID: 1', '2026-09-29 09:44:41'),
(94, 1, NULL, NULL, 'restore', 'departments', 'Bagian berhasil dipulihkan. ID: 5', '2026-09-29 09:44:52'),
(95, 1, NULL, NULL, 'restore', 'departments', 'Bagian berhasil dipulihkan. ID: 4', '2026-09-29 09:44:59'),
(96, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-09-30 02:03:36'),
(97, 1, NULL, NULL, 'delete', 'departments', 'Bagian berhasil dihapus. ID: 1', '2026-09-30 02:04:47'),
(98, 1, NULL, NULL, 'restore', 'departments', 'Bagian berhasil dipulihkan. ID: 1', '2026-09-30 02:05:03'),
(99, 1, NULL, NULL, 'create', 'departments', 'Bagian baru berhasil dibuat. ID: 6', '2026-09-30 02:06:08'),
(100, 1, NULL, NULL, 'update', 'departments', 'Bagian berhasil diperbarui. ID: 6', '2026-09-30 02:06:30'),
(101, 1, NULL, NULL, 'deactivate', 'departments', 'Bagian berhasil dinonaktifkan. ID: 6', '2026-09-30 02:06:43'),
(102, 1, NULL, NULL, 'activate', 'departments', 'Bagian berhasil diaktifkan. ID: 6', '2026-09-30 02:06:50'),
(103, 1, NULL, NULL, 'create', 'visit_purposes', 'Keperluan kunjungan baru berhasil dibuat. ID: 8', '2026-09-30 02:14:03'),
(104, 1, NULL, NULL, 'update', 'visit_purposes', 'Keperluan kunjungan berhasil diperbarui. ID: 8', '2026-09-30 02:14:26'),
(105, 1, NULL, NULL, 'deactivate', 'visit_purposes', 'Keperluan kunjungan berhasil dinonaktifkan. ID: 8', '2026-09-30 02:14:40'),
(106, 1, NULL, NULL, 'delete', 'visit_purposes', 'Keperluan kunjungan berhasil dihapus. ID: 8', '2026-09-30 02:14:44'),
(107, 1, NULL, NULL, 'restore', 'visit_purposes', 'Keperluan kunjungan berhasil dipulihkan. ID: 6', '2026-09-30 02:14:55'),
(108, 1, NULL, NULL, 'update', 'institution_profiles', 'Identitas instansi berhasil diperbarui. ID: 1', '2026-09-30 02:21:37'),
(109, 1, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-09-30 10:29:46'),
(110, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-09-30 10:34:49'),
(111, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-09-30 10:35:10'),
(112, 1, NULL, NULL, 'update', 'users', 'Data pengguna berhasil diperbarui. ID: 5', '2026-09-30 10:35:56'),
(113, 1, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-09-30 10:36:00'),
(114, NULL, NULL, NULL, 'login_failed', 'authentication', 'Percobaan login gagal karena username/email atau password tidak valid.', '2026-09-30 10:36:09'),
(115, 1, NULL, NULL, 'reset_password', 'users', 'Password pengguna berhasil direset. ID: 5', '2026-09-30 10:37:27'),
(116, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-09-30 10:37:51'),
(117, 1, NULL, NULL, 'deactivate', 'users', 'Pengguna berhasil dinonaktifkan. ID: 5', '2026-09-30 10:38:11'),
(118, NULL, NULL, NULL, 'login_failed', 'authentication', 'Percobaan login gagal karena username/email atau password tidak valid.', '2026-09-30 10:38:24'),
(119, NULL, NULL, NULL, 'login_failed', 'authentication', 'Percobaan login gagal karena username/email atau password tidak valid.', '2026-09-30 10:41:15'),
(120, 1, NULL, NULL, 'activate', 'users', 'Pengguna berhasil diaktifkan. ID: 5', '2026-09-30 10:41:25'),
(121, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-09-30 10:41:30'),
(122, 5, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-09-30 10:41:34'),
(123, NULL, NULL, NULL, 'login_failed', 'authentication', 'Percobaan login gagal karena username/email atau password tidak valid.', '2026-09-30 10:41:40'),
(124, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-09-30 10:41:48'),
(125, 5, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-09-30 10:41:52'),
(126, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-09-30 10:43:33'),
(127, 5, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-09-30 10:43:36'),
(128, NULL, NULL, NULL, 'login_failed', 'authentication', 'Percobaan login gagal karena username/email atau password tidak valid.', '2026-09-30 10:43:44'),
(129, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-09-30 10:44:39'),
(130, 5, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-09-30 10:44:46'),
(131, NULL, NULL, NULL, 'login_failed', 'authentication', 'Percobaan login gagal karena username/email atau password tidak valid.', '2026-09-30 10:45:02'),
(132, 1, NULL, NULL, 'reset_password', 'users', 'Password pengguna berhasil direset. ID: 2', '2026-09-30 10:45:18'),
(133, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-09-30 10:45:20'),
(134, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-09-30 10:45:27'),
(135, NULL, NULL, NULL, 'login_failed', 'authentication', 'Percobaan login gagal karena username/email atau password tidak valid.', '2026-09-30 10:46:04'),
(136, NULL, NULL, NULL, 'login_failed', 'authentication', 'Percobaan login gagal karena username/email atau password tidak valid.', '2026-09-30 10:46:39'),
(137, NULL, NULL, NULL, 'login_failed', 'authentication', 'Percobaan login gagal karena username/email atau password tidak valid.', '2026-09-30 10:46:54'),
(138, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-09-30 10:47:12'),
(139, 1, NULL, NULL, 'deactivate', 'users', 'Pengguna berhasil dinonaktifkan. ID: 2', '2026-09-30 10:47:35'),
(140, NULL, NULL, NULL, 'login_failed', 'authentication', 'Percobaan login gagal karena username/email atau password tidak valid.', '2026-09-30 10:49:25'),
(141, NULL, NULL, NULL, 'login_failed', 'authentication', 'Percobaan login gagal karena username/email atau password tidak valid.', '2026-09-30 10:49:31'),
(142, 1, NULL, NULL, 'activate', 'users', 'Pengguna berhasil diaktifkan. ID: 2', '2026-09-30 10:49:45'),
(143, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-09-30 10:49:50'),
(144, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-09-30 10:50:51'),
(145, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-09-30 10:50:57'),
(146, 5, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-09-30 10:51:55'),
(147, 1, NULL, NULL, 'reset_password', 'users', 'Password pengguna berhasil direset. ID: 3', '2026-09-30 10:52:15'),
(148, NULL, NULL, NULL, 'login_failed', 'authentication', 'Percobaan login gagal karena username/email atau password tidak valid.', '2026-09-30 10:52:23'),
(149, 1, NULL, NULL, 'activate', 'users', 'Pengguna berhasil diaktifkan. ID: 3', '2026-09-30 10:52:37'),
(150, 3, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-09-30 10:52:40'),
(151, 1, NULL, NULL, 'delete', 'users', 'Pengguna berhasil dihapus. ID: 3', '2026-09-30 10:52:49'),
(152, 1, NULL, NULL, 'restore', 'users', 'Pengguna berhasil dipulihkan. ID: 3', '2026-09-30 10:53:35'),
(153, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-09-30 10:53:39'),
(154, 1, NULL, NULL, 'update', 'users', 'Data pengguna berhasil diperbarui. ID: 3', '2026-09-30 10:54:11'),
(155, 5, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-09-30 10:54:22'),
(156, 3, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-09-30 10:54:34'),
(157, 1, NULL, NULL, 'update', 'users', 'Data pengguna berhasil diperbarui. ID: 3', '2026-09-30 10:54:50'),
(158, 3, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-09-30 11:30:36'),
(159, 3, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-09-30 11:30:42'),
(160, 3, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-09-30 11:30:46'),
(161, NULL, NULL, NULL, 'login_failed', 'authentication', 'Percobaan login gagal karena username/email atau password tidak valid.', '2026-09-30 11:30:51'),
(162, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-09-30 11:40:24'),
(163, 1, NULL, NULL, 'deactivate', 'users', 'Pengguna berhasil dinonaktifkan. ID: 5', '2026-09-30 11:41:04'),
(164, NULL, NULL, NULL, 'login_failed', 'authentication', 'Percobaan login gagal karena akun dinonaktifkan.', '2026-09-30 11:42:02'),
(165, 1, NULL, NULL, 'activate', 'users', 'Pengguna berhasil diaktifkan. ID: 5', '2026-09-30 11:42:03'),
(166, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-09-30 11:42:41'),
(167, 1, NULL, NULL, 'delete', 'users', 'Pengguna berhasil dihapus. ID: 5', '2026-09-30 11:42:46'),
(168, NULL, NULL, NULL, 'login_failed', 'authentication', 'Percobaan login gagal karena akun telah dihapus.', '2026-09-30 11:42:52'),
(169, NULL, NULL, NULL, 'login_failed', 'authentication', 'Percobaan login gagal karena akun telah dihapus.', '2026-09-30 11:44:47'),
(170, 1, NULL, NULL, 'restore', 'users', 'Pengguna berhasil dipulihkan. ID: 5', '2026-09-30 11:45:00'),
(171, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-09-30 11:45:04'),
(172, 1, NULL, NULL, 'deactivate', 'users', 'Pengguna berhasil dinonaktifkan. ID: 5', '2026-09-30 11:45:26'),
(173, NULL, NULL, NULL, 'login_failed', 'authentication', 'Percobaan login gagal karena akun dinonaktifkan.', '2026-09-30 11:47:29'),
(174, NULL, NULL, NULL, 'login_failed', 'authentication', 'Percobaan login gagal karena akun dinonaktifkan.', '2026-09-30 13:23:52'),
(175, 1, NULL, NULL, 'activate', 'users', 'Pengguna berhasil diaktifkan. ID: 5', '2026-09-30 13:24:02'),
(176, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-09-30 13:24:07'),
(177, 5, NULL, NULL, 'create', 'users', 'Pengguna baru berhasil dibuat. ID: 6', '2026-09-30 13:33:12'),
(178, 5, NULL, NULL, 'create', 'users', 'Pengguna baru berhasil dibuat. ID: 7', '2026-09-30 13:34:12'),
(179, 5, NULL, NULL, 'create', 'users', 'Pengguna baru berhasil dibuat. ID: 8', '2026-09-30 13:35:44'),
(180, 5, NULL, NULL, 'update', 'users', 'Data pengguna berhasil diperbarui. ID: 8', '2026-09-30 13:39:23'),
(181, 5, NULL, NULL, 'reset_password', 'users', 'Password pengguna berhasil direset. ID: 8', '2026-09-30 13:40:01'),
(182, 5, NULL, NULL, 'deactivate', 'users', 'Pengguna berhasil dinonaktifkan. ID: 8', '2026-09-30 13:40:13'),
(183, 5, NULL, NULL, 'activate', 'users', 'Pengguna berhasil diaktifkan. ID: 8', '2026-09-30 13:40:18'),
(184, 5, NULL, NULL, 'delete', 'users', 'Pengguna berhasil dihapus. ID: 8', '2026-09-30 13:41:48'),
(185, 5, NULL, NULL, 'restore', 'users', 'Pengguna berhasil dipulihkan. ID: 8', '2026-09-30 13:42:08'),
(186, 1, NULL, NULL, 'deactivate', 'users', 'Pengguna berhasil dinonaktifkan. ID: 8', '2026-09-30 13:58:49'),
(187, 1, NULL, NULL, 'activate', 'users', 'Pengguna berhasil diaktifkan. ID: 8', '2026-09-30 13:58:56'),
(188, 5, NULL, NULL, 'activate', 'employees', 'Pegawai berhasil diaktifkan. ID: 6', '2026-09-30 15:52:36'),
(189, 5, NULL, NULL, 'activate', 'departments', 'Bagian berhasil diaktifkan. ID: 1', '2026-09-30 15:53:08'),
(190, 5, NULL, NULL, 'create', 'employees', 'Pegawai baru berhasil dibuat. ID: 7', '2026-09-30 15:53:44'),
(191, 5, NULL, NULL, 'create', 'employees', 'Pegawai baru berhasil dibuat. ID: 8', '2026-09-30 15:55:04'),
(192, 5, NULL, NULL, 'update', 'employees', 'Pegawai berhasil diperbarui. ID: 6', '2026-09-30 15:58:31'),
(193, 5, NULL, NULL, 'deactivate', 'employees', 'Pegawai berhasil dinonaktifkan. ID: 7', '2026-09-30 15:58:48'),
(194, 5, NULL, NULL, 'activate', 'employees', 'Pegawai berhasil diaktifkan. ID: 7', '2026-09-30 15:58:55'),
(195, 5, NULL, NULL, 'delete', 'employees', 'Pegawai berhasil dihapus. ID: 7', '2026-09-30 15:59:34'),
(196, 5, NULL, NULL, 'restore', 'employees', 'Pegawai berhasil dipulihkan. ID: 7', '2026-09-30 16:00:07'),
(197, 5, NULL, NULL, 'deactivate', 'employees', 'Pegawai berhasil dinonaktifkan. ID: 7', '2026-09-30 16:08:00'),
(198, 5, NULL, NULL, 'activate', 'employees', 'Pegawai berhasil diaktifkan. ID: 7', '2026-09-30 16:08:04'),
(199, 5, NULL, NULL, 'restore', 'employees', 'Pegawai berhasil dipulihkan. ID: 5', '2026-09-30 16:08:40'),
(200, 5, NULL, NULL, 'create', 'departments', 'Bagian baru berhasil dibuat. ID: 7', '2026-09-30 16:11:39'),
(201, 5, NULL, NULL, 'delete', 'departments', 'Bagian berhasil dihapus. ID: 6', '2026-09-30 16:11:58'),
(202, 5, NULL, NULL, 'update', 'departments', 'Bagian berhasil diperbarui. ID: 1', '2026-09-30 16:12:41'),
(203, 5, NULL, NULL, 'deactivate', 'departments', 'Bagian berhasil dinonaktifkan. ID: 1', '2026-09-30 16:13:14'),
(204, 5, NULL, NULL, 'delete', 'departments', 'Bagian berhasil dihapus. ID: 3', '2026-09-30 16:13:41'),
(205, 5, NULL, NULL, 'restore', 'departments', 'Bagian berhasil dipulihkan. ID: 6', '2026-09-30 16:13:50'),
(206, 5, NULL, NULL, 'activate', 'departments', 'Bagian berhasil diaktifkan. ID: 1', '2026-09-30 16:26:42'),
(207, 5, NULL, NULL, 'create', 'visit_purposes', 'Keperluan kunjungan baru berhasil dibuat. ID: 9', '2026-09-30 16:29:24'),
(208, 5, NULL, NULL, 'update', 'visit_purposes', 'Keperluan kunjungan berhasil diperbarui. ID: 9', '2026-09-30 16:30:36'),
(209, 5, NULL, NULL, 'deactivate', 'visit_purposes', 'Keperluan kunjungan berhasil dinonaktifkan. ID: 7', '2026-09-30 16:30:44'),
(210, 5, NULL, NULL, 'activate', 'visit_purposes', 'Keperluan kunjungan berhasil diaktifkan. ID: 7', '2026-09-30 16:30:54'),
(211, 5, NULL, NULL, 'delete', 'visit_purposes', 'Keperluan kunjungan berhasil dihapus. ID: 9', '2026-09-30 16:30:59'),
(212, 5, NULL, NULL, 'restore', 'visit_purposes', 'Keperluan kunjungan berhasil dipulihkan. ID: 9', '2026-09-30 16:31:13'),
(213, 5, NULL, NULL, 'deactivate', 'visit_purposes', 'Keperluan kunjungan berhasil dinonaktifkan. ID: 9', '2026-09-30 16:31:29'),
(214, 5, NULL, NULL, 'update', 'institution_profiles', 'Identitas instansi berhasil diperbarui. ID: 1', '2026-09-30 16:38:18'),
(215, 5, NULL, NULL, 'update', 'institution_profiles', 'Identitas instansi berhasil diperbarui. ID: 1', '2026-09-30 16:40:51'),
(216, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-01 05:47:19'),
(217, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-01 05:47:29'),
(218, 5, NULL, NULL, 'update', 'institution_profiles', 'Identitas instansi berhasil diperbarui. ID: 1', '2026-10-01 05:57:23'),
(219, 5, NULL, NULL, 'update', 'institution_profiles', 'Identitas instansi berhasil diperbarui. ID: 1', '2026-10-01 06:15:54'),
(220, 5, NULL, NULL, 'update', 'institution_profiles', 'Identitas instansi berhasil diperbarui. ID: 1', '2026-10-01 06:17:39'),
(221, 5, NULL, NULL, 'update', 'institution_profiles', 'Identitas instansi berhasil diperbarui. ID: 1', '2026-10-01 06:28:20'),
(222, 1, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-10-01 06:36:00'),
(223, 1, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-10-01 06:36:32'),
(224, 1, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-10-01 06:37:17'),
(225, 1, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-10-01 06:38:05'),
(226, 1, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-10-01 06:43:55'),
(227, 1, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-10-01 06:44:11'),
(228, 1, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-10-01 06:48:18'),
(229, 1, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-10-01 06:48:26'),
(230, 1, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-10-01 06:49:03'),
(231, 1, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-10-01 06:50:18'),
(232, 1, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-10-01 06:53:39'),
(233, 1, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-10-01 06:53:50'),
(234, 1, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-10-01 06:54:08'),
(235, 1, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-10-01 06:54:24'),
(236, 1, NULL, NULL, 'update', 'whatsapp_settings', 'Pengaturan WhatsApp berhasil diperbarui. ID: 1', '2026-10-01 06:56:11'),
(237, 1, NULL, NULL, 'update', 'whatsapp_settings', 'Pengaturan WhatsApp berhasil diperbarui. ID: 1', '2026-10-01 06:56:30'),
(238, 1, NULL, NULL, 'update', 'whatsapp_settings', 'Pengaturan WhatsApp berhasil diperbarui. ID: 1', '2026-10-01 06:57:12'),
(239, 1, NULL, NULL, 'update', 'whatsapp_settings', 'Pengaturan WhatsApp berhasil diperbarui. ID: 1', '2026-10-01 07:00:31'),
(240, 1, NULL, NULL, 'update', 'whatsapp_settings', 'Pengaturan WhatsApp berhasil diperbarui. ID: 1', '2026-10-01 07:05:06'),
(241, 1, NULL, NULL, 'update', 'whatsapp_settings', 'Pengaturan WhatsApp berhasil diperbarui. ID: 1', '2026-10-01 07:05:36'),
(242, 1, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-10-01 07:10:05'),
(243, 1, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-01 09:07:30'),
(244, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-01 09:07:41'),
(245, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-01 09:11:34'),
(246, 5, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-01 09:20:15'),
(247, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-01 09:20:20'),
(248, 5, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-01 09:42:34'),
(249, NULL, NULL, NULL, 'login_failed', 'authentication', 'Percobaan login gagal karena username/email atau password tidak valid.', '2026-10-01 09:42:40'),
(250, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-01 09:42:58'),
(251, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-01 09:43:01'),
(252, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-01 09:46:31'),
(253, 5, NULL, NULL, 'create', 'users', 'Pengguna baru berhasil dibuat. ID: 9', '2026-10-01 09:47:17'),
(254, 5, NULL, NULL, 'create', 'departments', 'Bagian baru berhasil dibuat. ID: 8', '2026-10-01 10:18:41'),
(255, 5, NULL, NULL, 'create', 'employees', 'Pegawai baru berhasil dibuat. ID: 9', '2026-10-01 10:19:21'),
(256, 5, NULL, NULL, 'deactivate', 'employees', 'Pegawai berhasil dinonaktifkan. ID: 9', '2026-10-01 10:20:12'),
(257, 5, NULL, NULL, 'deactivate', 'departments', 'Bagian berhasil dinonaktifkan. ID: 8', '2026-10-01 10:20:34'),
(258, 5, NULL, NULL, 'delete', 'employees', 'Pegawai berhasil dihapus. ID: 9', '2026-10-01 10:21:04'),
(259, 5, NULL, NULL, 'create', 'users', 'Pengguna baru berhasil dibuat. ID: 10', '2026-10-01 10:32:25'),
(260, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-01 14:55:08'),
(261, 5, NULL, NULL, 'update', 'institution_profiles', 'Identitas instansi berhasil diperbarui. ID: 1', '2026-10-01 15:00:26'),
(262, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-01 15:29:39'),
(263, NULL, 2, 2, 'register', 'visits', 'Registrasi kunjungan oleh tamu sari. Kode: BT-20261002-0002', '2026-10-02 10:37:04'),
(264, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-02 11:31:01'),
(265, 1, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-02 11:33:43'),
(266, NULL, NULL, NULL, 'login_failed', 'authentication', 'Percobaan login gagal karena username/email atau password tidak valid.', '2026-10-02 11:33:53'),
(267, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-02 11:34:04'),
(268, 2, 1, 3, 'check_in', 'visits', 'Check-in kunjungan BT-20261002-0001', '2026-10-02 13:05:25'),
(269, 2, 1, 4, 'checkout', 'visits', 'Checkout kunjungan BT-20261002-0001. Durasi: 1 menit', '2026-10-02 13:06:41'),
(270, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-02 13:27:05'),
(271, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-02 13:27:15'),
(272, 1, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-02 13:52:53'),
(273, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-02 13:59:02'),
(274, 1, NULL, NULL, 'update', 'institution_profiles', 'Identitas instansi berhasil diperbarui. ID: 1', '2026-10-02 13:59:28'),
(275, 1, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-02 13:59:39'),
(276, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-02 14:13:28'),
(277, 1, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-02 14:14:22'),
(278, NULL, 3, 5, 'register', 'visits', 'Registrasi kunjungan oleh tamu fitriasari. Kode: BT-20261002-0003', '2026-10-02 16:08:25'),
(279, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-02 16:08:56'),
(280, 1, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-02 16:09:17'),
(281, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-02 16:09:34'),
(282, 2, 3, 6, 'check_in', 'visits', 'Check-in kunjungan BT-20261002-0003', '2026-10-02 16:09:51'),
(283, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-02 16:10:38'),
(284, NULL, 4, 7, 'register', 'visits', 'Registrasi kunjungan oleh tamu YAYAK. Kode: BT-20261002-0004', '2026-10-02 16:14:44'),
(285, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-03 19:08:26'),
(286, NULL, 5, 8, 'register', 'visits', 'Registrasi kunjungan oleh tamu yayuk. Kode: BT-20261003-0001', '2026-10-03 19:18:59'),
(287, 1, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-10-03 20:10:56'),
(288, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-04 14:45:00'),
(289, 1, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-04 15:40:30'),
(290, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-04 15:45:46'),
(291, 1, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-04 15:47:05'),
(292, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-04 15:47:12'),
(293, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-05 08:53:00'),
(294, 1, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-05 09:40:50'),
(295, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-05 09:41:01'),
(296, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-05 09:41:15'),
(297, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-05 09:56:32'),
(298, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-05 10:06:54'),
(299, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-05 10:07:00'),
(300, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-05 10:07:04'),
(301, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-05 10:07:15'),
(302, 1, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-05 10:07:24'),
(303, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-05 10:07:33'),
(304, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-05 13:48:04'),
(305, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-05 13:49:25'),
(306, NULL, 6, 9, 'register', 'visits', 'Registrasi kunjungan oleh tamu biji. Kode: BT-20261005-0001', '2026-10-05 13:55:35'),
(307, 2, 6, 10, 'check_in', 'visits', 'Check-in kunjungan BT-20261005-0001', '2026-10-05 13:57:59'),
(308, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-05 15:58:55'),
(309, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-05 15:59:09'),
(310, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-06 09:01:23'),
(311, 2, 6, 11, 'checkout', 'visits', 'Checkout via QR. Kode: BT-20261005-0001. Durasi: 19 jam 11 menit', '2026-10-06 09:09:55'),
(312, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-06 09:16:03'),
(313, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-06 09:16:11'),
(314, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-06 09:22:17'),
(315, 5, NULL, NULL, 'delete', 'visits', 'Kunjungan BT-20261002-0001 dihapus.', '2026-10-06 11:35:07'),
(316, 5, NULL, NULL, 'delete', 'visits', 'Kunjungan BT-20261002-0002 dihapus.', '2026-10-06 12:51:16'),
(317, 5, NULL, NULL, 'delete', 'users', 'Pengguna berhasil dihapus. ID: 6', '2026-10-06 13:04:07'),
(318, 5, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-06 13:41:29'),
(319, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-06 13:41:35'),
(320, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-06 14:08:05'),
(321, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-06 14:26:05'),
(322, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-06 14:26:21'),
(323, 5, NULL, NULL, 'restore', 'visits', 'Kunjungan BT-20261002-0002 dipulihkan.', '2026-10-06 14:27:02'),
(324, 1, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-06 14:28:33'),
(325, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-06 14:28:42'),
(326, 2, 5, NULL, 'update', 'visits', 'Kunjungan BT-20261003-0001 diperbarui.', '2026-10-06 14:35:41'),
(327, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-06 15:07:15'),
(328, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-06 15:07:24'),
(329, 1, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-06 15:22:34'),
(330, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-06 15:22:43'),
(331, NULL, 7, 12, 'register', 'visits', 'Registrasi kunjungan oleh tamu santoso. Kode: BT-20261007-0001', '2026-10-07 09:40:05'),
(332, NULL, 8, 13, 'register', 'visits', 'Registrasi kunjungan oleh tamu yuyu. Kode: BT-20261007-0002', '2026-10-07 09:45:25'),
(333, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-07 09:56:49'),
(334, 5, 4, 14, 'check_in', 'visits', 'Check-in kunjungan BT-20261002-0004', '2026-10-07 09:57:57'),
(335, 5, 4, 15, 'checkout', 'visits', 'Checkout kunjungan BT-20261002-0004. Durasi: 52 detik', '2026-10-07 09:58:49'),
(336, 5, 5, 16, 'reject', 'visits', 'Kunjungan BT-20261003-0001 ditolak. Alasan: tujuan tidak jelas', '2026-10-07 09:59:33'),
(337, 5, 2, 17, 'cancel', 'visits', 'Kunjungan BT-20261002-0002 dibatalkan.', '2026-10-07 10:01:21'),
(338, 5, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-07 10:01:31'),
(339, NULL, NULL, NULL, 'login_failed', 'authentication', 'Percobaan login gagal karena username/email atau password tidak valid.', '2026-10-07 10:01:38'),
(340, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-07 10:01:44'),
(341, 2, 7, 18, 'check_in', 'visits', 'Check-in kunjungan BT-20261007-0001', '2026-10-07 10:02:27'),
(342, 2, 7, 19, 'checkout', 'visits', 'Checkout kunjungan BT-20261007-0001. Durasi: 42 detik', '2026-10-07 10:03:09'),
(343, 2, 8, NULL, 'update', 'visits', 'Kunjungan BT-20261007-0002 diperbarui.', '2026-10-07 10:04:04'),
(344, 2, 8, 20, 'reject', 'visits', 'Kunjungan BT-20261007-0002 ditolak. Alasan: data kurang', '2026-10-07 10:06:20'),
(345, NULL, 9, 21, 'register', 'visits', 'Registrasi kunjungan oleh tamu dila. Kode: BT-20261007-0003', '2026-10-07 10:08:05'),
(346, 2, 9, 22, 'cancel', 'visits', 'Kunjungan BT-20261007-0003 dibatalkan.', '2026-10-07 10:08:52'),
(347, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-07 10:08:58'),
(348, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-07 10:09:02'),
(349, 5, NULL, NULL, 'restore', 'visits', 'Kunjungan BT-20261002-0001 dipulihkan.', '2026-10-07 10:09:22'),
(350, 5, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-07 10:10:03'),
(351, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-07 10:10:11'),
(352, NULL, 10, 23, 'register', 'visits', 'Registrasi kunjungan oleh tamu unik. Kode: BT-20261007-0004', '2026-10-07 10:11:35'),
(353, 2, 10, 24, 'check_in', 'visits', 'Check-in kunjungan BT-20261007-0004', '2026-10-07 10:13:15'),
(354, 2, 10, 25, 'checkout', 'visits', 'Checkout via QR. Kode: BT-20261007-0004. Durasi: 33 detik', '2026-10-07 10:13:48'),
(355, NULL, 11, 26, 'register', 'visits', 'Registrasi kunjungan oleh tamu ninik. Kode: BT-20261007-0005', '2026-10-07 10:18:21'),
(356, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-07 10:18:53'),
(357, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-07 10:19:00'),
(358, 5, NULL, NULL, 'delete', 'visits', 'Kunjungan BT-20261007-0005 dihapus.', '2026-10-07 10:19:12'),
(359, 5, NULL, NULL, 'restore', 'visits', 'Kunjungan BT-20261007-0005 dipulihkan.', '2026-10-07 10:21:14'),
(360, 5, NULL, NULL, 'delete', 'visits', 'Kunjungan BT-20261007-0004 dihapus.', '2026-10-07 10:22:55'),
(361, 5, NULL, NULL, 'restore', 'visits', 'Kunjungan BT-20261007-0004 dipulihkan.', '2026-10-07 10:23:44'),
(362, 5, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-07 10:45:00'),
(363, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-07 10:45:07'),
(364, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-07 10:46:36'),
(365, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-07 10:46:42'),
(366, 5, NULL, NULL, 'delete', 'visits', 'Kunjungan BT-20261007-0005 dihapus.', '2026-10-07 10:47:06'),
(367, 5, NULL, NULL, 'restore', 'visits', 'Kunjungan BT-20261007-0005 dipulihkan.', '2026-10-07 10:47:35'),
(368, 5, NULL, NULL, 'delete', 'visits', 'Kunjungan BT-20261007-0003 dihapus.', '2026-10-07 10:47:58'),
(369, 5, NULL, NULL, 'delete', 'visits', 'Kunjungan BT-20261007-0002 dihapus.', '2026-10-07 10:48:07'),
(370, 5, NULL, NULL, 'restore', 'visits', 'Kunjungan BT-20261007-0003 dipulihkan.', '2026-10-07 10:48:30'),
(371, 5, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-07 10:50:12'),
(372, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-07 10:57:15'),
(373, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-07 10:58:16'),
(374, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-07 10:58:28'),
(375, 5, NULL, NULL, 'delete', 'visits', 'Kunjungan BT-20261007-0005 dihapus.', '2026-10-07 11:00:05'),
(376, 5, NULL, NULL, 'restore', 'visits', 'Kunjungan BT-20261007-0005 dipulihkan.', '2026-10-07 11:00:45'),
(377, 5, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-07 11:05:30'),
(378, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-07 11:05:37'),
(379, 2, 11, 27, 'reject', 'visits', 'Kunjungan BT-20261007-0005 ditolak. Alasan: gak lengkap', '2026-10-07 11:06:21'),
(380, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-07 11:13:14'),
(381, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-07 11:13:20'),
(382, 5, NULL, NULL, 'restore', 'visits', 'Kunjungan BT-20261007-0002 dipulihkan.', '2026-10-07 11:15:02'),
(383, NULL, 12, 28, 'register', 'visits', 'Registrasi kunjungan oleh tamu diana. Kode: BT-20261007-0006', '2026-10-07 11:16:20'),
(384, 5, NULL, NULL, 'delete', 'visits', 'Kunjungan BT-20261007-0006 dihapus.', '2026-10-07 11:16:42'),
(385, 5, NULL, NULL, 'restore', 'visits', 'Kunjungan BT-20261007-0006 dipulihkan.', '2026-10-07 11:16:50'),
(386, 5, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-07 11:17:13'),
(387, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-07 11:17:20'),
(388, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-07 11:23:35'),
(389, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-07 11:23:41'),
(390, 5, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-07 11:41:29'),
(391, NULL, 13, 29, 'register', 'visits', 'Registrasi kunjungan oleh tamu juni. Kode: BT-20261007-0007', '2026-10-07 13:14:00'),
(392, NULL, 14, 30, 'register', 'visits', 'Registrasi kunjungan oleh tamu kuin. Kode: BT-20261007-0008', '2026-10-07 13:38:35'),
(393, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-07 13:42:23'),
(394, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-07 13:42:30'),
(395, 5, 14, 31, 'check_in', 'visits', 'Check-in kunjungan BT-20261007-0008', '2026-10-07 14:23:44'),
(396, 2, 13, 32, 'reject', 'visits', 'Kunjungan BT-20261007-0007 ditolak. Alasan: gapapa', '2026-10-07 14:25:15'),
(397, 2, 14, 33, 'checkout', 'visits', 'Checkout via QR. Kode: BT-20261007-0008. Durasi: 2 menit', '2026-10-07 14:26:42'),
(398, 5, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-07 14:45:02'),
(399, 3, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-07 14:45:09'),
(400, 3, 3, 34, 'checkout', 'visits', 'Checkout kunjungan BT-20261002-0003. Durasi: 4 hari 22 jam', '2026-10-07 14:46:02'),
(401, 3, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-07 14:46:38'),
(402, NULL, 15, 35, 'register', 'visits', 'Registrasi kunjungan oleh tamu amat. Kode: BT-20261007-0009', '2026-10-07 14:47:37'),
(403, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-07 15:37:14'),
(404, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-07 15:37:22'),
(405, 1, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-07 15:38:41'),
(406, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-07 15:39:46'),
(407, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-07 16:01:52'),
(408, 5, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-07 16:05:51'),
(409, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-07 16:41:10'),
(410, 2, 12, 36, 'check_in', 'visits', 'Check-in kunjungan BT-20261007-0006', '2026-10-07 16:41:26'),
(411, 2, 12, 37, 'checkout', 'visits', 'Checkout kunjungan BT-20261007-0006. Durasi: 12 detik', '2026-10-07 16:41:38'),
(412, 2, 15, 38, 'check_in', 'visits', 'Check-in kunjungan BT-20261007-0009', '2026-10-07 16:42:14'),
(413, 2, 15, 39, 'checkout', 'visits', 'Checkout via QR. Kode: BT-20261007-0009. Durasi: 1 menit', '2026-10-07 16:43:39'),
(414, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-07 16:44:01'),
(415, NULL, 16, 40, 'register', 'visits', 'Registrasi kunjungan oleh tamu sifa. Kode: BT-20261007-0010', '2026-10-07 16:46:14'),
(416, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-07 16:46:45'),
(417, 2, 16, NULL, 'update', 'visits', 'Kunjungan BT-20261007-0010 diperbarui.', '2026-10-07 16:47:22'),
(418, 2, 16, NULL, 'update', 'visits', 'Kunjungan BT-20261007-0010 diperbarui.', '2026-10-07 16:47:38'),
(419, 2, 16, 41, 'check_in', 'visits', 'Check-in kunjungan BT-20261007-0010', '2026-10-07 16:48:06'),
(420, 2, 16, 42, 'checkout', 'visits', 'Checkout kunjungan BT-20261007-0010. Durasi: 31 detik', '2026-10-07 16:48:37'),
(421, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-07 16:49:00'),
(422, NULL, 17, 43, 'register', 'visits', 'Registrasi kunjungan oleh tamu wiwik. Kode: BT-20261007-0011', '2026-10-07 16:51:56'),
(423, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-07 16:52:36'),
(424, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-08 09:05:49'),
(425, 2, 17, 44, 'reject', 'visits', 'Kunjungan BT-20261007-0011 ditolak. Alasan: gamau', '2026-10-08 09:06:39'),
(426, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-08 10:22:55'),
(427, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-08 10:23:00'),
(428, 5, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-10-08 10:43:43'),
(429, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-08 10:44:00'),
(430, 1, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-08 10:44:05'),
(431, 5, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-10-08 10:44:49'),
(432, NULL, 18, 45, 'register', 'visits', 'Registrasi kunjungan oleh tamu muti. Kode: BT-20261008-0001', '2026-10-08 10:46:54'),
(433, 5, 18, 46, 'check_in', 'visits', 'Check-in kunjungan BT-20261008-0001', '2026-10-08 10:47:35'),
(434, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-08 11:09:38'),
(435, 1, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-10-08 11:09:53'),
(436, 1, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-08 11:09:59'),
(437, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-08 11:10:09'),
(438, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-08 11:49:12'),
(439, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-08 13:03:21'),
(440, 5, NULL, NULL, 'update', 'whatsapp_settings', 'Pengaturan WhatsApp berhasil diperbarui. ID: 1', '2026-10-08 13:11:23'),
(441, 5, NULL, NULL, 'test', 'whatsapp_settings', 'Test kirim WhatsApp ke 089652248149 (outbox_id: 6768)', '2026-10-08 13:27:34'),
(442, 5, NULL, NULL, 'test', 'whatsapp_settings', 'Test kirim WhatsApp ke 089652248149 (outbox_id: 6769)', '2026-10-08 13:27:37'),
(443, 5, NULL, NULL, 'update', 'whatsapp_settings', 'Pengaturan WhatsApp berhasil diperbarui. ID: 1', '2026-10-08 13:31:57'),
(444, 5, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-08 13:32:12'),
(445, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-08 13:33:34'),
(446, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-08 13:33:45'),
(447, 1, 18, 47, 'checkout', 'visits', 'Checkout kunjungan BT-20261008-0001. Durasi: 2 jam 46 menit', '2026-10-08 13:34:05'),
(448, 1, NULL, NULL, 'create', 'employees', 'Pegawai baru berhasil dibuat. ID: 10', '2026-10-08 13:34:46'),
(449, 1, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-10-08 13:35:34'),
(450, NULL, 19, 48, 'register', 'visits', 'Registrasi kunjungan oleh tamu Raka. Kode: BT-20261008-0002', '2026-10-08 13:36:18'),
(451, NULL, 20, 49, 'register', 'visits', 'Registrasi kunjungan oleh tamu Alif. Kode: BT-20261008-0003', '2026-10-08 14:00:08'),
(452, 1, NULL, NULL, 'update', 'whatsapp_settings', 'Pengaturan WhatsApp berhasil diperbarui. ID: 1', '2026-10-08 14:16:05'),
(453, 1, NULL, NULL, 'update', 'whatsapp_settings', 'Pengaturan WhatsApp berhasil diperbarui. ID: 1', '2026-10-08 14:16:27'),
(454, NULL, 21, 50, 'register', 'visits', 'Registrasi kunjungan oleh tamu Alif. Kode: BT-20261008-0004', '2026-10-08 14:17:30'),
(455, 1, 21, 51, 'check_in', 'visits', 'Check-in kunjungan BT-20261008-0004', '2026-10-08 14:18:36'),
(456, NULL, 22, 52, 'register', 'visits', 'Registrasi kunjungan oleh tamu Raka. Kode: BT-20261008-0005', '2026-10-08 14:22:29'),
(457, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-08 14:36:57'),
(458, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-08 15:19:10'),
(459, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-10 19:33:59'),
(460, 1, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-10-10 19:34:42'),
(461, 1, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-10-10 19:37:26');
INSERT INTO `activity_logs` (`id`, `user_id`, `visit_id`, `visit_status_history_id`, `activity`, `module`, `description`, `created_at`) VALUES
(462, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-10 20:24:49'),
(463, 5, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-10 20:25:58'),
(464, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-10 20:26:48'),
(465, 1, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-10 20:51:38'),
(466, 5, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-10 22:53:30'),
(467, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-10 22:53:37'),
(468, 5, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-10 22:55:05'),
(469, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-10 22:55:13'),
(470, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-10 22:55:43'),
(471, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-10 22:56:48'),
(472, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-10 22:56:52'),
(473, NULL, 23, 53, 'register', 'visits', 'Registrasi kunjungan oleh tamu sari. Kode: BT-20261010-0001', '2026-10-10 23:01:05'),
(474, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-10 23:11:32'),
(475, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-10 23:11:37'),
(476, NULL, 24, 54, 'register', 'visits', 'Registrasi kunjungan oleh tamu yuyu. Kode: BT-20261010-0002', '2026-10-10 23:13:56'),
(477, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-10 23:16:31'),
(478, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-10 23:17:22'),
(479, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-10 23:33:48'),
(480, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-10 23:33:53'),
(481, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-10 23:37:04'),
(482, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-10 23:57:32'),
(483, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-10 23:57:36'),
(484, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-11 09:05:27'),
(485, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-11 09:26:46'),
(486, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-11 09:27:17'),
(487, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-11 09:27:28'),
(488, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-11 09:27:35'),
(489, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-11 09:27:43'),
(490, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-11 09:27:46'),
(491, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-11 09:27:53'),
(492, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-11 09:29:11'),
(493, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-11 09:29:16'),
(494, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-11 09:29:19'),
(495, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-11 09:29:22'),
(496, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-11 09:29:28'),
(497, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-11 09:29:33'),
(498, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-11 09:29:40'),
(499, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-11 09:45:18'),
(500, NULL, 25, 55, 'register', 'visits', 'Registrasi kunjungan oleh tamu santi. Kode: BT-20261011-0001', '2026-10-11 09:46:54'),
(501, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-11 10:16:33'),
(502, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-11 10:16:37'),
(503, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-11 10:16:42'),
(504, 5, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-11 10:27:20'),
(505, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-11 10:27:23'),
(506, 5, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-11 11:00:23'),
(507, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-11 11:01:08'),
(508, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-11 22:34:44'),
(509, 5, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-11 22:35:20'),
(510, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-11 22:35:28'),
(511, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-11 22:35:42'),
(512, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-11 22:36:15'),
(513, 5, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-11 22:36:31'),
(514, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-11 22:36:37'),
(515, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-11 22:36:54'),
(516, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-11 22:38:58'),
(517, 5, NULL, NULL, 'create', 'users', 'Pengguna baru berhasil dibuat. ID: 11', '2026-10-11 22:39:52'),
(518, 5, NULL, NULL, 'update', 'users', 'Data pengguna berhasil diperbarui. ID: 11', '2026-10-11 22:40:25'),
(519, 5, NULL, NULL, 'deactivate', 'users', 'Pengguna berhasil dinonaktifkan. ID: 11', '2026-10-11 22:40:48'),
(520, 5, NULL, NULL, 'reset_password', 'users', 'Password pengguna berhasil direset. ID: 11', '2026-10-11 22:41:17'),
(521, 5, NULL, NULL, 'delete', 'users', 'Pengguna berhasil dihapus. ID: 11', '2026-10-11 22:41:37'),
(522, 5, NULL, NULL, 'restore', 'users', 'Pengguna berhasil dipulihkan. ID: 11', '2026-10-11 22:41:59'),
(523, 5, NULL, NULL, 'create', 'employees', 'Pegawai baru berhasil dibuat. ID: 11', '2026-10-11 22:43:00'),
(524, 5, NULL, NULL, 'update', 'employees', 'Pegawai berhasil diperbarui. ID: 11', '2026-10-11 22:43:38'),
(525, 5, NULL, NULL, 'deactivate', 'employees', 'Pegawai berhasil dinonaktifkan. ID: 11', '2026-10-11 22:43:51'),
(526, 5, NULL, NULL, 'delete', 'employees', 'Pegawai berhasil dihapus. ID: 11', '2026-10-11 22:44:10'),
(527, 5, NULL, NULL, 'restore', 'employees', 'Pegawai berhasil dipulihkan. ID: 11', '2026-10-11 22:44:30'),
(528, 5, NULL, NULL, 'delete', 'employees', 'Pegawai berhasil dihapus. ID: 11', '2026-10-11 22:44:40'),
(529, 5, NULL, NULL, 'create', 'departments', 'Bagian baru berhasil dibuat. ID: 9', '2026-10-11 22:45:09'),
(530, 5, NULL, NULL, 'update', 'departments', 'Bagian berhasil diperbarui. ID: 9', '2026-10-11 22:45:38'),
(531, 5, NULL, NULL, 'deactivate', 'departments', 'Bagian berhasil dinonaktifkan. ID: 9', '2026-10-11 22:45:50'),
(532, 5, NULL, NULL, 'delete', 'departments', 'Bagian berhasil dihapus. ID: 9', '2026-10-11 22:46:02'),
(533, 5, NULL, NULL, 'restore', 'departments', 'Bagian berhasil dipulihkan. ID: 9', '2026-10-11 22:46:14'),
(534, 5, NULL, NULL, 'create', 'visit_purposes', 'Keperluan kunjungan baru berhasil dibuat. ID: 10', '2026-10-11 22:46:32'),
(535, 5, NULL, NULL, 'update', 'visit_purposes', 'Keperluan kunjungan berhasil diperbarui. ID: 10', '2026-10-11 22:47:01'),
(536, 5, NULL, NULL, 'deactivate', 'visit_purposes', 'Keperluan kunjungan berhasil dinonaktifkan. ID: 10', '2026-10-11 22:47:11'),
(537, 5, NULL, NULL, 'delete', 'visit_purposes', 'Keperluan kunjungan berhasil dihapus. ID: 10', '2026-10-11 22:47:20'),
(538, 5, NULL, NULL, 'restore', 'visit_purposes', 'Keperluan kunjungan berhasil dipulihkan. ID: 10', '2026-10-11 22:47:32'),
(539, 5, NULL, NULL, 'update', 'institution_profiles', 'Identitas instansi berhasil diperbarui. ID: 1', '2026-10-11 22:49:27'),
(540, 5, NULL, NULL, 'update', 'institution_profiles', 'Identitas instansi berhasil diperbarui. ID: 1', '2026-10-11 22:49:51'),
(541, 5, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-10-11 22:50:53'),
(542, 5, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-10-11 22:51:15'),
(543, 5, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-10-11 22:51:24'),
(544, 5, NULL, NULL, 'update', 'whatsapp_settings', 'Pengaturan WhatsApp berhasil diperbarui. ID: 1', '2026-10-11 22:52:52'),
(545, 5, NULL, NULL, 'test', 'whatsapp_settings', 'Test kirim WhatsApp ke 089652248149 (outbox_id: 7983)', '2026-10-11 22:53:29'),
(546, 5, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-11 22:54:17'),
(547, NULL, 26, 56, 'register', 'visits', 'Registrasi kunjungan oleh tamu Test Tamu. Kode: BT-20261011-0002', '2026-10-11 23:00:19'),
(548, NULL, 27, 57, 'register', 'visits', 'Registrasi kunjungan oleh tamu test2. Kode: BT-20261011-0003', '2026-10-11 23:05:20'),
(549, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-11 23:07:34'),
(550, 5, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-10-11 23:07:55'),
(551, 5, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-11 23:07:58'),
(552, NULL, 28, 58, 'register', 'visits', 'Registrasi kunjungan oleh tamu test3. Kode: BT-20261011-0004', '2026-10-11 23:09:02'),
(553, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-11 23:10:13'),
(554, 2, 27, 59, 'check_in', 'visits', 'Check-in kunjungan BT-20261011-0003', '2026-10-11 23:11:10'),
(555, 2, 27, 60, 'checkout', 'visits', 'Checkout kunjungan BT-20261011-0003. Durasi: 1 menit', '2026-10-11 23:12:22'),
(556, 2, 28, 61, 'check_in', 'visits', 'Check-in kunjungan BT-20261011-0004', '2026-10-11 23:12:50'),
(557, 2, 26, 62, 'check_in', 'visits', 'Check-in kunjungan BT-20261011-0002', '2026-10-11 23:14:17'),
(558, 2, 26, 63, 'checkout', 'visits', 'Checkout via QR. Kode: BT-20261011-0002. Durasi: 2 menit', '2026-10-11 23:16:50'),
(559, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-11 23:18:49'),
(560, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-11 23:19:11'),
(561, 5, 25, NULL, 'update', 'visits', 'Kunjungan BT-20261011-0001 diperbarui.', '2026-10-11 23:20:29'),
(562, 5, NULL, NULL, 'delete', 'visits', 'Kunjungan BT-20261011-0001 dihapus.', '2026-10-11 23:20:47'),
(563, 5, NULL, NULL, 'restore', 'visits', 'Kunjungan BT-20261011-0001 dipulihkan.', '2026-10-11 23:21:03'),
(564, 5, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-11 23:25:01'),
(565, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-11 23:25:07'),
(566, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-11 23:28:30'),
(567, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-11 23:28:54'),
(568, 5, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-11 23:29:25'),
(569, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-11 23:31:25'),
(570, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-11 23:35:02'),
(571, 2, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-11 23:36:22'),
(572, 2, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-11 23:36:35'),
(573, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-11 23:36:42'),
(574, 5, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-11 23:37:52'),
(575, NULL, 29, 64, 'register', 'visits', 'Registrasi kunjungan oleh tamu <script>alert(1)</script>. Kode: BT-20261011-0005', '2026-10-11 23:38:58'),
(576, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-11 23:42:03'),
(577, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-12 06:41:56'),
(578, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-12 08:57:04'),
(579, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-12 09:04:27'),
(580, 5, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-12 09:21:05'),
(581, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-12 09:24:21'),
(582, 5, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-12 09:55:36'),
(583, 1, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-12 10:11:36'),
(584, 5, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-12 10:27:47'),
(585, 5, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-10-12 10:28:19'),
(586, 5, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-10-12 10:28:32'),
(587, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-12 10:48:31'),
(588, 1, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-12 11:03:44'),
(589, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-12 11:03:55'),
(590, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-12 13:36:51'),
(591, 1, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-10-12 13:37:51'),
(592, 1, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-10-12 13:39:14'),
(593, 1, NULL, NULL, 'logout', 'authentication', 'Pengguna berhasil logout.', '2026-10-12 13:39:24'),
(594, 1, NULL, NULL, 'login', 'authentication', 'Pengguna berhasil login.', '2026-10-12 13:39:48'),
(595, 1, NULL, NULL, 'update', 'settings', 'Pengaturan sistem berhasil diperbarui. ID: 1', '2026-10-12 13:42:59');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Administrasisi', 1, '2026-09-21 06:35:55', '2026-09-30 16:26:42', NULL),
(2, 'Pelayanan', 1, '2026-09-21 06:35:55', '2026-09-21 06:35:55', NULL),
(3, 'Keuangan', 1, '2026-09-21 06:35:56', '2026-09-30 16:13:41', '2026-09-30 16:13:41'),
(4, 'Umum', 1, '2026-09-21 06:35:56', '2026-09-29 09:44:59', NULL),
(5, 'Security Umum', 1, '2026-09-25 03:56:12', '2026-09-29 09:44:52', NULL),
(6, 'Bisaya', 1, '2026-09-30 02:06:08', '2026-09-30 16:13:50', NULL),
(7, 'Bisayay', 1, '2026-09-30 16:11:39', '2026-09-30 16:11:39', NULL),
(8, 'test', 0, '2026-10-01 10:18:41', '2026-10-01 10:20:34', NULL),
(9, 'Test Departemen Edited', 0, '2026-10-11 22:45:09', '2026-10-11 22:46:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint UNSIGNED NOT NULL,
  `department_id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nomor_hp` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `department_id`, `name`, `nomor_hp`, `email`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Andi Pratama', '081234560001', 'andipratama123@gmail.com', 1, '2026-09-21 06:35:56', '2026-09-29 06:49:24', NULL),
(2, 2, 'Siti Rahma', '081234560002', 'sitirahma123@gmail.com', 1, '2026-09-21 06:35:56', '2026-09-21 06:35:56', NULL),
(3, 3, 'Budi Santoso', '081234560003', 'budisantoso123@gmail.com', 1, '2026-09-21 06:35:56', '2026-09-21 06:35:56', NULL),
(4, 4, 'Dewi Lestari', '081234560004', 'dewilestari123@gmail.com', 1, '2026-09-21 06:35:56', '2026-09-21 06:35:56', NULL),
(5, 3, 'Aidilia Fitriasari', '089652248149', 'aidiliafitria811@gmail.com', 1, '2026-09-25 03:13:38', '2026-09-30 16:08:40', NULL),
(6, 1, 'aaaapy', '0896522481494', 'aidiliafitria8111@gmail.com', 1, '2026-09-29 07:46:57', '2026-09-30 15:58:31', NULL),
(7, 1, 'aaaap', '089652248149', 'aidiliafitriad811@gmail.com', 1, '2026-09-30 15:53:44', '2026-09-30 16:08:04', NULL),
(8, 1, 'aidilia', '089652248149', 'aidiliafitria8112@gmail.com', 1, '2026-09-30 15:55:04', '2026-09-30 15:55:04', NULL),
(9, 8, 'a test', '089652248149', 'aidiliafitria8171@gmail.com', 0, '2026-10-01 10:19:21', '2026-10-01 10:21:04', '2026-10-01 10:21:04'),
(10, 1, 'Aidilia Fitriasari', '089652248149', 'aidiliafitria8121@gmail.com', 1, '2026-10-08 13:34:46', '2026-10-08 13:34:46', NULL),
(11, 1, 'Test Pegawai Edited', '081234567777', 'testpegawai@test.com', 0, '2026-10-11 22:43:00', '2026-10-11 22:44:40', '2026-10-11 22:44:40');

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `address` text COLLATE utf8mb4_general_ci NOT NULL,
  `identity_type` enum('ktp','sim','paspor','kartu_pelajar','kartu_mahasiswa','lainnya') COLLATE utf8mb4_general_ci NOT NULL,
  `identity_number` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`id`, `name`, `phone`, `address`, `identity_type`, `identity_number`, `created_at`, `updated_at`, `deleted_at`) VALUES
(15, 'aidilia', '089652248149', 'Desa Kenongomulyo', 'kartu_mahasiswa', '243307062', '2026-10-02 10:31:42', '2026-10-02 10:31:42', NULL),
(16, 'sari', '089652248149', 'kenongomulyo magetan', 'kartu_mahasiswa', '243307062', '2026-10-02 10:37:04', '2026-10-02 10:37:04', NULL),
(17, 'fitriasari', '089652248149', 'kenongomulyo', 'kartu_mahasiswa', '243307062', '2026-10-02 16:08:25', '2026-10-02 16:08:25', NULL),
(18, 'YAYAK', '089652248149', 'MAGETAN', 'kartu_mahasiswa', '12345678', '2026-10-02 16:14:44', '2026-10-02 16:14:44', NULL),
(19, 'yayuk', '089652248149', 'magetan', 'kartu_mahasiswa', '2433070628', '2026-10-03 19:18:59', '2026-10-06 14:35:41', NULL),
(20, 'biji', '089652248149', 'Desa Kenongomulyo', 'sim', '1122334455667', '2026-10-05 13:55:35', '2026-10-05 13:55:35', NULL),
(21, 'santoso', '081234567898', 'jakarta', 'sim', '1122334455667', '2026-10-07 09:40:05', '2026-10-07 09:40:05', NULL),
(22, 'yuyu', '0843947394732', 'madiun', 'kartu_mahasiswa', '11223344', '2026-10-07 09:45:25', '2026-10-07 10:04:04', NULL),
(23, 'dila', '08976654356', 'merdeka', 'kartu_mahasiswa', '1122334453', '2026-10-07 10:08:05', '2026-10-07 10:08:05', NULL),
(24, 'unik', '08963663281', 'jakai', 'kartu_pelajar', '11223344', '2026-10-07 10:11:35', '2026-10-07 10:11:35', NULL),
(25, 'ninik', '081347364329', 'yayac', 'kartu_pelajar', '1123332', '2026-10-07 10:18:21', '2026-10-07 10:18:21', NULL),
(26, 'diana', '08974548218', 'angsa', 'sim', '112233446655', '2026-10-07 11:16:20', '2026-10-07 11:16:20', NULL),
(27, 'juni', '089652248149', 'merdeka', 'ktp', '1122334455667788', '2026-10-07 13:14:00', '2026-10-07 13:14:00', NULL),
(28, 'kuin', '0897462131211', 'majani', 'kartu_mahasiswa', '1143434355', '2026-10-07 13:38:34', '2026-10-07 13:38:34', NULL),
(29, 'amat', '08965467889', 'kukuj', 'ktp', '1122334455667788', '2026-10-07 14:47:37', '2026-10-07 14:47:37', NULL),
(30, 'sifa', '08924924333', 'merdekaja', 'kartu_mahasiswa', '2224124444', '2026-10-07 16:46:14', '2026-10-07 16:47:38', NULL),
(31, 'wiwik', '0896358532329', 'mujiya', 'sim', '1122334455667', '2026-10-07 16:51:56', '2026-10-07 16:51:56', NULL),
(32, 'muti', '089652248149', 'diakamu', 'sim', '11223344556667', '2026-10-08 10:46:54', '2026-10-08 10:46:54', NULL),
(33, 'Raka', '085648516713', 'Desa Kenongomulyo', 'kartu_mahasiswa', '112233445', '2026-10-08 13:36:18', '2026-10-08 13:36:18', NULL),
(34, 'Alif', '085648516713', 'kartini', 'ktp', '1122334455667788', '2026-10-08 14:00:08', '2026-10-08 14:00:08', NULL),
(35, 'Alif', '085648516713', 'Desa Kenongomulyo', 'kartu_mahasiswa', '112233445', '2026-10-08 14:17:30', '2026-10-08 14:17:30', NULL),
(36, 'Raka', '085648516713', 'Desa Kenongomulyo', 'kartu_mahasiswa', '112233445', '2026-10-08 14:22:29', '2026-10-08 14:22:29', NULL),
(37, 'sari', '085648516713', 'Desa Kenongomulyo', 'paspor', '11223344555', '2026-10-10 23:01:05', '2026-10-10 23:01:05', NULL),
(38, 'yuyu', '085648516713', 'desa kenongomulyo', 'kartu_mahasiswa', '11223344556', '2026-10-10 23:13:56', '2026-10-10 23:13:56', NULL),
(39, 'santin', '085648516713', 'merdeka', 'kartu_pelajar', '122233455', '2026-10-11 09:46:54', '2026-10-11 23:20:29', NULL),
(40, 'Test Tamu', '085648516713', 'Jl. Test No. 1', 'ktp', '1234567890123456', '2026-10-11 23:00:19', '2026-10-11 23:00:19', NULL),
(41, 'test2', '085648516713', 'Desa Kenongomulyo', 'kartu_mahasiswa', '112233445', '2026-10-11 23:05:20', '2026-10-11 23:05:20', NULL),
(42, 'test3', '081234567898', 'Desa Kenongomulyo', 'kartu_pelajar', '1122334', '2026-10-11 23:09:02', '2026-10-11 23:09:02', NULL),
(43, '<script>alert(1)</script>', '081234567898', 'Desa Kenongomulyo', 'kartu_mahasiswa', '112233445', '2026-10-11 23:38:58', '2026-10-11 23:38:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `institution_profiles`
--

CREATE TABLE `institution_profiles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `institution_profiles`
--

INSERT INTO `institution_profiles` (`id`, `name`, `logo`, `address`, `phone`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Kantor Amins Project Teknologi Indonesia Jaya', 'uploads/institution/1791733791_8789a806fa369dcd5388.png', 'Jl. Cempedak VI No.I, Taman, Kec. Taman, Kota Madiun, Jawa Timur 631312', '0812345678985', 'info@aminsproject.testt', '2026-09-21 06:35:56', '2026-10-11 22:49:51');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint UNSIGNED NOT NULL,
  `version` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `class` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `group` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `namespace` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `time` int NOT NULL,
  `batch` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2026-09-21-033133', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1789962640, 1),
(2, '2026-09-21-033140', 'App\\Database\\Migrations\\CreateGuestsTable', 'default', 'App', 1789962640, 1),
(3, '2026-09-21-033151', 'App\\Database\\Migrations\\CreateDepartmentsTable', 'default', 'App', 1789962640, 1),
(4, '2026-09-21-033157', 'App\\Database\\Migrations\\CreateEmployeesTable', 'default', 'App', 1789962640, 1),
(5, '2026-09-21-033203', 'App\\Database\\Migrations\\CreateVisitPurposesTable', 'default', 'App', 1789962641, 1),
(6, '2026-09-21-033209', 'App\\Database\\Migrations\\CreateSettingsTable', 'default', 'App', 1789962641, 1),
(7, '2026-09-21-033219', 'App\\Database\\Migrations\\CreateInstitutionProfilesTable', 'default', 'App', 1789962641, 1),
(8, '2026-09-21-033225', 'App\\Database\\Migrations\\CreateWhatsappSettingsTable', 'default', 'App', 1789962641, 1),
(9, '2026-09-21-033237', 'App\\Database\\Migrations\\CreateVisitsTable', 'default', 'App', 1789962641, 1),
(10, '2026-09-21-033242', 'App\\Database\\Migrations\\CreateVisitStatusHistoriesTable', 'default', 'App', 1789962641, 1),
(11, '2026-09-21-033248', 'App\\Database\\Migrations\\CreateActivityLogsTable', 'default', 'App', 1789962641, 1),
(12, '2026-09-21-033255', 'App\\Database\\Migrations\\CreateNotificationsTable', 'default', 'App', 1789962641, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `visit_id` bigint UNSIGNED NOT NULL,
  `recipient_type` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `recipient_phone` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `notification_type` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('pending','sent','failed') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'pending',
  `sent_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `visit_id`, `recipient_type`, `recipient_phone`, `notification_type`, `status`, `sent_at`, `created_at`, `updated_at`) VALUES
(1, 18, 'pegawai', '6289652248149', 'peringatan_kunjungan', 'sent', '2026-10-08 13:33:00', '2026-10-08 13:33:00', '2026-10-08 13:33:00'),
(2, 19, 'tamu', '6285648516713', 'qr_kunjungan', 'sent', '2026-10-08 13:36:19', '2026-10-08 13:36:19', '2026-10-08 13:36:19'),
(3, 19, 'pegawai', '6289652248149', 'notifikasi_tujuan', 'sent', '2026-10-08 13:36:19', '2026-10-08 13:36:19', '2026-10-08 13:36:19'),
(4, 20, 'tamu', '6285648516713', 'qr_kunjungan', 'sent', '2026-10-08 14:00:20', '2026-10-08 14:00:20', '2026-10-08 14:00:20'),
(5, 20, 'pegawai', '6289652248149', 'notifikasi_tujuan', 'sent', '2026-10-08 14:00:21', '2026-10-08 14:00:21', '2026-10-08 14:00:21'),
(6, 21, 'pegawai', '6289652248149', 'notifikasi_tujuan', 'sent', '2026-10-08 14:17:42', '2026-10-08 14:17:42', '2026-10-08 14:17:42'),
(7, 21, 'tamu', '6285648516713', 'qr_kunjungan', 'sent', '2026-10-08 14:18:37', '2026-10-08 14:18:37', '2026-10-08 14:18:37'),
(8, 22, 'pegawai', '6289652248149', 'notifikasi_tujuan', 'sent', '2026-10-08 14:22:30', '2026-10-08 14:22:30', '2026-10-08 14:22:30'),
(9, 21, 'pegawai', '6289652248149', 'peringatan_kunjungan', 'sent', '2026-10-08 14:50:15', '2026-10-08 14:50:15', '2026-10-08 14:50:15'),
(10, 23, 'pegawai', '6289652248149', 'notifikasi_tujuan', 'sent', '2026-10-10 23:01:06', '2026-10-10 23:01:06', '2026-10-10 23:01:06'),
(11, 24, 'pegawai', '6289652248149', 'notifikasi_tujuan', 'sent', '2026-10-10 23:14:08', '2026-10-10 23:14:08', '2026-10-10 23:14:08'),
(12, 25, 'pegawai', '6289652248149', 'notifikasi_tujuan', 'sent', '2026-10-11 09:46:55', '2026-10-11 09:46:55', '2026-10-11 09:46:55'),
(13, 26, 'pegawai', '6289652248149', 'notifikasi_tujuan', 'sent', '2026-10-11 23:00:31', '2026-10-11 23:00:31', '2026-10-11 23:00:31'),
(14, 27, 'pegawai', '6289652248149', 'notifikasi_tujuan', 'sent', '2026-10-11 23:05:21', '2026-10-11 23:05:21', '2026-10-11 23:05:21'),
(15, 28, 'pegawai', '6289652248149', 'notifikasi_tujuan', 'sent', '2026-10-11 23:09:14', '2026-10-11 23:09:14', '2026-10-11 23:09:14'),
(16, 27, 'tamu', '6285648516713', 'qr_kunjungan', 'sent', '2026-10-11 23:11:11', '2026-10-11 23:11:11', '2026-10-11 23:11:11'),
(17, 28, 'tamu', '6281234567898', 'qr_kunjungan', 'sent', '2026-10-11 23:12:51', '2026-10-11 23:12:51', '2026-10-11 23:12:51'),
(18, 26, 'tamu', '6285648516713', 'qr_kunjungan', 'sent', '2026-10-11 23:14:29', '2026-10-11 23:14:29', '2026-10-11 23:14:29'),
(19, 29, 'pegawai', '6289652248149', 'notifikasi_tujuan', 'sent', '2026-10-11 23:39:10', '2026-10-11 23:39:10', '2026-10-11 23:39:10'),
(20, 28, 'pegawai', '6289652248149', 'peringatan_kunjungan', 'sent', '2026-10-12 06:42:09', '2026-10-12 06:42:09', '2026-10-12 06:42:09');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `primary_color` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `photo_required` tinyint(1) NOT NULL DEFAULT '1',
  `signature_required` tinyint(1) NOT NULL DEFAULT '1',
  `max_photo_size` int UNSIGNED NOT NULL DEFAULT '500',
  `visit_warning` int UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `primary_color`, `photo_required`, `signature_required`, `max_photo_size`, `visit_warning`, `created_at`, `updated_at`) VALUES
(1, '#1e750b', 1, 1, 1000, 30, '2026-09-21 06:35:56', '2026-10-12 13:42:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('administrator','petugas') COLLATE utf8mb4_general_ci NOT NULL,
  `nomor_hp` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `nomor_hp`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 'administrator123@gmail.com', '$2y$10$qxML2AJ6uQonGASpwZEE8u/S2XB9OfF771s1v3saXle08O5LR/pCi', 'administrator', '081234567890', 1, '2026-09-21 06:35:55', '2026-09-26 09:43:54', NULL),
(2, 'petugas', 'petugas123@gmail.com', '$2y$10$9O9dZawCXtc.SCCiD9cMSOUMYRvRzf0wGqyCznoTadtU5kMfjhODi', 'petugas', '081234567891', 1, '2026-09-21 06:35:55', '2026-09-30 10:49:45', NULL),
(3, 'petugass2', 'petugas2@gmail.com', '$2y$10$ZgqHXvINFYnoenlVA/eBQeM5klozE9lqlkxD3dDHw96.YZGIUJ74q', 'petugas', '089652248149', 1, '2026-09-24 14:12:31', '2026-09-30 10:54:50', NULL),
(4, 'adminn2', 'administrator1234@gmail.com', '$2y$10$CTqnbi0cCvdeOEOgWPyrwe1ESlnMQvrZY2iw7Kfsxdka8tGdLiYdC', 'administrator', '089652248149', 1, '2026-09-29 02:45:52', '2026-09-29 02:52:29', NULL),
(5, 'admin aidilia', 'administrator12345@gmail.com', '$2y$10$yrODXJRhQStqsVoxbP7d1OekIwGOx6JTs9pCLyEyz/28h7z/P9YTW', 'administrator', '089652248149', 1, '2026-09-29 03:17:59', '2026-09-30 13:24:02', NULL),
(6, 'admin1', 'administrator1236@gmail.com', '$2y$10$2NuZwGDMOyYiD9m.SPpDQO1LPMmsKOrqSvDkwyqZSNFfkBTgpFgM6', 'administrator', '089652248149', 1, '2026-09-30 13:33:12', '2026-10-06 13:04:07', '2026-10-06 13:04:07'),
(7, 'admin12', 'administrator123@gmail.comm', '$2y$10$dkB7nAzkT0j6Nac7WldzE.iaN1Muoua6nMRIcsTlh1Q5ssndKj3HK', 'administrator', '089652248149', 1, '2026-09-30 13:34:12', '2026-09-30 13:34:12', NULL),
(8, 'adminya', 'administrator12365@gmail.com', '$2y$10$exKAeCntnJhNNA0HoZ6QJOb87RPYesX/ZOUUYGrHb59/BHIdVruni', 'administrator', '089652248149', 1, '2026-09-30 13:35:44', '2026-09-30 13:58:56', NULL),
(9, 'adminnyaya', 'aidiliafitria8117@gmail.com', '$2y$10$R7ofiKNj4ok0kb6bkjNezuM4Gm7JAJ.xt6lw07W578RPK.iuU6jwW', 'administrator', '089652248149', 1, '2026-10-01 09:47:17', '2026-10-01 09:47:17', NULL),
(10, 'sari', 'aidiliafitria811@gmail.com', '$2y$10$XVD/7HD0K0wRg3xaOWc02uaKgPyhDJ8GeXPH3Ad8iygK5mE7KiEou', 'administrator', '089652248149', 1, '2026-10-01 10:32:25', '2026-10-01 10:32:25', NULL),
(11, 'testuser-edited', 'testuser@test.com', '$2y$10$41bET71F4Jqma1RDdEF9ZOzD3uWL1LAbXtmecv60uUnNMJjAF9VTO', 'petugas', '081234567899', 0, '2026-10-11 22:39:52', '2026-10-11 22:41:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `id` bigint UNSIGNED NOT NULL,
  `guest_id` bigint UNSIGNED NOT NULL,
  `visit_code` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `qr_token` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `origin_institution` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `department_id` bigint UNSIGNED NOT NULL,
  `employee_id` bigint UNSIGNED NOT NULL,
  `visit_purpose_id` bigint UNSIGNED NOT NULL,
  `group_count` smallint UNSIGNED NOT NULL,
  `data_consent` tinyint(1) NOT NULL DEFAULT '0',
  `arrival_at` datetime NOT NULL,
  `status` enum('menunggu','ditolak','dibatalkan','masih_berkunjung','selesai') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'menunggu',
  `photo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `signature` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `checkin_at` datetime DEFAULT NULL,
  `checkout_at` datetime DEFAULT NULL,
  `duration` int UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`id`, `guest_id`, `visit_code`, `qr_token`, `origin_institution`, `department_id`, `employee_id`, `visit_purpose_id`, `group_count`, `data_consent`, `arrival_at`, `status`, `photo`, `signature`, `checkin_at`, `checkout_at`, `duration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 15, 'BT-20261002-0001', 'b87032a658ed6152713092df31cc668b', 'PNM', 1, 7, 1, 3, 1, '2026-10-02 10:31:43', 'selesai', 'uploads/visits/photos/2026/10/photo_BT-20261002-0001_20261002103142_a3e3936c.jpg', 'uploads/visits/signatures/2026/10/signature_BT-20261002-0001_20261002103142_ccb07441.csv', '2026-10-02 13:05:25', '2026-10-02 13:06:41', 76, '2026-10-02 10:31:43', '2026-10-07 10:09:22', NULL),
(2, 16, 'BT-20261002-0002', 'af36049d28a207dacc53524d8e0c2384', 'PNM', 1, 7, 4, 3, 1, '2026-10-02 10:37:04', 'dibatalkan', 'uploads/visits/photos/2026/10/photo_BT-20261002-0002_20261002103704_c524ccdf.jpg', 'uploads/visits/signatures/2026/10/signature_BT-20261002-0002_20261002103704_27bc7462.csv', NULL, NULL, NULL, '2026-10-02 10:37:04', '2026-10-07 10:01:21', NULL),
(3, 17, 'BT-20261002-0003', '2006c5e6aa9b9685458d75bdf21b3867', 'PNM', 2, 2, 3, 1, 1, '2026-10-02 16:08:25', 'selesai', 'uploads/visits/photos/2026/10/photo_BT-20261002-0003_20261002160825_25aa1ee8.jpg', 'uploads/visits/signatures/2026/10/signature_BT-20261002-0003_20261002160825_5b7026a5.csv', '2026-10-02 16:09:51', '2026-10-07 14:46:02', 426971, '2026-10-02 16:08:25', '2026-10-02 16:09:51', NULL),
(4, 18, 'BT-20261002-0004', '1afb5d39de5d56e68d99e4780994e67c', 'PNM', 1, 8, 4, 1, 1, '2026-10-02 16:14:44', 'selesai', 'uploads/visits/photos/2026/10/photo_BT-20261002-0004_20261002161444_960a1635.jpg', 'uploads/visits/signatures/2026/10/signature_BT-20261002-0004_20261002161444_951f8f73.csv', '2026-10-07 09:57:57', '2026-10-07 09:58:49', 52, '2026-10-02 16:14:44', '2026-10-07 09:58:49', NULL),
(5, 19, 'BT-20261003-0001', 'd756014c5cf1feafee3388cccb2e12e3', 'PNM', 2, 2, 5, 3, 1, '2026-10-03 19:18:59', 'ditolak', 'uploads/visits/photos/2026/10/photo_BT-20261003-0001_20261003191859_43ba9f99.jpg', 'uploads/visits/signatures/2026/10/signature_BT-20261003-0001_20261003191859_a4687919.csv', NULL, NULL, NULL, '2026-10-03 19:18:59', '2026-10-07 09:59:33', NULL),
(6, 20, 'BT-20261005-0001', 'b8c37ee2092ca1e7e44b8d9ee7e465fa', 'PNM', 1, 7, 4, 1, 1, '2026-10-05 13:55:35', 'selesai', 'uploads/visits/photos/2026/10/photo_BT-20261005-0001_20261005135535_08bb37c4.jpg', 'uploads/visits/signatures/2026/10/signature_BT-20261005-0001_20261005135535_c78050b5.png', '2026-10-05 13:57:59', '2026-10-06 09:09:55', 69116, '2026-10-05 13:55:35', '2026-10-06 09:09:55', NULL),
(7, 21, 'BT-20261007-0001', '2263e13bff9aa82d9821439985680d16', 'JAYA', 2, 2, 3, 1, 1, '2026-10-07 09:40:05', 'selesai', 'uploads/visits/photos/2026/10/photo_BT-20261007-0001_20261007094005_0a3d35cc.jpg', 'uploads/visits/signatures/2026/10/signature_BT-20261007-0001_20261007094005_261d06be567eb197.png', '2026-10-07 10:02:27', '2026-10-07 10:03:09', 42, '2026-10-07 09:40:05', '2026-10-07 10:03:09', NULL),
(8, 22, 'BT-20261007-0002', 'aae7430f74c8d322ec6fbd49f6642d0b', 'Unipma', 4, 4, 2, 1, 1, '2026-10-07 09:45:25', 'ditolak', 'uploads/visits/photos/2026/10/photo_BT-20261007-0002_20261007094525_3265fe56.jpg', 'uploads/visits/signatures/2026/10/signature_BT-20261007-0002_20261007094525_f9d9865e22e08851.png', NULL, NULL, NULL, '2026-10-07 09:45:25', '2026-10-07 11:15:02', NULL),
(9, 23, 'BT-20261007-0003', '24c859bbd67fb47f9047953b1991048d', 'maju', 1, 6, 3, 1, 1, '2026-10-07 10:08:05', 'dibatalkan', 'uploads/visits/photos/2026/10/photo_BT-20261007-0003_20261007100805_a6b430a6.jpg', 'uploads/visits/signatures/2026/10/signature_BT-20261007-0003_20261007100805_27cec8cf8645efe3.png', NULL, NULL, NULL, '2026-10-07 10:08:05', '2026-10-07 10:48:30', NULL),
(10, 24, 'BT-20261007-0004', 'f0c8c8964ffa3b4fbd5ffac0a89dc28c', 'ptn', 1, 1, 7, 4, 1, '2026-10-07 10:11:35', 'selesai', 'uploads/visits/photos/2026/10/photo_BT-20261007-0004_20261007101135_6cc69405.jpg', 'uploads/visits/signatures/2026/10/signature_BT-20261007-0004_20261007101135_1b1bd35c28847643.png', '2026-10-07 10:13:15', '2026-10-07 10:13:48', 33, '2026-10-07 10:11:35', '2026-10-07 10:23:44', NULL),
(11, 25, 'BT-20261007-0005', '8cb51b06cc51f79069699fdbd5bdf14d', 'kondang', 4, 4, 6, 1, 1, '2026-10-07 10:18:21', 'ditolak', 'uploads/visits/photos/2026/10/photo_BT-20261007-0005_20261007101821_27596f37.jpg', 'uploads/visits/signatures/2026/10/signature_BT-20261007-0005_20261007101821_f49ea72966c5e3cd.png', NULL, NULL, NULL, '2026-10-07 10:18:21', '2026-10-07 11:06:21', NULL),
(12, 26, 'BT-20261007-0006', '66f920f006abc1a631bd163004e23c1b', 'hard', 1, 7, 4, 1, 1, '2026-10-07 11:16:20', 'selesai', 'uploads/visits/photos/2026/10/photo_BT-20261007-0006_20261007111620_b09192c6.jpg', 'uploads/visits/signatures/2026/10/signature_BT-20261007-0006_20261007111620_d85b798d33d049f5.png', '2026-10-07 16:41:26', '2026-10-07 16:41:38', 12, '2026-10-07 11:16:20', '2026-10-07 11:16:50', NULL),
(13, 27, 'BT-20261007-0007', '1158380248c44a5b0a7ba262f973570e', 'Unipma', 1, 7, 7, 1, 1, '2026-10-07 13:14:00', 'ditolak', 'uploads/visits/photos/2026/10/photo_BT-20261007-0007_20261007131400_97b59810.jpg', 'uploads/visits/signatures/2026/10/signature_BT-20261007-0007_20261007131400_720cc3b5563b7194.png', NULL, NULL, NULL, '2026-10-07 13:14:00', '2026-10-07 13:14:00', NULL),
(14, 28, 'BT-20261007-0008', '017d45f8ce03a00540bc4df1495eff3e', 'mujur', 1, 7, 2, 1, 1, '2026-10-07 13:38:35', 'selesai', 'uploads/visits/photos/2026/10/photo_BT-20261007-0008_20261007133834_5c57de80.jpg', 'uploads/visits/signatures/2026/10/signature_BT-20261007-0008_20261007133834_33908b9ea8c1931d.png', '2026-10-07 14:23:44', '2026-10-07 14:26:42', 178, '2026-10-07 13:38:35', '2026-10-07 14:26:42', NULL),
(15, 29, 'BT-20261007-0009', 'c2ce3154986aa894380f37cc7a887222', 'mukir', 1, 7, 7, 1, 1, '2026-10-07 14:47:37', 'selesai', 'uploads/visits/photos/2026/10/photo_BT-20261007-0009_20261007144737_195acde3.jpg', 'uploads/visits/signatures/2026/10/signature_BT-20261007-0009_20261007144737_2ee681cb8b9e0481.png', '2026-10-07 16:42:14', '2026-10-07 16:43:39', 85, '2026-10-07 14:47:37', '2026-10-07 14:47:37', NULL),
(16, 30, 'BT-20261007-0010', '98fa583e392a2e23e716449ce4dc187b', 'majuh', 1, 7, 7, 1, 1, '2026-10-07 16:46:14', 'selesai', 'uploads/visits/photos/2026/10/photo_BT-20261007-0010_20261007164614_cf3a1bfa.jpg', 'uploads/visits/signatures/2026/10/signature_BT-20261007-0010_20261007164614_ddeaebb9433522d2.png', '2026-10-07 16:48:06', '2026-10-07 16:48:37', 31, '2026-10-07 16:46:14', '2026-10-07 16:47:38', NULL),
(17, 31, 'BT-20261007-0011', '98b8934f1d1b77e5f3fd631a22298806', 'juty', 1, 6, 1, 1, 1, '2026-10-07 16:51:56', 'ditolak', 'uploads/visits/photos/2026/10/photo_BT-20261007-0011_20261007165156_510d662c.jpg', 'uploads/visits/signatures/2026/10/signature_BT-20261007-0011_20261007165156_b41cfe92421a6432.png', NULL, NULL, NULL, '2026-10-07 16:51:56', '2026-10-07 16:51:56', NULL),
(18, 32, 'BT-20261008-0001', 'e324830a5828b8aff4d3e95518b15bf7', 'jaya', 1, 7, 7, 1, 1, '2026-10-08 10:46:54', 'selesai', 'uploads/visits/photos/2026/10/photo_BT-20261008-0001_20261008104654_9fbcf947.jpg', 'uploads/visits/signatures/2026/10/signature_BT-20261008-0001_20261008104654_63d652dd677b16cc.png', '2026-10-08 10:47:34', '2026-10-08 13:34:05', 9991, '2026-10-08 10:46:54', '2026-10-08 10:46:54', NULL),
(19, 33, 'BT-20261008-0002', '78a7e24357c211aaea3a7bdb75dd96f6', 'Maju', 1, 10, 6, 1, 1, '2026-10-08 13:36:18', 'menunggu', 'uploads/visits/photos/2026/10/photo_BT-20261008-0002_20261008133618_9ee41a4b.jpg', 'uploads/visits/signatures/2026/10/signature_BT-20261008-0002_20261008133618_0eb010e8921db9fe.png', NULL, NULL, NULL, '2026-10-08 13:36:18', '2026-10-08 13:36:18', NULL),
(20, 34, 'BT-20261008-0003', '741585124255c96c13237b2e251bbba4', 'PNM', 1, 10, 1, 1, 1, '2026-10-08 14:00:08', 'menunggu', 'uploads/visits/photos/2026/10/photo_BT-20261008-0003_20261008140008_118c6253.jpg', 'uploads/visits/signatures/2026/10/signature_BT-20261008-0003_20261008140008_89783766e89b3174.png', NULL, NULL, NULL, '2026-10-08 14:00:08', '2026-10-08 14:00:08', NULL),
(21, 35, 'BT-20261008-0004', 'c8c67486f9fdafe3d60e41697fab74fc', 'Maju', 1, 10, 6, 1, 1, '2026-10-08 14:17:30', 'masih_berkunjung', 'uploads/visits/photos/2026/10/photo_BT-20261008-0004_20261008141730_8fccbdea.jpg', 'uploads/visits/signatures/2026/10/signature_BT-20261008-0004_20261008141730_859dde66f33cb9bc.png', '2026-10-08 14:18:36', NULL, NULL, '2026-10-08 14:17:30', '2026-10-08 14:17:30', NULL),
(22, 36, 'BT-20261008-0005', '7a81282ad39ae15e77edf60ef6423378', 'PNM', 1, 10, 6, 1, 1, '2026-10-08 14:22:29', 'menunggu', 'uploads/visits/photos/2026/10/photo_BT-20261008-0005_20261008142229_65fcf676.jpg', 'uploads/visits/signatures/2026/10/signature_BT-20261008-0005_20261008142229_fcad9c340896a99c.png', NULL, NULL, NULL, '2026-10-08 14:22:29', '2026-10-08 14:22:29', NULL),
(23, 37, 'BT-20261010-0001', '75f0baddaa1591643720e5fe3fd719e2', 'iyaffu', 1, 10, 4, 1, 1, '2026-10-10 23:01:05', 'menunggu', 'uploads/visits/photos/2026/10/photo_BT-20261010-0001_20261010230105_a93391bd.jpg', 'uploads/visits/signatures/2026/10/signature_BT-20261010-0001_20261010230105_716ca30c3a387a2e.png', NULL, NULL, NULL, '2026-10-10 23:01:05', '2026-10-10 23:01:05', NULL),
(24, 38, 'BT-20261010-0002', '050d0068b8193b8074689088db659961', 'mujids', 1, 10, 4, 1, 1, '2026-10-10 23:13:56', 'menunggu', 'uploads/visits/photos/2026/10/photo_BT-20261010-0002_20261010231356_c8f50c81.jpg', 'uploads/visits/signatures/2026/10/signature_BT-20261010-0002_20261010231356_73f95d061be92b6f.png', NULL, NULL, NULL, '2026-10-10 23:13:56', '2026-10-10 23:13:56', NULL),
(25, 39, 'BT-20261011-0001', '86e102e90a96cf5f9f4f6536565765fd', 'jaya', 1, 10, 4, 1, 1, '2026-10-11 09:46:54', 'menunggu', 'uploads/visits/photos/2026/10/photo_BT-20261011-0001_20261011094654_128a939c.jpg', 'uploads/visits/signatures/2026/10/signature_BT-20261011-0001_20261011094654_d0a5c5f686e5e2d9.png', NULL, NULL, NULL, '2026-10-11 09:46:54', '2026-10-11 23:21:03', NULL),
(26, 40, 'BT-20261011-0002', 'b02e2f6bfdf787cb21a81e59f1f6b2c9', 'Test Instansi', 1, 10, 1, 1, 1, '2026-10-11 23:00:19', 'selesai', 'uploads/visits/photos/2026/10/photo_BT-20261011-0002_20261011230019_2218a497.jpg', 'uploads/visits/signatures/2026/10/signature_BT-20261011-0002_20261011230019_13aedaadf1c649e2.png', '2026-10-11 23:14:17', '2026-10-11 23:16:50', 153, '2026-10-11 23:00:19', '2026-10-11 23:00:19', NULL),
(27, 41, 'BT-20261011-0003', '6285633951556cd5cdd2d854d49b9125', 'Maju', 1, 10, 1, 1, 1, '2026-10-11 23:05:20', 'selesai', 'uploads/visits/photos/2026/10/photo_BT-20261011-0003_20261011230520_a7248dd0.png', 'uploads/visits/signatures/2026/10/signature_BT-20261011-0003_20261011230520_1e0b8b09b20ac98d.png', '2026-10-11 23:11:10', '2026-10-11 23:12:22', 72, '2026-10-11 23:05:20', '2026-10-11 23:05:20', NULL),
(28, 42, 'BT-20261011-0004', '192572d7adb7249a02122883fc4f3049', 'JAYA', 1, 10, 4, 1, 1, '2026-10-11 23:09:02', 'masih_berkunjung', 'uploads/visits/photos/2026/10/photo_BT-20261011-0004_20261011230902_be63265b.png', 'uploads/visits/signatures/2026/10/signature_BT-20261011-0004_20261011230902_a6b35961da5ba863.png', '2026-10-11 23:12:50', NULL, NULL, '2026-10-11 23:09:02', '2026-10-11 23:09:02', NULL),
(29, 43, 'BT-20261011-0005', '8c9a0b02192f2a5f927bae688e369664', 'jaya', 1, 10, 4, 1, 1, '2026-10-11 23:38:58', 'menunggu', 'uploads/visits/photos/2026/10/photo_BT-20261011-0005_20261011233858_a06ce87e.jpg', 'uploads/visits/signatures/2026/10/signature_BT-20261011-0005_20261011233858_ce262f09fbf0e23c.png', NULL, NULL, NULL, '2026-10-11 23:38:58', '2026-10-11 23:38:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `visit_purposes`
--

CREATE TABLE `visit_purposes` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visit_purposes`
--

INSERT INTO `visit_purposes` (`id`, `name`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Konsultasi', 1, '2026-09-21 06:35:56', '2026-09-21 06:35:56', NULL),
(2, 'Pertemuan', 1, '2026-09-21 06:35:56', '2026-09-21 06:35:56', NULL),
(3, 'Pengantaran Dokumen', 1, '2026-09-21 06:35:56', '2026-09-21 06:35:56', NULL),
(4, 'Kunjungan Kerja', 1, '2026-09-21 06:35:56', '2026-09-21 06:35:56', NULL),
(5, 'Lainnya', 1, '2026-09-21 06:35:56', '2026-09-21 06:35:56', NULL),
(6, 'Kencan', 1, '2026-09-25 05:58:14', '2026-09-30 02:14:55', NULL),
(7, 'Bertemu', 1, '2026-09-25 06:08:41', '2026-09-30 16:30:54', NULL),
(8, 'siapya', 0, '2026-09-30 02:14:03', '2026-09-30 02:14:44', '2026-09-30 02:14:44'),
(9, 'iyahh', 0, '2026-09-30 16:29:24', '2026-09-30 16:31:29', NULL),
(10, 'Test Keperluan Edited', 0, '2026-10-11 22:46:32', '2026-10-11 22:47:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `visit_status_histories`
--

CREATE TABLE `visit_status_histories` (
  `id` bigint UNSIGNED NOT NULL,
  `visit_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `status` enum('menunggu','ditolak','dibatalkan','masih_berkunjung','selesai') COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visit_status_histories`
--

INSERT INTO `visit_status_histories` (`id`, `visit_id`, `user_id`, `status`, `created_at`) VALUES
(1, 1, NULL, 'menunggu', '0000-00-00 00:00:00'),
(2, 2, NULL, 'menunggu', '0000-00-00 00:00:00'),
(3, 1, 2, 'masih_berkunjung', '0000-00-00 00:00:00'),
(4, 1, 2, 'selesai', '0000-00-00 00:00:00'),
(5, 3, NULL, 'menunggu', '0000-00-00 00:00:00'),
(6, 3, 2, 'masih_berkunjung', '0000-00-00 00:00:00'),
(7, 4, NULL, 'menunggu', '0000-00-00 00:00:00'),
(8, 5, NULL, 'menunggu', '0000-00-00 00:00:00'),
(9, 6, NULL, 'menunggu', '0000-00-00 00:00:00'),
(10, 6, 2, 'masih_berkunjung', '0000-00-00 00:00:00'),
(11, 6, 2, 'selesai', '0000-00-00 00:00:00'),
(12, 7, NULL, 'menunggu', '0000-00-00 00:00:00'),
(13, 8, NULL, 'menunggu', '0000-00-00 00:00:00'),
(14, 4, 5, 'masih_berkunjung', '0000-00-00 00:00:00'),
(15, 4, 5, 'selesai', '0000-00-00 00:00:00'),
(16, 5, 5, 'ditolak', '0000-00-00 00:00:00'),
(17, 2, 5, 'dibatalkan', '0000-00-00 00:00:00'),
(18, 7, 2, 'masih_berkunjung', '0000-00-00 00:00:00'),
(19, 7, 2, 'selesai', '0000-00-00 00:00:00'),
(20, 8, 2, 'ditolak', '0000-00-00 00:00:00'),
(21, 9, NULL, 'menunggu', '0000-00-00 00:00:00'),
(22, 9, 2, 'dibatalkan', '0000-00-00 00:00:00'),
(23, 10, NULL, 'menunggu', '0000-00-00 00:00:00'),
(24, 10, 2, 'masih_berkunjung', '0000-00-00 00:00:00'),
(25, 10, 2, 'selesai', '0000-00-00 00:00:00'),
(26, 11, NULL, 'menunggu', '0000-00-00 00:00:00'),
(27, 11, 2, 'ditolak', '0000-00-00 00:00:00'),
(28, 12, NULL, 'menunggu', '0000-00-00 00:00:00'),
(29, 13, NULL, 'menunggu', '0000-00-00 00:00:00'),
(30, 14, NULL, 'menunggu', '0000-00-00 00:00:00'),
(31, 14, 5, 'masih_berkunjung', '0000-00-00 00:00:00'),
(32, 13, 2, 'ditolak', '0000-00-00 00:00:00'),
(33, 14, 2, 'selesai', '0000-00-00 00:00:00'),
(34, 3, 3, 'selesai', '0000-00-00 00:00:00'),
(35, 15, NULL, 'menunggu', '0000-00-00 00:00:00'),
(36, 12, 2, 'masih_berkunjung', '0000-00-00 00:00:00'),
(37, 12, 2, 'selesai', '0000-00-00 00:00:00'),
(38, 15, 2, 'masih_berkunjung', '0000-00-00 00:00:00'),
(39, 15, 2, 'selesai', '0000-00-00 00:00:00'),
(40, 16, NULL, 'menunggu', '0000-00-00 00:00:00'),
(41, 16, 2, 'masih_berkunjung', '0000-00-00 00:00:00'),
(42, 16, 2, 'selesai', '0000-00-00 00:00:00'),
(43, 17, NULL, 'menunggu', '0000-00-00 00:00:00'),
(44, 17, 2, 'ditolak', '0000-00-00 00:00:00'),
(45, 18, NULL, 'menunggu', '0000-00-00 00:00:00'),
(46, 18, 5, 'masih_berkunjung', '0000-00-00 00:00:00'),
(47, 18, 1, 'selesai', '0000-00-00 00:00:00'),
(48, 19, NULL, 'menunggu', '0000-00-00 00:00:00'),
(49, 20, NULL, 'menunggu', '0000-00-00 00:00:00'),
(50, 21, NULL, 'menunggu', '0000-00-00 00:00:00'),
(51, 21, 1, 'masih_berkunjung', '0000-00-00 00:00:00'),
(52, 22, NULL, 'menunggu', '0000-00-00 00:00:00'),
(53, 23, NULL, 'menunggu', '0000-00-00 00:00:00'),
(54, 24, NULL, 'menunggu', '0000-00-00 00:00:00'),
(55, 25, NULL, 'menunggu', '0000-00-00 00:00:00'),
(56, 26, NULL, 'menunggu', '0000-00-00 00:00:00'),
(57, 27, NULL, 'menunggu', '0000-00-00 00:00:00'),
(58, 28, NULL, 'menunggu', '0000-00-00 00:00:00'),
(59, 27, 2, 'masih_berkunjung', '0000-00-00 00:00:00'),
(60, 27, 2, 'selesai', '0000-00-00 00:00:00'),
(61, 28, 2, 'masih_berkunjung', '0000-00-00 00:00:00'),
(62, 26, 2, 'masih_berkunjung', '0000-00-00 00:00:00'),
(63, 26, 2, 'selesai', '0000-00-00 00:00:00'),
(64, 29, NULL, 'menunggu', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `whatsapp_settings`
--

CREATE TABLE `whatsapp_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `is_enabled` tinyint(1) NOT NULL DEFAULT '0',
  `api_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `api_key` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `guest_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `guest_template` text COLLATE utf8mb4_general_ci,
  `employee_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `employee_template` text COLLATE utf8mb4_general_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `whatsapp_settings`
--

INSERT INTO `whatsapp_settings` (`id`, `is_enabled`, `api_url`, `api_key`, `guest_enabled`, `guest_template`, `employee_enabled`, `employee_template`, `created_at`, `updated_at`) VALUES
(1, 1, 'https://wakita.aminsproject.com/api/v1', 'wgk_10_9332dd417c61c2363ca6d63cb03fad71', 1, 'Halo {nama_tamu},\r\n\r\nKunjungan Anda telah diverifikasi oleh petugas.\r\n\r\n📋 Detail Kunjungan:\r\n• Kode: {kode_kunjungan}\r\n• Instansi: {instansi}\r\n• Departemen: {departemen}\r\n• Pegawai: {nama_pegawai}\r\n• Keperluan: {keperluan}\r\n• Rombongan: {rombongan} orang\r\n• Waktu: {waktu}\r\n\r\n🔑 Link QR Code kunjungan Anda:\r\n{link_qr}\r\n\r\nSimpan pesan ini untuk checkout.\r\n\r\nTerima kasih ya.', 1, 'Halo {nama_pegawai},\r\n\r\nAda tamu yang ingin menemui Anda:\r\n\r\n• Nama: {nama_tamu}\r\n• Instansi: {instansi}\r\n• Keperluan: {keperluan}\r\n• Rombongan: {rombongan} orang\r\n\r\nApakah Anda memiliki waktu untuk menemui tamu tersebut? Mohon konfirmasi ke resepsionis.\r\n\r\nTerima kasih.', '2026-09-21 06:35:56', '2026-10-11 22:52:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `visit_id` (`visit_id`),
  ADD KEY `visit_status_history_id` (`visit_status_history_id`),
  ADD KEY `activity` (`activity`),
  ADD KEY `module` (`module`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `is_active` (`is_active`),
  ADD KEY `deleted_at` (`deleted_at`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `is_active` (`is_active`),
  ADD KEY `deleted_at` (`deleted_at`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `phone` (`phone`),
  ADD KEY `identity_number` (`identity_number`),
  ADD KEY `deleted_at` (`deleted_at`);

--
-- Indexes for table `institution_profiles`
--
ALTER TABLE `institution_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visit_id` (`visit_id`),
  ADD KEY `recipient_type` (`recipient_type`),
  ADD KEY `recipient_phone` (`recipient_phone`),
  ADD KEY `notification_type` (`notification_type`),
  ADD KEY `status` (`status`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role` (`role`),
  ADD KEY `is_active` (`is_active`),
  ADD KEY `deleted_at` (`deleted_at`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `visit_code` (`visit_code`),
  ADD UNIQUE KEY `qr_token` (`qr_token`),
  ADD KEY `guest_id` (`guest_id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `visit_purpose_id` (`visit_purpose_id`),
  ADD KEY `arrival_at` (`arrival_at`),
  ADD KEY `status` (`status`),
  ADD KEY `deleted_at` (`deleted_at`);

--
-- Indexes for table `visit_purposes`
--
ALTER TABLE `visit_purposes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `is_active` (`is_active`),
  ADD KEY `deleted_at` (`deleted_at`);

--
-- Indexes for table `visit_status_histories`
--
ALTER TABLE `visit_status_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visit_id` (`visit_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `status` (`status`),
  ADD KEY `created_at` (`created_at`);

--
-- Indexes for table `whatsapp_settings`
--
ALTER TABLE `whatsapp_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=596;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `institution_profiles`
--
ALTER TABLE `institution_profiles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `visit_purposes`
--
ALTER TABLE `visit_purposes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `visit_status_histories`
--
ALTER TABLE `visit_status_histories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `whatsapp_settings`
--
ALTER TABLE `whatsapp_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `activity_logs_visit_id_foreign` FOREIGN KEY (`visit_id`) REFERENCES `visits` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `activity_logs_visit_status_history_id_foreign` FOREIGN KEY (`visit_status_history_id`) REFERENCES `visit_status_histories` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_visit_id_foreign` FOREIGN KEY (`visit_id`) REFERENCES `visits` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `visits`
--
ALTER TABLE `visits`
  ADD CONSTRAINT `visits_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `visits_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `visits_guest_id_foreign` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `visits_visit_purpose_id_foreign` FOREIGN KEY (`visit_purpose_id`) REFERENCES `visit_purposes` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `visit_status_histories`
--
ALTER TABLE `visit_status_histories`
  ADD CONSTRAINT `visit_status_histories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `visit_status_histories_visit_id_foreign` FOREIGN KEY (`visit_id`) REFERENCES `visits` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
