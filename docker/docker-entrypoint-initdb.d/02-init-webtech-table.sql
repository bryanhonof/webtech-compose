\connect webtech
create table if not exists temperature(
  id integer primary key generated always as identity,
  value double precision not null,
  datetime timestamp with time zone default now()
);
grant insert on table temperature to webtechuser;
grant select on table temperature to webtechuser;
grant update on table temperature to webtechuser;
grant delete on table temperature to webtechuser;
