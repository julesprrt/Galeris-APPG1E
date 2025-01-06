CREATE TABLE favoris(
id_favoris INTEGER PRIMARY KEY AUTO_INCREMENT,
id_utilisateur INTEGER,
id_oeuvre INTEGER,
FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur) ON DELETE CASCADE
FOREIGN KEY (id_oeuvre) REFERENCES oeuvre(id_oeuvre) ON DELETE CASCADE
);
