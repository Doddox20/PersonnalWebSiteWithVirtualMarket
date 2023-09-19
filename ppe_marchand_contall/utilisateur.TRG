TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER createClient AFTER INSERT ON utilisateur\nFOR EACH ROW\n\n    INSERT INTO client (id_utilisateur) VALUES (new.Id_utilisateur)'
sql_modes=1075838976
definers='root@localhost'
client_cs_names='utf8mb4'
connection_cl_names='utf8mb4_unicode_ci'
db_cl_names='latin1_swedish_ci'
created=168052597406
