CREATE TABLE `buildings` (
  `id` integer PRIMARY KEY,
  `name` varchar(255) COMMENT 'Название корпуса',
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `rooms` (
  `id` integer PRIMARY KEY,
  `building_id` integer COMMENT 'Связь с таблицей buildings',
  `room_number` integer COMMENT 'Номер комнаты',
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `clients` (
  `id` integer PRIMARY KEY,
  `name` varchar(255) COMMENT 'Имя клиента',
  `contact` varchar(255) COMMENT 'Контактные данные',
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `bookings` (
  `id` integer PRIMARY KEY,
  `room_id` integer COMMENT 'Связь с таблицей rooms',
  `client_id` integer COMMENT 'Связь с таблицей clients',
  `check_in_date` date COMMENT 'Дата заезда',
  `check_out_date` date COMMENT 'Дата выезда',
  `total_amount` decimal COMMENT 'Сумма к оплате',
  `status` enum(confirmed,cancelled) COMMENT 'Статус бронирования',
  `created_at` timestamp,
  `updated_at` timestamp
);

ALTER TABLE `rooms` ADD FOREIGN KEY (`building_id`) REFERENCES `buildings` (`id`);

ALTER TABLE `bookings` ADD FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

ALTER TABLE `bookings` ADD FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);
