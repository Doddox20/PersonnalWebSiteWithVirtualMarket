TYPE=TRIGGERS
triggers='CREATE DEFINER=`root`@`localhost` TRIGGER `increment_nbProduit` AFTER INSERT ON `produit` FOR EACH ROW UPDATE categorie\nSET nbProduit = nbProduit + 1\nWHERE idCategorie = NEW.idCategorie'
sql_modes=1075838976
definers='root@localhost'
client_cs_names='utf8mb4'
connection_cl_names='utf8mb4_unicode_ci'
db_cl_names='latin1_swedish_ci'
created=168500397385
