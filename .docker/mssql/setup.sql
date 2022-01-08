CREATE DATABASE flatnix;
go

USE flatnix;
go

CREATE TABLE subscriptions(
    subscriptionId  Int Identity(1,1),
    name            Varchar(50),
    description     Varchar(500),
    monthlyPrice    Decimal(4,2),

    Constraint PK_subscriptionId Primary Key(subscriptionId)
);

CREATE TABLE users(
    userId          Int Identity(1,1),
    subscriptionId  Int,
    name            Varchar(100),
    surname         Varchar(100),
    country         Varchar(100),
    birthyear       Numeric(4),
    bankAccNo       Varchar(18),
    username        Varchar(100),
    password        Varchar(256),
    createdAt       Date Default Current_Timestamp,

    Constraint PK_userId Primary Key(userId),
    Constraint FK_subscriptionId Foreign Key(subscriptionId)
                                 References subscriptions(subscriptionId)
                                    On Update Cascade
                                    On Delete No Action,
    Constraint CK_birthyear Check(birthyear <= Current_Timestamp),
    Constraint CK_createdAt Check(createdAt <= Current_Timestamp)
);

CREATE TABLE movies(
    movieId         Int Identity(1,1),
    title           Varchar(200),
    description     Text,
    genre           Varchar(50),
    duration        Time,
    releaseYear     Numeric(4),

    Constraint PK_movieId Primary Key(movieId),
    Constraint CK_releaseYear Check(releaseYear <= Year(Current_Timestamp))
);

CREATE TABLE movieActors(
    actorId         Int Identity(1,1),
    movieId         Int,
    name            Varchar(100),
    surname         Varchar(100),

    Constraint PK_MOVIEACTORS_actorId Primary Key(actorId),
    Constraint FK_MOVIEACTORS_movieId Foreign Key(movieId)
                          References movies(movieId)
                            On Update Cascade
                            On Delete Cascade
);

CREATE TABLE movieDirectors(
    directorId      Int Identity(1,1),
    movieId         Int,

    name            Varchar(100),
    surname         Varchar(100),
    Constraint PK_MOVIEDIRECTORS_directorId Primary Key(directorId),
    Constraint FK_MOVIEDIRECTORS_movieId Foreign Key(movieId)
                            References movies(movieId)
                                On Update Cascade
                                On Delete Cascade
);

CREATE TABLE movieReviews(
    reviewId        Int Identity(1,1),
    userId          Int,
    movieId         Int,
    content         Varchar(512),
    rating          Numeric(2),

    Constraint PK_MOVIEREVIEWS_reviewId Primary Key(reviewId),
    Constraint CK_MOVIEREVIEWS_rating Check(rating Between 0 And 9),
    Constraint FK_MOVIEREVIEWS_userId Foreign Key(userId)
                         References users(userId)
                           On Update Cascade
                           On Delete No Action,
    Constraint FK_MOVIEREVIEWS_movieId Foreign Key(movieId)
                         References movies(movieId)
                           On Update Cascade
                           On Delete Cascade
);
go

INSERT INTO movies VALUES
(
    'James Bond',
    'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Veniam delectus quisquam, cupiditate dolorem animi facere sunt sit blanditiis, placeat asperiores, odio perferendis! Nemo assumenda facilis mollitia vero esse, cupiditate eos.',
    'action',
    '02:10',
    1990
),
(
    'Finding Nemo',
    'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Veniam delectus quisquam, cupiditate dolorem animi facere sunt sit blanditiis, placeat asperiores, odio perferendis! Nemo assumenda facilis mollitia vero esse, cupiditate eos.',
    'animated',
    '01:50',
    2012
),
(
    'Dune',
    'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Veniam delectus quisquam, cupiditate dolorem animi facere sunt sit blanditiis, placeat asperiores, odio perferendis! Nemo assumenda facilis mollitia vero esse, cupiditate eos.',
    'scifi',
    '02:35',
    2021
);
go

INSERT INTO movieActors VALUES
(
    1,
    'Daniel',
    'Craig'
), (
    3,
    'Jason',
    'Momoa'
);
go

INSERT INTO movieDirectors VALUES
(
    1,
    'Cary',
    'Fukunaga'
);
go

INSERT INTO subscriptions VALUES
(
    'Cheap',
    'You get access to all of our movies but none of the series.',
    5.99
),
(
    'Regular',
    'You get access to all of our movies and non-premium series.',
    8.99
),
(
    'Premium',
    'You get access to all of our movies and series',
    11.99
);
go

INSERT INTO users VALUES 
(
    2,
    'Simon',
    'Peters',
    'Netherlands',
    2002,
    'NL11INGB0655555555',
    'simon',
    'test',
    '2022'
);
go

INSERT INTO movieReviews VALUES
(
    1,
    1, 
    'Very good movie!',
    8
);
go