insert into rezq_users (us_email, us_password, us_verified, us_verification, us_role, us_first_name, us_last_name, us_profile_pic) values ('johndoe@gmail.com', 'john_pass', 1, null, 'foster', 'John', 'Doe', 'img/profiles/john_doe.jpg');
insert into rezq_users (us_email, us_password, us_verified, us_verification, us_role, us_first_name, us_last_name, us_profile_pic) values ('plainjane@yahoo.com', 'plain_pass', 1, null, 'foster', 'Tomlin', 'Cockayme', 'img/add_event.png');
insert into rezq_users (us_email, us_password, us_verified, us_verification, us_role, us_first_name, us_last_name, us_profile_pic) values ('adminccrezq@gmail.com', 'admincc_pass', 1, null, 'admin', 'Caillin', 'Admin', 'img/profiles/caillin.jpg');
insert into rezq_users (us_email, us_password, us_verified, us_verification, us_role, us_first_name, us_last_name, us_profile_pic) values ('dougsmith@hotmail.com', 'doug_pass', 1, null, 'foster', 'Doug', 'Smith', 'img/profiles/doug_smith.png');

insert into rezq_dogs values (null,'Goodboi','He is really active to a point where he will chew anything, literally anything!','img/dogs/goodboi1.jpg',21);
insert into rezq_dogs values (null,'Pupper','She is kinda moody sometimes but super friendly','img/dogs/pupper.jpg',22);
insert into rezq_dogs values (null,'Doggo','He loves to get dirty, I spend half my time cleaning him','img/dogs/doggo.jpg',24);

insert into rezq_dog_details values(1,'Breed','Siberian Husky');
insert into rezq_dog_details values(1,'Age','3 yrs');
insert into rezq_dog_details values(1,'In foster care of','John Doe');

insert into rezq_dog_details values(2,'Breed','Labrador');
insert into rezq_dog_details values(2,'Age','6 months');
insert into rezq_dog_details values(2,'In foster care of','Plain Jane');

insert into rezq_dog_details values(3,'Breed','Pug');
insert into rezq_dog_details values(3,'Age','2.5 yrs');
insert into rezq_dog_details values(3,'In foster care of','Doug Smith');

insert into rezq_dog_events values(null,'She looks so gloomy today','She did not even wanna play outside','Posted on Saturday, September 30 at 10:30 am','image','img/dogs/sad_pupper.jpg','alert',2)
insert into rezq_dog_events values(null,'Oh wow','This is such a cool video','Posted on Saturday, September 30 at 8:07 am','video','videos/doggo1.mp4','event',3)

INSERT INTO rezq_notifications (nf_by_user, nf_for_users, nf_level, nf_subject, nf_body) VALUES
(2, "adminccrezq@gmail.com", "alert", "Require food for dogo", "I am running out of food my dogo here, and would appreciate some of those dogo food...for him")
