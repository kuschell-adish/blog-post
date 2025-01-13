-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 13, 2025 at 06:12 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_post`
--

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `first_name`, `last_name`, `username`, `email`, `email_verified_at`, `password`, `birthday`, `gender`, `address`, `photo`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Juan', 'Rodriguez', 'juan123', 'juan@email.com', NULL, '$2y$12$XoWRuJgO2s8vtlUvMgXYvuIhjoa1A0zUHRUuKHncGpz/wcSq55gqK', '2004-06-22', 'Male', 'Tagaytay, Cavite', 'photo/53nyRbH0W4VxN8d0BJyCOOjGxrKKNuSY0sTUGIZ5.png', NULL, '2024-05-26 18:39:06', '2024-05-30 01:02:26'),
(2, 'Juana', 'Landicho', 'juana123', 'juana@email.com', NULL, '$2y$12$RanuwVAA5KjhQWiVz3SKRu3LTT2s40BPCPrO3P57dDSoNRXMD3DiS', '2005-12-08', 'Female', 'Dasma, Cavite', 'photo/BddwKeamofDTaozLL6W8Ciq4cIWuHM6LJZvAqqce.png', NULL, '2024-05-26 18:41:21', '2024-05-30 22:58:58'),
(3, 'Kuschell Jane', 'Amulong', 'kuschelljane', 'schellaneam@gmail.com', NULL, '$2y$12$zD8pQBIVLXpW9zNT2QxQBOnzJpjs6PYm6D37Kc0c2RwDZd2DG.cF.', '2001-01-09', 'Female', 'Tagaytay, Cavite', 'photo/mTZpaQboTjODdg0QeVmXoXH9NLv1VxZ9JcvJaebJ.jpg', NULL, '2024-05-26 19:22:38', '2024-05-29 22:29:51'),
(4, 'Ruby', 'Rodriguez', 'ruby', 'ruby11@email.com', NULL, '$2y$12$y6mQreZ4wAajJnVCp.hSme7LyoXFZGwC9wKSU0lrXth1hEC15k7Ia', '2014-02-11', 'Male', 'Silang, Cavite', 'photo/jOnCCaLYDYyPgJ9olZVP9WmR84AnFQNkQmRnUaiw.jpg', NULL, '2024-05-28 00:27:07', '2024-05-28 00:27:07'),
(5, 'Mary', 'Lanzks', 'marylanzks', 'mary@email.com', NULL, '$2y$12$Op7LxpQUgDh4Z.Fk1rz5r.UoRyzBJwNVt603PlfjxQ8GbR8kZ.qkO', '2004-02-14', 'Female', 'BGC, Taguig', 'photo/default.jpg', NULL, '2024-05-28 18:12:44', '2024-05-28 18:12:44');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` int NOT NULL,
  `cover_photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `created_at`, `updated_at`, `title`, `body`, `author_id`, `cover_photo`) VALUES
(1, '2024-05-23 19:04:15', '2024-05-28 23:42:16', 'The Art of Time Management', 'Time management is a skill that can significantly impact productivity, efficiency, and overall well-being. Effective time management involves setting clear goals, prioritizing tasks, and allocating time wisely. By identifying priorities and focusing on high-impact activities, individuals can maximize their productivity and achieve better results in less time. Eliminating distractions and creating a conducive work environment are essential for staying focused and on track. Techniques such as the Pomodoro Technique and time blocking can help individuals structure their time and maintain focus throughout the day. Additionally, learning to delegate tasks and say no to non-essential commitments can free up valuable time for important activities. Time management is not just about working harder but also working smarter, making the most of the time available while maintaining a healthy work-life balance.', 1, 'photo/UBT2kfHl1J07j1Eynl7x1PDhWGhLeGwmRBx12XJU.png'),
(2, '2024-05-23 19:09:56', '2024-05-30 22:59:42', 'Looking Into Mindfulness Meditation', 'Mindfulness meditation is a practice that involves bringing attention to the present moment with openness, curiosity, and acceptance. Rooted in ancient Eastern traditions, mindfulness meditation has gained popularity in recent years due to its numerous benefits for mental and emotional well-being. Research shows that regular meditation practice can reduce stress, anxiety, and symptoms of depression. By cultivating mindfulness, individuals can develop greater self-awareness and emotional regulation, leading to improved relationships and overall life satisfaction. Mindfulness meditation involves focusing on the breath, sensations in the body, or thoughts and emotions without judgment. Through regular practice, individuals can train their minds to be more present and attentive, reducing rumination and worry about the past or future. Mindfulness meditation is not about achieving a state of bliss but rather about being fully present and engaged in each moment, no matter how mundane or challenging.', 2, 'photo/d0rZETE4ZDDZLaCg9h7l8TwQvC1HfL7AFQlBFcCh.jpg'),
(3, '2024-05-23 19:10:13', '2024-05-28 23:41:49', 'Unlocking Creativity: Tips for Inspiration', 'Creativity is a fundamental aspect of human expression and innovation, yet many individuals struggle to tap into their creative potential. Fortunately, creativity is not an innate trait but a skill that can be cultivated and nurtured. One of the keys to unlocking creativity is to expose oneself to diverse experiences, ideas, and perspectives. By stepping outside of one\'s comfort zone and exploring new interests and hobbies, individuals can spark inspiration and fuel their creativity. Surrounding oneself with creative stimuli, such as art, music, literature, and nature, can also stimulate the imagination and generate new ideas. Embracing failure as an essential part of the creative process can help individuals overcome perfectionism and fear of judgment, allowing them to take risks and explore unconventional solutions. Additionally, establishing a regular creative practice, whether through writing, painting, or brainstorming, can help individuals harness their creative energy and maintain momentum. Ultimately, creativity thrives in an environment of openness, curiosity, and experimentation, where individuals are free to explore and express themselves authentically.', 2, 'photo/tX5ORWhDKwxpcpudRvH8nZkuLPGkXjJzhWlbxNlf.jpg'),
(5, '2024-05-26 23:11:23', '2024-05-28 23:21:23', 'The Power of Positive Thinking', 'Positive thinking is more than just a fleeting thought; it\'s a mindset that can transform your life. Research shows that cultivating a positive outlook can lead to numerous physical and mental health benefits. By focusing on the bright side of situations, individuals can reduce stress, lower rates of depression, and even boost their immune system. Positive thinking also fosters resilience, helping individuals bounce back from setbacks and face challenges with optimism. Incorporating gratitude practices into daily life further reinforces positivity by shifting attention to the abundance rather than scarcity. Embracing positive affirmations and visualizations can rewire the brain, creating a more optimistic and resilient mindset. Through mindfulness practices, individuals can become more aware of their thoughts and emotions, allowing them to choose more positive responses to life\'s challenges. Ultimately, the power of positive thinking lies in its ability to shape our perceptions, attitudes, and experiences, leading to a happier and more fulfilling life.', 3, 'photo/wXkhczwtLGtoxHKZPSP4QmQcn3Zu9HwZxhXZEDyi.jpg'),
(10, '2024-05-29 00:15:01', '2024-05-29 00:17:21', 'The Majesty of Mountains', 'Mountains rise, their peaks touching the sky, beckoning adventurers with their beauty. Trails wind through forests and rugged terrain, offering spectacular views at every turn. Despite their allure, mountains demand respect, their weather and terrain challenging even the most seasoned explorers.\r\n\r\nYet, it is this challenge that draws us to them, offering moments of both humility and triumph. Throughout history, mountains have symbolized strength and resilience, standing as timeless monuments to the power of nature. And in their presence, we find inspiration and a profound connection to the world around us.', 3, 'photo/ZwdJvymdRwV3DglECenKVqwoBMiY4I5Rka642gRv.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` int NOT NULL,
  `blog_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `author_id`, `blog_id`, `created_at`, `updated_at`) VALUES
(1, 'My first blog! Thank you guys for the support!', 1, 1, '2024-05-27 18:08:45', '2024-05-27 22:43:08'),
(2, 'Nicely said!', 3, 1, '2024-05-27 18:41:27', '2024-05-27 22:38:28'),
(20, 'Comment down your opinions on this :)', 3, 5, '2024-05-27 19:05:06', '2024-05-27 22:43:44'),
(22, 'test comment', 3, 6, '2024-05-27 23:41:02', '2024-05-28 18:36:11'),
(23, 'update comment', 3, 7, '2024-05-28 19:24:15', '2024-05-28 19:24:35'),
(24, 'Share your opinions about this blog :)', 3, 10, '2024-05-29 00:18:03', '2024-05-29 00:18:03'),
(28, 'Wow, nature!', 1, 10, '2024-05-29 00:24:28', '2024-05-29 00:24:28'),
(29, 'sa trueeeee', 2, 10, '2024-05-29 00:24:54', '2024-05-29 00:24:54'),
(31, 'Great work!', 1, 3, '2024-05-29 00:26:49', '2024-05-29 00:26:49'),
(32, 'This inspired me to unlock my creativity :D', 1, 3, '2024-05-29 00:27:06', '2024-05-29 00:27:06'),
(33, 'comment edit', 3, 12, '2024-05-29 18:58:21', '2024-05-29 18:58:32');

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
(6, '2024_05_24_023419_create_blogs_table', 2),
(9, '2024_05_24_075624_create_comments_table', 3),
(10, '2024_05_27_021437_create_authors_table', 4),
(11, '2024_05_28_062901_change_body_column_type', 5),
(12, '2024_05_29_062024_add_cover_to_blogs_table', 6);

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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'juana dela cruz', 'juana@email.com', NULL, '$2y$12$0EBkMd7IeRpmKv04O0WS.u8UEP19HGb6S6DPB3f9WSjOpGr6gehSO', NULL, '2024-05-23 17:05:29', '2024-05-23 17:05:29'),
(2, 'juan rodriguez', 'juan@email.com', NULL, '$2y$12$CX0eWo70TPHok9psLam75ONj712r.sIF8Lt4.A.FaD3dGVy1BcEHa', NULL, '2024-05-23 17:06:22', '2024-05-23 17:06:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `authors_email_unique` (`email`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
