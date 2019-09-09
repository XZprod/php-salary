create table professions (
  id integer auto_increment primary key,
  name varchar(50) not null
);

insert into professions (name) VALUES
('Бухгалтер'), ('Курьер'), ('Менеджер');

create table workers (
   id integer auto_increment primary key,
   firstname varchar(50) not null,
   lastname varchar(50) not null,
   position integer references professions(id),
   salary decimal(8,2) not null,
   photo varchar(200),
   CONSTRAINT fk_workers_professions FOREIGN KEY (position) REFERENCES professions(id)
);

insert into workers (firstname, lastname, position, salary, photo) VALUES
('Сергей', 'Владимиров', 1, 23000.00, 'https://sun9-59.userapi.com/c448/u00057/a_6a1020f6.jpg?ava=1'),
('Елисей', 'Замахов', 2, 31000.00, 'https://sun9-26.userapi.com/c846017/v846017911/114bc1/8efOLF-lcxY.jpg'),
('Владислав', 'Ерофеев', 3, 25468.00, ''),
('Анатолий', 'Вассерман', 3, 12456.00, ''),
('Екатерина', 'Замятова', 3, 54867.00, ''),
('Кирилл', 'Гундяев', 2, 22145.00, ''),
('Андрей', 'Волосников', 2, 32154.00, ''),
('Николай', 'Колпаков', 2, 28654.00, ''),
('Виталий', 'Прохоров', 1, 31255.00, ''),
('Анастасия', 'Сидорова', 2, 57933.00, ''),
('Александр', 'Сидоров', 1, 101555.00, ''),
('Дмитрий', 'Шмаков', 2, 25200.00, ''),
('Татьяна', 'Афонасьева', 2, 12121.00, ''),
('Владис', 'Петровс', 3, 14578.00, ''),
('Евгения', 'Плотникова', 2, 71452.00, ''),
('Дмитрий', 'Донской', 1, 12364.00, '');

create table payment(
  id integer auto_increment primary key,
  worker integer references workers(id),
  date date,
  salary decimal(8,2),
  CONSTRAINT fk_payment_workers FOREIGN KEY (worker) REFERENCES workers(id)
);

create table currency(
    id integer auto_increment primary key,
    name varchar(50) not null,
    short varchar(10) not null
);

insert into currency(name, short) values ('Доллар', 'USD');

create table currency_date(
    currency integer not null references currency(id),
    value decimal(5,2) not null,
    date date not null,
    CONSTRAINT fk_currdate_currency FOREIGN KEY (currency) REFERENCES currency(id)
);