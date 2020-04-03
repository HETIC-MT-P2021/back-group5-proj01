CREATE TABLE `images` (
  `image_id` integer PRIMARY KEY,
  `file_name` varchar(255),
  `file_url` varchar(255),
  `description` varchar(255),
  `category_id` integer,
  `created_at` timestamp
);

CREATE TABLE `category` (
  `category_id` integer PRIMARY KEY,
  `category_name` varchar(255)
);

CREATE TABLE `assoc_tags_images` (
  `image_id` integer,
  `tag_name` varchar(255)
);

CREATE TABLE `tags` (
  `tag_name` varchar(255) PRIMARY KEY
);
