USE doggo_hackathon;
DROP TABLE IF EXISTS rezq_users;
CREATE TABLE rezq_users(
	us_id INT PRIMARY KEY AUTO_INCREMENT,
    us_email VARCHAR(255),
    us_password VARCHAR(255),
    us_verified CHAR(1),
    us_verification VARCHAR(8),
    us_role VARCHAR(10), /* "foster" or "admin" */
    us_first_name VARCHAR(255),
    us_last_name VARCHAR(255),
    us_profile_pic VARCHAR(255)
);
DROP TABLE IF EXISTS rezq_dogs;
CREATE TABLE rezq_dogs(
	dg_id INT PRIMARY KEY AUTO_INCREMENT,
    dg_name VARCHAR(255),
    dg_description VARCHAR(255),
    dg_profile_pic VARCHAR(255),
    dg_care_of INT,
    FOREIGN KEY(dg_care_of) REFERENCES rezq_users(us_id)
);
DROP TABLE IF EXISTS rezq_dog_details;
CREATE TABLE rezq_dog_details(
	dg_id INT,
    dg_field VARCHAR(100),
    dg_value VARCHAR(255)
);
DROP TABLE IF EXISTS rezq_dog_events;
CREATE TABLE rezq_dog_events(
	ev_id INT PRIMARY KEY AUTO_INCREMENT,
    ev_title VARCHAR(255),
    ev_description VARCHAR(255),
    ev_time VARCHAR(100),
    ev_media_type VARCHAR(10),
    ev_media_path VARCHAR(255),
    ev_type VARCHAR(10), /* event or alert */
    ev_dg_id INT,
    FOREIGN KEY(ev_dg_id) REFERENCES rezq_dogs(dg_id)
);
DROP TABLE IF EXISTS rezq_notfications;
CREATE TABLE rezq_notifications(
	nf_id INT PRIMARY KEY AUTO_INCREMENT,
    nf_by_user INT,
    nf_for_users VARCHAR(255), /*comma separated user ids or all*/
    nf_level VARCHAR(10), /*alert or event*/
    nf_subject VARCHAR(255),
    nf_body VARCHAR(255)
);
    