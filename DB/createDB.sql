-- database
CREATE DATABASE IF NOT EXISTS pragma DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_unicode_ci;
USE pragma;
SET default_storage_engine = InnoDB;

-- tables
CREATE TABLE IF NOT EXISTS priorities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(20) NOT NULL
) engine = InnoDB;

CREATE TABLE IF NOT EXISTS states (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(20) NOT NULL
) engine = InnoDB;

CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    comments TEXT,
    dueDate DATE,
    priority_id INT NOT NULL,
    state_id INT NOT NULL DEFAULT,
    FOREIGN KEY (priority_id) REFERENCES priorities(id),
    FOREIGN KEY (state_id) REFERENCES states(id)
) engine = InnoDB;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(20) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(60) NOT NULL,
) engine = InnoDB;

-- add content
INSERT INTO priorities (name) VALUES ("basse");
INSERT INTO priorities (name) VALUES ("moyenne");
INSERT INTO priorities (name) VALUES ("haute");

INSERT INTO states (name) VALUES ("to do");
INSERT INTO states (name) VALUES ("doing");
INSERT INTO states (name) VALUES ("done");
INSERT INTO states (name) VALUES ("archived");

INSERT INTO tasks (name, comments, dueDate, priority_id) VALUES ('This is the first task to do', 'Vestibulum quam sapien, varius ut, blandit non, interdum in, ante. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis faucibus accumsan odio. Curabitur convallis.', '2022-05-02', 1);
INSERT INTO tasks (name, comments, dueDate, priority_id) VALUES ('This is the second task to do', 'Nulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi. Cras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque. Quisque porta volutpat erat. Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla. Nunc purus.', '2022-07-05', 2);
INSERT INTO tasks (name, comments, dueDate, priority_id) VALUES ('This is the third task to do', 'Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem. Integer tincidunt ante vel ipsum. Praesent blandit lacinia erat. Vestibulum sed magna at nunc commodo placerat.', '2022-01-07', 3);

INSERT INTO tasks (name, comments, priority_id) VALUES ('This is the fourth task to do', 'In congue. Etiam justo. Etiam pretium iaculis justo. In hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus. Nulla ut erat id mauris vulputate elementum. Nullam varius. Nulla facilisi.', 2);
INSERT INTO tasks (name, comments, priority_id) VALUES ('This is the fifth task to do', 'Proin interdum mauris non ligula pellentesque ultrices. Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl. Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.', 1);
INSERT INTO tasks (name, comments, priority_id) VALUES ('This is the sixth task to do', 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.', 3);

INSERT INTO tasks (name, dueDate, priority_id) VALUES ('This is the seventh task to do', '2022-01-14', 2);
INSERT INTO tasks (name, dueDate, priority_id) VALUES ('This is the eighth task to do', '2022-06-24', 1);
INSERT INTO tasks (name, dueDate, priority_id) VALUES ('This is the ninth task to do', '2021-11-19', 2);

INSERT INTO users(firstname, lastname, email, password) VALUES('Antoine', 'Venel', 'venel.antoine@hotmail.fr', '$2y$10$hKOUDYyO9KUy/hk6itKQK.nR2ss6luYH8.sSwprqQ8QOP8.e/kI8G');
INSERT INTO users(firstname, lastname, email, password) VALUES('Soizic', 'Venel', 'venel.soizic@hotmail.fr', '$2y$10$5ZUEA7RxVesy.GVjxNGc9O6d.8FzKqn9DCOSTxxVGA7Zmshv7hzda');