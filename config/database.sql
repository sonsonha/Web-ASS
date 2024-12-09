CREATE TABLE tai_khoan (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  full_name VARCHAR(100),
  date_of_birth DATE,
  registration_date DATE DEFAULT CURRENT_DATE,
  phone_number VARCHAR(15) NOT NULL,
  email VARCHAR(100),
  role VARCHAR(10) CHECK (role IN ('User', 'Admin'))
);

CREATE TABLE user (
  id INT AUTO_INCREMENT PRIMARY KEY,
  reputation_points INT DEFAULT 0,
  status BOOLEAN DEFAULT TRUE,
  account_id INT NOT NULL,
  FOREIGN KEY (account_id) REFERENCES tai_khoan(id) ON DELETE CASCADE
);

CREATE TABLE admin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  account_id INT NOT NULL,
  FOREIGN KEY (account_id) REFERENCES tai_khoan(id) ON DELETE CASCADE
);
CREATE TABLE game (
  id INT AUTO_INCREMENT PRIMARY KEY,
  game_name VARCHAR(100) NOT NULL,            -- Tên game
  publisher VARCHAR(100),                    -- Nhà phát hành
  genre VARCHAR(50),                         -- Thể loại
  price DECIMAL(10, 2),                      -- Giá tiền
  discount DECIMAL(5, 2) DEFAULT 0,          -- Giảm giá
  downloads INT DEFAULT 0,                   -- Số lượt tải
  release_date DATE,                         -- Ngày ra mắt
  description TEXT,                          -- Mô tả
  introduction TEXT,                         -- Giới thiệu
  rating DECIMAL(3, 2),                      -- Điểm đánh giá
  image_url VARCHAR(255),                    -- URL hình ảnh
  recOS VARCHAR(50),                         -- Hệ điều hành khuyến nghị
  recProcessor VARCHAR(100),                -- CPU khuyến nghị
  recMemory VARCHAR(50),                    -- RAM khuyến nghị
  recGraphics VARCHAR(100),                 -- GPU khuyến nghị
  recDirectX VARCHAR(50),                   -- DirectX khuyến nghị
  recStorage VARCHAR(50),                   -- Lưu trữ khuyến nghị
  minOS VARCHAR(50),                        -- Hệ điều hành tối thiểu
  minProcessor VARCHAR(100),                -- CPU tối thiểu
  minMemory VARCHAR(50),                    -- RAM tối thiểu
  minGraphics VARCHAR(100),                 -- GPU tối thiểu
  minDirectX VARCHAR(50),                   -- DirectX tối thiểu
  minStorage VARCHAR(50)                    -- Lưu trữ tối thiểu
);

CREATE TABLE don_hang (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  order_date DATE DEFAULT CURRENT_DATE,
  total_amount DECIMAL(10, 2) NOT NULL,
  status VARCHAR(20) DEFAULT 'Pending',       -- Trạng thái đơn hàng (Pending, Paid, Canceled)
  payment_status VARCHAR(20) DEFAULT 'Unpaid', -- Trạng thái thanh toán (Unpaid, Paid, Failed)
  payment_method VARCHAR(50),                 -- Phương thức thanh toán (Credit Card, PayPal, ...)
  payment_date DATE,                           -- Ngày thanh toán
  FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
);

CREATE TABLE chi_tiet_don_hang (
  id INT AUTO_INCREMENT PRIMARY KEY,
  order_id INT NOT NULL,
  game_id INT NOT NULL,
  quantity INT DEFAULT 1,               -- Số lượng game (nếu mua nhiều bản)
  FOREIGN KEY (order_id) REFERENCES don_hang(id) ON DELETE CASCADE,
  FOREIGN KEY (game_id) REFERENCES game(id) ON DELETE CASCADE
);

CREATE TABLE danh_gia(
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  game_id INT NOT NULL,
  score INT CHECK (score BETWEEN 1 AND 5),
  comment TEXT,
  review_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE,
  FOREIGN KEY (game_id) REFERENCES game(id) ON DELETE CASCADE
);

CREATE TABLE bao_loi (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  game_id INT NOT NULL,
  error_description TEXT,
  FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE,
  FOREIGN KEY (game_id) REFERENCES game(id) ON DELETE CASCADE
);

CREATE TABLE quan_ly_user (
  id INT AUTO_INCREMENT PRIMARY KEY,
  admin_id INT NOT NULL,
  user_id INT NOT NULL,
  FOREIGN KEY (admin_id) REFERENCES admin(id) ON DELETE CASCADE,
  FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
);

CREATE TABLE quan_ly_game(
  id INT AUTO_INCREMENT PRIMARY KEY,
  admin_id INT NOT NULL,
  game_id INT NOT NULL,
  FOREIGN KEY (admin_id) REFERENCES admin(id) ON DELETE CASCADE,
  FOREIGN KEY (game_id) REFERENCES game(id) ON DELETE CASCADE
);

INSERT INTO tai_khoan (username, password, full_name, date_of_birth, registration_date, phone_number, email, role)
VALUES
('hieule', '123456', 'Le Trung Hieu', '2003-01-01', CURRENT_DATE, '0123456789', 'user1@example.com', 'User'),
('khanhmap', '123456', 'Lai Khanh', '2003-05-15', CURRENT_DATE, '0123456780', 'user2@example.com', 'User'),
('taivo', '123456', 'Tan Tai', '2002-10-10', CURRENT_DATE, '0123456781', 'admin1@example.com', 'Admin'),
('pduy', '123456', 'Phuong Duy', '2004-07-22', CURRENT_DATE, '0123456782', 'admin2@example.com', 'Admin'),
('sonha', '123456', 'Son Ha', '2003-11-11', CURRENT_DATE, '0123456783', 'user3@example.com', 'User');


INSERT INTO user (reputation_points, status, account_id)
VALUES
(100, TRUE, 1),
(150, TRUE, 2),
(50, FALSE, 5);


INSERT INTO admin (account_id)
VALUES
(3),
(4);

INSERT INTO game (game_name, publisher, genre, price, discount, downloads, release_date, description, introduction, rating, image_url, recOS, recProcessor, recMemory, recGraphics, recDirectX, recStorage, minOS, minProcessor, minMemory, minGraphics, minDirectX, minStorage)
VALUES
('Call of Duty: Modern Warfare', 'Activision', 'Shooter', 59.99, 10.00, 1000, '2022-01-01', 'A thrilling action-packed shooter game', 'Introduction to the Call of Duty franchise', 4.5, 'https://gaming-cdn.com/images/products/1302/orig/call-of-duty-black-ops-iii-pc-mac-spil-steam-cover.jpg?v=1648067194', 'Windows', 'Intel i7', '16GB', 'NVIDIA GTX 1060', 'DirectX 12', '100GB', 'Windows 7', 'Intel i5', '8GB', 'NVIDIA GTX 1050', 'DirectX 11', '50GB'),
('The Legend of Zelda: Breath of the Wild', 'Nintendo', 'Adventure', 39.99, 5.00, 500, '2021-05-01', 'An exciting open-world adventure game', 'Introduction to the new Zelda universe', 4.0, 'https://assets.nintendo.com/image/upload/c_fill,w_1200/q_auto:best/f_auto/dpr_2.0/ncom/software/switch/70010000000025/7137262b5a64d921e193653f8aa0b722925abc5680380ca0e18a5cfd91697f58', 'Switch', 'NVIDIA Custom Tegra', '4GB', 'NVIDIA Custom Tegra', 'DirectX 12', '14GB', 'Switch', 'NVIDIA Custom Tegra', '4GB', 'NVIDIA Custom Tegra', 'DirectX 12', '14GB'),
('Elden Ring', 'Bandai Namco', 'RPG', 69.99, 0.00, 1500, '2023-06-15', 'A fantastic cooperative RPG game', 'Introduction to the Elden Ring world', 4.7, 'https://i.ytimg.com/vi/JldMvQMO_5U/maxresdefault.jpg', 'Linux', 'AMD Ryzen 5', '16GB', 'AMD Radeon RX 580', 'DirectX 12', '150GB', 'Windows 10', 'Intel i7', '8GB', 'NVIDIA GTX 1060', 'DirectX 12', '60GB'),
('Microsoft Flight Simulator', 'Microsoft', 'Simulation', 49.99, 20.00, 2000, '2022-08-10', 'An immersive flight simulation game', 'Introduction to realistic flying', 4.2, 'https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1250410/ss_d31fefd20eda54107d0414c779d0058c8b030233.1920x1080.jpg?t=1730994202', 'Windows', 'Intel i7', '8GB', 'AMD Radeon Pro 560', 'DirectX 11', '100GB', 'Windows 7', 'Intel i5', '4GB', 'NVIDIA GTX 950', 'DirectX 10', '40GB'),
('Civilization VI', '2K Games', 'Strategy', 29.99, 0.00, 2500, '2020-02-20', 'A historical strategy game', 'Introduction to Civilization Building', 3.8, 'https://i.ytimg.com/vi/xEi3tjXbKIQ/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLBq5VURtCuRYyoFqxEE7gKzo2FAiA', 'Windows', 'Intel i3', '4GB', 'NVIDIA GTX 750', 'DirectX 11', '20GB', 'Windows 7', 'Intel i3', '2GB', 'Intel HD Graphics', 'DirectX 10', '10GB'),
('Portal 2', 'Valve', 'Puzzle', 19.99, 5.00, 100, '2023-09-01', 'A challenging puzzle game built upon Aperture Science', 'Introduction to Portal mechanics', 4.3, 'https://shared.cloudflare.steamstatic.com/store_item_assets/steam/apps/620/header.jpg', 'Windows', 'Intel i5', '8GB', 'NVIDIA GTX 1050', 'DirectX 11', '50GB', 'Windows 7', 'Intel i3', '4GB', 'Intel HD Graphics', 'DirectX 10', '30GB'),
('DOOM Eternal', 'Bethesda', 'Shooter', 59.99, 15.00, 2000, '2021-06-01', 'A high-paced shooter game with intense action', 'Introduction to the DOOM universe', 4.8, 'https://image.api.playstation.com/vulcan/ap/rnd/202010/0114/ERNPc4gFqeRDG1tYQIfOKQtM.png', 'Linux', 'AMD Ryzen 5', '16GB', 'AMD Radeon RX 580', 'DirectX 12', '150GB', 'Windows 10', 'Intel i7', '8GB', 'NVIDIA GTX 1060', 'DirectX 12', '60GB'),
('Resident Evil Village', 'Capcom', 'Horror', 49.99, 10.00, 800, '2020-08-15', 'A terrifying horror game in a European village', 'Introduction to Resident Evil Village', 4.1, 'https://image.api.playstation.com/vulcan/ap/rnd/202101/0812/FkzwjnJknkrFlozkTdeQBMub.png', 'Windows', 'Intel i5', '8GB', 'NVIDIA GTX 1050', 'DirectX 11', '50GB', 'Windows 7', 'Intel i3', '4GB', 'NVIDIA GTX 950', 'DirectX 10', '40GB'),
('Forza Horizon 5', 'Xbox Game Studios', 'Racing', 39.99, 20.00, 1500, '2023-03-01', 'A fast-paced racing game with an open world', 'Introduction to the Forza racing experience', 4.4, 'https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/1551360/capsule_616x353.jpg?t=1730830713', 'MacOS', 'Intel i7', '16GB', 'AMD Radeon Pro 560', 'DirectX 12', '100GB', 'Windows 10', 'Intel i5', '8GB', 'NVIDIA GTX 1060', 'DirectX 11', '50GB'),
('Uncharted 4: A Thief End', 'Naughty Dog', 'Adventure', 59.99, 10.00, 1800, '2021-11-20', 'A gripping adventure game following the story of Nathan Drake', 'Introduction to cinematic storytelling', 4.7, 'https://i.ytimg.com/vi_webp/y1Rx-Bbht5E/maxresdefault.webp', 'Windows', 'Intel i5', '8GB', 'NVIDIA GTX 1050', 'DirectX 11', '80GB', 'Windows 7', 'Intel i3', '4GB', 'NVIDIA GTX 950', 'DirectX 10', '40GB'),
('StarCraft II', 'Blizzard Entertainment', 'Strategy', 29.99, 5.00, 900, '2020-05-10', 'A tactical strategy game with a science fiction theme', 'Introduction to the StarCraft universe', 4.0, 'https://cdn.hobbyconsolas.com/sites/navi.axelspringer.es/public/media/image/2013/03/214395-analisis-starcraft-ii-heart-swarm.jpg?tf=3840x', 'Windows', 'Intel i3', '4GB', 'NVIDIA GTX 750', 'DirectX 10', '30GB', 'Windows 7', 'Intel i3', '2GB', 'Intel HD Graphics', 'DirectX 9', '20GB'),
('Assassin\'s Creed: Valhalla', 'Ubisoft', 'Action', 69.99, 0.00, 2500, '2022-01-15', 'An epic action game set in the Viking era', 'Introduction to the Assassin\'s Creed series', 4.9, 'https://image.api.playstation.com/vulcan/img/rnd/202011/0302/01quIFlCq8SsABef4U70Tnks.jpg', 'Linux', 'AMD Ryzen 7', '32GB', 'NVIDIA RTX 3080', 'DirectX 12', '500GB', 'Windows 10', 'Intel i7', '16GB', 'NVIDIA GTX 1060', 'DirectX 12', '100GB'),
('The Sims 4', 'Electronic Arts', 'Simulation', 49.99, 10.00, 1300, '2021-09-12', 'A life simulation game where you control virtual people', 'Introduction to life simulation', 4.2, 'https://shared.cloudflare.steamstatic.com/store_item_assets/steam/apps/1222670/capsule_616x353.jpg?t=1731608003', 'MacOS', 'Intel i7', '16GB', 'AMD Radeon Pro 5600M', 'DirectX 12', '200GB', 'Windows 10', 'Intel i5', '8GB', 'NVIDIA GTX 1050', 'DirectX 11', '70GB'),
('The Witcher 3: Wild Hunt', 'CD Projekt', 'RPG', 59.99, 20.00, 1600, '2023-07-20', 'A fantasy RPG game with an expansive open world', 'Introduction to the Witcher universe', 4.6, 'https://herogame.vn/ad-min/assets/js/libs/kcfinder/upload/images/Herogame_TW3WHCPEDI_01.jpg', 'Windows', 'Intel i7', '16GB', 'NVIDIA GTX 1660 Ti', 'DirectX 12', '150GB', 'Windows 10', 'Intel i5', '8GB', 'NVIDIA GTX 1050', 'DirectX 12', '50GB'),
('Cyberpunk 2077', 'CD Projekt', 'RPG', 59.99, 10.00, 1400, '2020-12-10', 'A story-driven open world RPG set in a dark future.', 'Introduction to the Cyberpunk universe', 4.0, 'https://shared.cloudflare.steamstatic.com/store_item_assets/steam/apps/1091500/capsule_616x353.jpg?t=1730212296', 'Windows', 'Intel i7', '16GB', 'NVIDIA GTX 1070', 'DirectX 12', '70GB', 'Windows 10', 'Intel i5', '8GB', 'NVIDIA GTX 780', 'DirectX 11', '70GB'),
('Hades', 'Supergiant Games', 'Rogue-like', 24.99, 5.00, 700, '2020-09-17', 'A rogue-like dungeon crawler with sharp characters.', 'Introduction to Greek mythology in a new light', 4.9, 'https://hoanghamobile.com/tin-tuc/wp-content/uploads/2024/10/hades-game.jpg', 'Windows', 'Intel Dual Core', '4GB', 'NVIDIA GeForce 9400', 'DirectX 10', '15GB', 'Windows 7', 'Intel Dual Core', '4GB', 'NVIDIA GeForce 9400', 'DirectX 10', '15GB'),
('Ghost of Tsushima', 'Sony Interactive Entertainment', 'Action-Adventure', 59.99, 15.00, 900, '2020-07-17', 'A beautiful action-adventure set in feudal Japan.', 'Introduction to the world of samurai and ninjas', 4.8, 'https://i.ytimg.com/vi/cD5FrDNx9QU/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLCuBxpSFHQMM6-3ARnVsNy8bG1wUg', 'PS4', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A', 'N/A'),
('Among Us', 'InnerSloth', 'Party', 4.99, 0.00, 5000, '2018-11-16', 'A multiplayer party game about teamwork and betrayal.', 'Introduction to social deduction games', 4.5, 'https://images2.thanhnien.vn/528068263637045248/2023/6/28/among-us-16879157558491830914451.jpg', 'Windows', 'Intel Pentium 4', '1GB', 'Integrated graphics', 'DirectX 10', '250MB', 'Windows 7', 'Intel Pentium 4', '1GB', 'Integrated graphics', 'DirectX 10', '250MB'),
('Stardew Valley', 'ConcernedApe', 'Simulation', 14.99, 0.00, 2000, '2016-02-26', 'An open-ended country-life RPG.', 'Introduction to the soothing farm life sim', 4.8, 'https://shared.fastly.steamstatic.com/store_item_assets/steam/apps/413150/capsule_616x353.jpg?t=1711128146', 'Windows', 'Intel Core 2 Duo', '2GB', 'Integrated graphics', 'DirectX 10', '500MB', 'Windows Vista', 'Intel Core 2 Duo', '2GB', 'Integrated graphics', 'DirectX 10', '500MB'),
('Hollow Knight', 'Team Cherry', 'Metroidvania', 14.99, 10.00, 1200, '2017-02-24', 'A challenging and artful Metroidvania game.', 'Introduction to a dark and beautifully crafted world', 4.7, 'https://assets.nintendo.com/image/upload/c_fill,w_1200/q_auto:best/f_auto/dpr_2.0/ncom/software/switch/70010000003208/4643fb058642335c523910f3a7910575f56372f612f7c0c9a497aaae978d3e51', 'Windows', 'Intel Core 2 Duo', '4GB', 'NVIDIA GeForce 9800GTX', 'DirectX 11', '9GB', 'Windows 7', 'Intel Core 2 Duo', '2GB', 'NVIDIA GeForce 9800GTX', 'DirectX 11', '9GB');

INSERT INTO don_hang (user_id, order_date, total_amount, status, payment_status, payment_method, payment_date)
VALUES
(1, CURRENT_DATE, 59.99, 'Pending', 'Unpaid', 'Credit Card', NULL),
(2, CURRENT_DATE, 39.99, 'Paid', 'Paid', 'PayPal', CURRENT_DATE),
(3, CURRENT_DATE, 69.99, 'Paid', 'Paid', 'Credit Card', CURRENT_DATE),
(3, CURRENT_DATE, 49.99, 'Pending', 'Unpaid', 'Credit Card', NULL),
(2, CURRENT_DATE, 29.99, 'Canceled', 'Failed', 'PayPal', CURRENT_DATE);

INSERT INTO chi_tiet_don_hang (order_id, game_id, quantity)
VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 1),
(4, 4, 3),
(5, 5, 1);


INSERT INTO danh_gia (user_id, game_id, score, comment, review_timestamp)
VALUES
(1, 1, 5, 'Great game!', CURRENT_TIMESTAMP),
(2, 2, 4, 'Very fun, but a bit short.', CURRENT_TIMESTAMP),
(3, 3, 5, 'Amazing experience!', CURRENT_TIMESTAMP),
(2, 4, 3, 'Good, but could be better.', CURRENT_TIMESTAMP),
(1, 5, 2, 'Not as good as expected.', CURRENT_TIMESTAMP);


INSERT INTO bao_loi (user_id, game_id, error_description)
VALUES
(1, 1, 'Game crashed on startup'),
(2, 2, 'Unable to connect to server'),
(3, 3, 'Lag during gameplay'),
(3, 4, 'Audio issues'),
(2, 5, 'Game freezes intermittently');


INSERT INTO quan_ly_user (admin_id, user_id)
VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 3),
(2, 1);

INSERT INTO quan_ly_game (admin_id, game_id)
VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4),
(2, 5);