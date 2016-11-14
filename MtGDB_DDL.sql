create table creatures (
  cardID integer unique not null,
  cardName text,
  color text,
  cardType text,
  cardSet text,
  power integer,
  toughness integer,
  primary key (cardID)
);

create table nonCreatures (
  cardID integer unique not null,
  cardName text,
  color text,
  cardType text,
  cardSet text,
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

create table Decklist (
  deckID integer unique not null,
  playerID integer,
  deckName text,
  deckSize integer check (deckSize >= 60 or deckSize <= 300),
  primary key (deckID, playerID),
  foreign key (playerID) references Players(playerID)
    on update cascade
    on delete cascade
);

-- create table DeckInfo (
--   deckID integer,
--   cardID integer,
--   primary key (deckID)
-- );
