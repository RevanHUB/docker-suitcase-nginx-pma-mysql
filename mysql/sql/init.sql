/*UPDATE mysql.user SET host='%'
WHERE user='root' AND host='localhost';
GRANT ALL PRIVILEGES ON *.* TO 'root'@'localhost';
GRANT ALL PRIVILEGES ON *.* TO 'root'@'%';
CREATE USER 'laravel'@'%' WITH mysql_native_password BY  'root';
FLUSH PRIVILEGES;*/