create table outdoor_detail(
    activity_id int NOT NULL,
    name varchar(50),
    address varchar(100),
    phone varchar(20),
    opening_hours varchar(20),
    PRIMARY KEY (activity_id)
);

create table outdoor_rating(
    activity_id int NOT NULL,
    rating int,
    PRIMARY KEY (activity_id)
);

create table indoor_detail(
    activity_id int NOT NULL,
    name varchar(50),
    address varchar(100),
    phone varchar(20),
    opening_hours varchar(20),
    PRIMARY KEY (activity_id)
);

create table indoor_rating(
    activity_id int NOT NULL,
    rating int,
    PRIMARY KEY (activity_id)
);

load data local infile './outdoors.csv'
into table outdoor_detail
fields terminated by ','
lines terminated by '\n'
ignore 1 lines;

load data local infile './indoors.csv'
into table indoor_detail
fields terminated by ','
lines terminated by '\n'
ignore 1 lines;

load data local infile './outdoors.rate.csv'
into table outdoor_rating
fields terminated by ','
lines terminated by '\n'
ignore 1 lines;

load data local infile './indoors.rate.csv'
into table indoor_rating
fields terminated by ','
lines terminated by '\n'
ignore 1 lines;
