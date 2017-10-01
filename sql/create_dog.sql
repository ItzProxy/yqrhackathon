CREATE TABLE Foster_family(
    fam_id int NOT NULL AUTO_INCREMENT,
    fam_name varchar(255),
    PRIMARY KEY(fam_id)
);
/*Creates dog table*/
CREATE TABLE Dog(
    dog_id int NOT NULL AUTO_INCREMENT,
    fam_id int,
    name varchar(255) NOT NULL,
    descript varchar(300),
    visible_dog BOOLEAN DEFAULT 1,
    PRIMARY KEY(dog_id),
    FOREIGN KEY(fam_id) REFERENCES Foster_family(fam_id)
);

CREATE TABLE Doggo_timeline(
    timeline_id int NOT NULL AUTO_INCREMENT,
    dog_id int NOT NULL,
    title varchar(255),
    image varchar(255), /*image path*/
    desc_time varchar(255),
    alert BOOLEAN DEFAULT 0,
    time TIMESTAMP,
    PRIMARY KEY(timeline_id),
    FOREIGN KEY(dog_id) REFERENCES Dog(dog_id)
);

CREATE TABLE DoggoField(
    dog_id int NOT NULL,
    doggo_field varchar(255),
    doggo_value varchar(255),
    FOREIGN KEY(dog_id) REFERENCES Dog(dog_id)
);

CREATE TABLE Doggo_Alerts(
	alert_id INT PRIMARY KEY AUTO_INCREMENT,
    by_user VARCHAR(
);


