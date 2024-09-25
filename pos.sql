-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 25, 2024 at 06:52 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_09_11_065815_create_m_level_table', 1),
(6, '2024_09_11_070153_create_m_kategori', 2),
(7, '2024_09_11_070206_create_m_supplier', 2),
(8, '2024_09_11_071330_create_cache_table', 3),
(9, '2024_09_11_071637_create_m_level_table', 3),
(10, '2024_09_11_071855_create_m_user_table', 4),
(11, '2024_09_11_072059_create_m_user_table', 5),
(12, '2024_09_11_072809_create_m_level_table', 6),
(13, '2024_09_11_073117_create_m_user_table', 7),
(14, '2024_09_11_074315_create_m_kategori', 8),
(15, '2024_09_11_074350_create_m_supplier', 9),
(16, '2024_09_11_073744_create_m_barang_table', 10),
(17, '2024_09_11_073754_create_m_penjualan_table', 11),
(18, '2024_09_11_073807_create_m_stok_table', 12),
(19, '2024_09_11_073824_create_m_penjualan_detail_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `m_barang`
--

CREATE TABLE `m_barang` (
  `barang_id` bigint UNSIGNED NOT NULL,
  `kategori_id` bigint UNSIGNED NOT NULL,
  `barang_kode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barang_nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_beli` int NOT NULL,
  `harga_jual` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_barang`
--

INSERT INTO `m_barang` (`barang_id`, `kategori_id`, `barang_kode`, `barang_nama`, `harga_beli`, `harga_jual`, `created_at`, `updated_at`) VALUES
(1, 1, 'BR001', 'Mesin V8', 5000000, 5500000, NULL, NULL),
(2, 2, 'BR002', 'Knalpot Racing', 1000000, 1200000, NULL, NULL),
(3, 3, 'BR003', 'Aki Kering', 800000, 850000, NULL, NULL),
(4, 4, 'BR004', 'Velg Racing 18 Inch', 3000000, 3500000, NULL, NULL),
(5, 5, 'BR005', 'Shockbreaker Racing', 2500000, 2700000, NULL, NULL),
(6, 1, 'BR006', 'Mesin Inline-4', 4000000, 4500000, NULL, NULL),
(7, 2, 'BR007', 'Jok Kulit Premium', 1500000, 1750000, NULL, NULL),
(8, 3, 'BR008', 'Alternator 12V', 950000, 1100000, NULL, NULL),
(9, 4, 'BR009', 'Ban Tubeless 17 Inch', 1200000, 1400000, NULL, NULL),
(10, 5, 'BR010', 'Stabilizer Bar', 2000000, 2200000, NULL, NULL),
(11, 1, 'BR011', 'Mesin Boxer', 6000000, 6500000, NULL, NULL),
(12, 2, 'BR012', 'Lampu LED Headlight', 750000, 900000, NULL, NULL),
(13, 3, 'BR013', 'Kabel Busi Racing', 450000, 500000, NULL, NULL),
(14, 4, 'BR014', 'Velg Chrome 20 Inch', 4000000, 4500000, NULL, NULL),
(15, 5, 'BR015', 'Coilover Suspension', 3000000, 3200000, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_kategori`
--

CREATE TABLE `m_kategori` (
  `kategori_id` bigint UNSIGNED NOT NULL,
  `kategori_kode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_kategori`
--

INSERT INTO `m_kategori` (`kategori_id`, `kategori_kode`, `kategori_nama`, `created_at`, `updated_at`) VALUES
(1, 'KT101', 'Peralatan Bengkel', NULL, NULL),
(2, 'KT102', 'Perlengkapan Mobil', NULL, NULL),
(3, 'KT103', 'Suku Cadang Motor', NULL, NULL),
(4, 'KT104', 'Elektronik Kendaraan', NULL, NULL),
(5, 'KT105', 'Peralatan Keselamatan', NULL, NULL),
(6, 'KT106', 'Pelumas dan Cairan', NULL, NULL),
(7, 'KT107', 'Body Kit dan Modifikasi', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_level`
--

CREATE TABLE `m_level` (
  `level_id` bigint UNSIGNED NOT NULL,
  `level_kode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level_nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_level`
--

INSERT INTO `m_level` (`level_id`, `level_kode`, `level_nama`, `created_at`, `updated_at`) VALUES
(1, 'ADM', 'Administrator', NULL, NULL),
(2, 'MNG', 'Manager', NULL, NULL),
(3, 'STF', 'Staff/Kasir', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_supplier`
--

CREATE TABLE `m_supplier` (
  `supplier_id` bigint UNSIGNED NOT NULL,
  `supplier_kode` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_supplier`
--

INSERT INTO `m_supplier` (`supplier_id`, `supplier_kode`, `supplier_nama`, `supplier_alamat`, `created_at`, `updated_at`) VALUES
(1, 'SP101', 'PT Mekanik Utama', 'Medan, Indonesia', NULL, NULL),
(2, 'SP102', 'CV Jaya Mandiri', 'Yogyakarta, Indonesia', NULL, NULL),
(3, 'SP103', 'PT Auto Parts Nusantara', 'Semarang, Indonesia', NULL, NULL),
(4, 'SP104', 'CV Prima Motorindo', 'Denpasar, Indonesia', NULL, NULL),
(5, 'SP105', 'PT Sumber Berkah', 'Makassar, Indonesia', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--

CREATE TABLE `m_user` (
  `user_id` bigint UNSIGNED NOT NULL,
  `level_id` bigint UNSIGNED NOT NULL,
  `username` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`user_id`, `level_id`, `username`, `nama`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'Administrator', '$2y$12$pt/M/RYFWHl81hUFZyCPp.0CmjJi6lT42XkB/hhj7y0Mc3uIEh0Te', NULL, NULL),
(2, 2, 'manager', 'Manager', '$2y$12$6JIxI8kD3FBUiJf1d2QrE.HXm1Q.mzTYSZ9.fznS.W87CqfZRdIpu', NULL, NULL),
(3, 3, 'staff', 'Staff/Kasir', '$2y$12$y.hhWOo59uvPDkNFtBqQeOVGLchQjb6RswwDmkiuwdyT6dAd4Rtge', NULL, NULL),
(4, 2, 'manager_dua', 'manager 2', '$2y$12$8wABGrbGxLkvYFas.DyybOdy6ez1IqTr4Ne54NmTgfGaS6sm7KeFW', NULL, NULL),
(5, 2, 'manager_tiga', 'manager 3', '$2y$12$FQvxBdRNcGihzXNSaJtV7.2wmjsgLubpE1fUjbCryxdnOGfD9cs3S', NULL, NULL),
(6, 2, 'manager_tigas', 'manager 3s', '$2y$12$QDqYzFbckjthHTu09s9iY.T1ElctfYEwoRhkMm.5N/1uTE9eF3Lwa', NULL, NULL),
(9, 2, 'manager22', 'Manager Dua Dua', '$2y$12$q1ORjcKMN514nGc0yOYAqOHV73zWpw3paTVBZI4LWMiM00Tsdw2Hi', '2024-09-24 04:15:35', '2024-09-24 04:15:35'),
(10, 2, 'manager33', 'Manager tiga tiga', '$2y$12$vo4yhFa4LRXuCls0siuv.OHXck.5WizY1UMQ61wVQ.X1980Ie2xcK', '2024-09-24 04:17:24', '2024-09-24 04:17:24'),
(15, 2, 'manager120', 'Manager11', '$2y$12$YvaBLp5GzvSAFgmfTcvhWeddYiDmON4r.DcXRvI/HYLb/kKCnjofu', '2024-09-24 04:25:01', '2024-09-24 04:25:01'),
(17, 2, 'manager13', 'Manager12', '$2y$12$DHMPqDuMn/tuSzbCxoBrLunpqPq/dRxwpALKp9LF8X4rBR5aKbTBi', '2024-09-24 04:25:45', '2024-09-24 04:25:45');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_penjualan`
--

CREATE TABLE `t_penjualan` (
  `penjualan_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `pembeli` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penjualan_kode` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penjualan_tanggal` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_penjualan`
--

INSERT INTO `t_penjualan` (`penjualan_id`, `user_id`, `pembeli`, `penjualan_kode`, `penjualan_tanggal`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bengkel A', 'BR001', '2024-09-01 00:00:00', NULL, NULL),
(2, 1, 'Bengkel B', 'BR009', '2024-09-02 00:00:00', NULL, NULL),
(3, 1, 'Bengkel C', 'BR007', '2024-09-03 00:00:00', NULL, NULL),
(4, 2, 'Bengkel D', 'BR007', '2024-09-04 00:00:00', NULL, NULL),
(5, 2, 'Bengkel E', 'BR006', '2024-09-05 00:00:00', NULL, NULL),
(6, 2, 'Bengkel F', 'BR005', '2024-09-06 00:00:00', NULL, NULL),
(7, 2, 'Bengkel G', 'BR004', '2024-09-07 00:00:00', NULL, NULL),
(8, 3, 'Bengkel H', 'BR003', '2024-09-08 00:00:00', NULL, NULL),
(9, 3, 'Bengkel I', 'BR002', '2024-09-09 00:00:00', NULL, NULL),
(10, 3, 'Bengkel J', 'BR002', '2024-09-10 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_penjualan_detail`
--

CREATE TABLE `t_penjualan_detail` (
  `detail_id` bigint UNSIGNED NOT NULL,
  `penjualan_id` bigint UNSIGNED NOT NULL,
  `barang_id` bigint UNSIGNED NOT NULL,
  `harga` int NOT NULL,
  `jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_penjualan_detail`
--

INSERT INTO `t_penjualan_detail` (`detail_id`, `penjualan_id`, `barang_id`, `harga`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 510000, 1, NULL, NULL),
(2, 1, 2, 105000, 2, NULL, NULL),
(3, 1, 3, 210000, 1, NULL, NULL),
(4, 2, 4, 315000, 1, NULL, NULL),
(5, 2, 5, 157500, 1, NULL, NULL),
(6, 2, 6, 262500, 1, NULL, NULL),
(7, 3, 7, 630000, 1, NULL, NULL),
(8, 3, 8, 735000, 2, NULL, NULL),
(9, 3, 9, 840000, 1, NULL, NULL),
(10, 4, 10, 945000, 1, NULL, NULL),
(11, 4, 11, 1050000, 1, NULL, NULL),
(12, 4, 12, 1155000, 1, NULL, NULL),
(13, 5, 13, 1260000, 1, NULL, NULL),
(14, 5, 14, 1365000, 2, NULL, NULL),
(15, 5, 15, 1470000, 1, NULL, NULL),
(16, 6, 1, 510000, 1, NULL, NULL),
(17, 6, 2, 105000, 2, NULL, NULL),
(18, 6, 3, 210000, 1, NULL, NULL),
(19, 7, 4, 315000, 1, NULL, NULL),
(20, 7, 5, 157500, 1, NULL, NULL),
(21, 7, 6, 262500, 2, NULL, NULL),
(22, 8, 7, 630000, 1, NULL, NULL),
(23, 8, 8, 735000, 2, NULL, NULL),
(24, 8, 9, 840000, 1, NULL, NULL),
(25, 9, 10, 945000, 1, NULL, NULL),
(26, 9, 11, 1050000, 1, NULL, NULL),
(27, 9, 12, 1155000, 1, NULL, NULL),
(28, 10, 13, 1260000, 1, NULL, NULL),
(29, 10, 14, 1365000, 2, NULL, NULL),
(30, 10, 15, 1470000, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_stok`
--

CREATE TABLE `t_stok` (
  `stok_id` bigint UNSIGNED NOT NULL,
  `barang_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `supplier_id` bigint UNSIGNED NOT NULL,
  `stok_tanggal` datetime NOT NULL,
  `stok_jumlah` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `t_stok`
--

INSERT INTO `t_stok` (`stok_id`, `barang_id`, `user_id`, `supplier_id`, `stok_tanggal`, `stok_jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2024-09-02 09:00:00', 55, NULL, NULL),
(2, 2, 2, 2, '2024-09-02 09:15:00', 45, NULL, NULL),
(3, 3, 3, 3, '2024-09-02 09:30:00', 65, NULL, NULL),
(4, 4, 1, 1, '2024-09-02 10:00:00', 70, NULL, NULL),
(5, 5, 2, 2, '2024-09-02 10:15:00', 30, NULL, NULL),
(6, 6, 3, 3, '2024-09-02 10:30:00', 25, NULL, NULL),
(7, 7, 1, 1, '2024-09-02 11:00:00', 40, NULL, NULL),
(8, 8, 2, 2, '2024-09-02 11:30:00', 35, NULL, NULL),
(9, 9, 3, 3, '2024-09-02 12:00:00', 50, NULL, NULL),
(10, 10, 1, 1, '2024-09-02 12:30:00', 60, NULL, NULL),
(11, 11, 2, 2, '2024-09-02 13:00:00', 65, NULL, NULL),
(12, 12, 3, 3, '2024-09-02 13:30:00', 70, NULL, NULL),
(13, 13, 1, 1, '2024-09-02 14:00:00', 85, NULL, NULL),
(14, 14, 2, 2, '2024-09-02 14:30:00', 45, NULL, NULL),
(15, 15, 3, 3, '2024-09-02 15:00:00', 55, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_barang`
--
ALTER TABLE `m_barang`
  ADD PRIMARY KEY (`barang_id`),
  ADD KEY `m_barang_kategori_id_foreign` (`kategori_id`);

--
-- Indexes for table `m_kategori`
--
ALTER TABLE `m_kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `m_level`
--
ALTER TABLE `m_level`
  ADD PRIMARY KEY (`level_id`),
  ADD UNIQUE KEY `m_level_level_kode_unique` (`level_kode`);

--
-- Indexes for table `m_supplier`
--
ALTER TABLE `m_supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `m_user`
--
ALTER TABLE `m_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `m_user_username_unique` (`username`),
  ADD KEY `m_user_level_id_index` (`level_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  ADD PRIMARY KEY (`penjualan_id`),
  ADD KEY `t_penjualan_user_id_foreign` (`user_id`);

--
-- Indexes for table `t_penjualan_detail`
--
ALTER TABLE `t_penjualan_detail`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `t_penjualan_detail_barang_id_foreign` (`barang_id`),
  ADD KEY `t_penjualan_detail_penjualan_id_foreign` (`penjualan_id`);

--
-- Indexes for table `t_stok`
--
ALTER TABLE `t_stok`
  ADD PRIMARY KEY (`stok_id`),
  ADD KEY `t_stok_user_id_foreign` (`user_id`),
  ADD KEY `t_stok_barang_id_foreign` (`barang_id`),
  ADD KEY `t_stok_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `m_barang`
--
ALTER TABLE `m_barang`
  MODIFY `barang_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `m_kategori`
--
ALTER TABLE `m_kategori`
  MODIFY `kategori_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `m_level`
--
ALTER TABLE `m_level`
  MODIFY `level_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `m_supplier`
--
ALTER TABLE `m_supplier`
  MODIFY `supplier_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `m_user`
--
ALTER TABLE `m_user`
  MODIFY `user_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  MODIFY `penjualan_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_penjualan_detail`
--
ALTER TABLE `t_penjualan_detail`
  MODIFY `detail_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `t_stok`
--
ALTER TABLE `t_stok`
  MODIFY `stok_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `m_barang`
--
ALTER TABLE `m_barang`
  ADD CONSTRAINT `m_barang_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `m_kategori` (`kategori_id`);

--
-- Constraints for table `m_user`
--
ALTER TABLE `m_user`
  ADD CONSTRAINT `m_user_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `m_level` (`level_id`);

--
-- Constraints for table `t_penjualan`
--
ALTER TABLE `t_penjualan`
  ADD CONSTRAINT `t_penjualan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `m_user` (`user_id`);

--
-- Constraints for table `t_penjualan_detail`
--
ALTER TABLE `t_penjualan_detail`
  ADD CONSTRAINT `t_penjualan_detail_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `m_barang` (`barang_id`),
  ADD CONSTRAINT `t_penjualan_detail_penjualan_id_foreign` FOREIGN KEY (`penjualan_id`) REFERENCES `t_penjualan` (`penjualan_id`);

--
-- Constraints for table `t_stok`
--
ALTER TABLE `t_stok`
  ADD CONSTRAINT `t_stok_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `m_barang` (`barang_id`),
  ADD CONSTRAINT `t_stok_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `m_supplier` (`supplier_id`),
  ADD CONSTRAINT `t_stok_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `m_user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
