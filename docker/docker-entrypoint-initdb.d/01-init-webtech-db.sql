\set webtechuser_password `echo $WEBTECHUSER_PASSWORD`
create user webtechuser password :'webtechuser_password';
create database webtech;
grant all privileges on database webtech to webtechuser;
