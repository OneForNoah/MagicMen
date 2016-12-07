create table creatures (
  cardID integer unique not null,
  cardName text unique,
  manacost text,
  color text,
  cardType text,
  cardText text,
  power integer,
  toughness integer,
  primary key (cardID)
);

create table nonCreatures (
  cardID integer unique not null,
  cardName text unique,
  manacost text,
  color text,
  cardType integer,
  cardText integer,
  primary key (cardID)
);

create table Players (
  playerID integer unique not null,
  playerName text not null,
  timePlayed integer,
  wins integer,
  losses integer,
  communityRating integer,
  primary key (playerID)
);

create table DeckInfo (
  deckID integer unique not null,
  playerID integer,
  deckName text,
  deckSize integer,
  primary key (deckID, playerID),
  foreign key (playerID) references Players(playerID)
    on update cascade
    on delete cascade
);

create table Decklists (
  deckID integer,
  playerID integer,
  cardID integer,
  numOf integer,
  foreign key (deckID, playerID) references DeckInfo(deckID, playerID)
    on update cascade
    on delete cascade
);
