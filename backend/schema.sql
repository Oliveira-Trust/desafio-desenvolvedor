CREATE TABLE `clients` (
  `id` int(11) NOT NULL, 
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, 
  `document` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, 
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, 
  `birthday` date NOT NULL, 
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
);

CREATE TABLE `items` (
  `id` int(11) NOT NULL, 
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL, 
  `cost_price` float NOT NULL, 
  `retail_price` float NOT NULL
);

CREATE TABLE `oauth_access_tokens` (
  `access_token` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL, 
  `client_id` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL, 
  `user_id` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL, 
  `expires` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(), 
  `scope` varchar(4000) COLLATE utf8mb4_unicode_ci DEFAULT NULL
);

CREATE TABLE `oauth_authorization_codes` (
  `authorization_code` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL, 
  `client_id` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL, 
  `user_id` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL, 
  `redirect_uri` varchar(2000) COLLATE utf8mb4_unicode_ci DEFAULT NULL, 
  `expires` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(), 
  `scope` varchar(4000) COLLATE utf8mb4_unicode_ci DEFAULT NULL, 
  `id_token` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL
);

CREATE TABLE `oauth_clients` (
  `client_id` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL, 
  `client_secret` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL, 
  `redirect_uri` varchar(2000) COLLATE utf8mb4_unicode_ci DEFAULT NULL, 
  `grant_types` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL, 
  `scope` varchar(4000) COLLATE utf8mb4_unicode_ci DEFAULT NULL, 
  `user_id` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL
);

CREATE TABLE `oauth_jwt` (
  `client_id` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL, 
  `subject` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL, 
  `public_key` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL
);

CREATE TABLE `oauth_refresh_tokens` (
  `refresh_token` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL, 
  `client_id` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL, 
  `user_id` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL, 
  `expires` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(), 
  `scope` varchar(4000) COLLATE utf8mb4_unicode_ci DEFAULT NULL
);

CREATE TABLE `oauth_scopes` (
  `scope` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL, 
  `is_default` tinyint(1) DEFAULT NULL
);

CREATE TABLE `oauth_users` (
  `username` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL, 
  `password` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL, 
  `first_name` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL, 
  `last_name` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL, 
  `email` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL, 
  `email_verified` tinyint(1) DEFAULT NULL, 
  `scope` varchar(4000) COLLATE utf8mb4_unicode_ci DEFAULT NULL
);

CREATE TABLE `orders` (
  `id` int(11) NOT NULL, 
  `client_id` int(11) NOT NULL, 
  `items` longtext COLLATE utf8mb4_unicode_ci NOT NULL, 
  `status` enum('pending', 'paid', 'canceled') COLLATE utf8mb4_unicode_ci NOT NULL
);

ALTER TABLE `clients`                   ADD PRIMARY KEY (`id`);
ALTER TABLE `items`                     ADD PRIMARY KEY (`id`);
ALTER TABLE `oauth_access_tokens`       ADD PRIMARY KEY (`access_token`);
ALTER TABLE `oauth_authorization_codes` ADD PRIMARY KEY (`authorization_code`);
ALTER TABLE `oauth_clients`             ADD PRIMARY KEY (`client_id`);
ALTER TABLE `oauth_refresh_tokens`      ADD PRIMARY KEY (`refresh_token`);
ALTER TABLE `oauth_scopes`              ADD PRIMARY KEY (`scope`);
ALTER TABLE `oauth_users`               ADD PRIMARY KEY (`username`);
ALTER TABLE `orders`                    ADD PRIMARY KEY (`id`);

ALTER TABLE `clients` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `items` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `orders` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;