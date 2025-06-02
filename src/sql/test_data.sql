-- Insert users
INSERT INTO users (username, password, email) VALUES
('hoge', 'hashed_password1', 'hoge@example.com'),
('piyo', 'hashed_password2', 'piyo@example.com'),
('kiki', 'hashed_password3', 'kiki@example.com'),
('tutu', 'hashed_password4', 'tutu@example.com');

-- Insert tasks
INSERT INTO tasks (user_id, description, status) VALUES

-- User 1: hoge
(1, 'Research Chinese literature report at the library', 'pending'),
(1, 'Submit English reading comprehension assignment', 'completed'),
(1, 'Check exam coverage for midterm', 'pending'),
(1, 'Practice traditional Chinese character typing', 'completed'),

-- User 2: piyo
(2, 'Record living expenses (using budgeting app)', 'completed'),
(2, 'Check balance of transportation IC card (EasyCard)', 'completed'),

-- User 3: kiki
(3, 'Submit Python exercise assignment', 'pending'),
(3, 'Prepare for international student welcome event', 'completed'),
(3, 'Organize GitHub account', 'pending'),

-- User 4: tutu
(4, 'Submit experiment report', 'completed'),
(4, 'Schedule meeting with academic advisor', 'pending'),
(4, 'Summarize experiment data in Excel', 'completed');
