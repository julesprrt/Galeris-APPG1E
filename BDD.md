Script SQL de la base de donnée : à jour du 07/10/2024

CREATE TABLE Oeuvre(
   id_produit INT,
   Titre VARCHAR(100) NOT NULL,
   Description VARCHAR(200) NOT NULL,
   eco_responsable Boolean NOT NULL,
   Date_debut DATE NOT NULL,
   Date_fin DATE NOT NULL,
   Prix DECIMAL(15,2),
   est_vendu Boolean,
   Type_vente Boolean NOT NULL,
   Demande Boolean,
   Id_utilisateur INT NOT NULL,
   PRIMARY KEY(id_produit),
   FOREIGN KEY(Id_utilisateur) REFERENCES Utilisateur(Id_utilisateur)
);

CREATE TABLE Historique(
   id_historique VARCHAR(50),
   Prix DECIMAL(15,2),
   Date_vente DATE,
   id_produit INT NOT NULL,
   Id_utilisateur INT NOT NULL,
   PRIMARY KEY(id_historique),
   FOREIGN KEY(id_produit) REFERENCES Oeuvre(id_produit),
   FOREIGN KEY(Id_utilisateur) REFERENCES Utilisateur(Id_utilisateur)
);

CREATE TABLE Panier(
   id_panier INT,
   Date_creation VARCHAR(50),
   Id_utilisateur INT NOT NULL,
   PRIMARY KEY(id_panier),
   FOREIGN KEY(Id_utilisateur) REFERENCES Utilisateur(Id_utilisateur)
);

CREATE TABLE Article_panier(
   id_item_panier INT,
   id_produit INT NOT NULL,
   id_panier INT NOT NULL,
   PRIMARY KEY(id_item_panier),
   FOREIGN KEY(id_produit) REFERENCES Oeuvre(id_produit),
   FOREIGN KEY(id_panier) REFERENCES Panier(id_panier)
);

CREATE TABLE Exposition(
   id_exposition INT,
   Description VARCHAR(200),
   Adresse VARCHAR(50),
   Titre VARCHAR(50),
   Demande Boolean NOT NULL,
   Id_utilisateur INT NOT NULL,
   PRIMARY KEY(id_exposition),
   FOREIGN KEY(Id_utilisateur) REFERENCES Utilisateur(Id_utilisateur)
);

CREATE TABLE Favoris(
   id_favoris INT,
   Id_utilisateur INT NOT NULL,
   id_produit INT NOT NULL,
   PRIMARY KEY(id_favoris),
   FOREIGN KEY(Id_utilisateur) REFERENCES Utilisateur(Id_utilisateur),
   FOREIGN KEY(id_produit) REFERENCES Oeuvre(id_produit)
);

CREATE TABLE Quiz(
   id_quiz VARCHAR(50),
   Titre VARCHAR(50),
   Description VARCHAR(200),
   Questions JSON,
   PRIMARY KEY(id_quiz)
);

CREATE TABLE Code_promo(
   id_codepromo INT,
   Code INT,
   Date_expiration DATE,
   Id_utilisateur INT NOT NULL,
   PRIMARY KEY(id_codepromo),
   FOREIGN KEY(Id_utilisateur) REFERENCES Utilisateur(Id_utilisateur)
);

CREATE TABLE Code(
   id_code INT,
   Code INT,
   Date_expiration VARCHAR(50),
   Id_utilisateur INT NOT NULL,
   PRIMARY KEY(id_code),
   FOREIGN KEY(Id_utilisateur) REFERENCES Utilisateur(Id_utilisateur)
);

CREATE TABLE Quiz_resultat(
   id_quiz_resultat INT,
   Score INT,
   Date_quiz DATE,
   Id_utilisateur INT NOT NULL,
   id_quiz VARCHAR(50) NOT NULL,
   PRIMARY KEY(id_quiz_resultat),
   FOREIGN KEY(Id_utilisateur) REFERENCES Utilisateur(Id_utilisateur),
   FOREIGN KEY(id_quiz) REFERENCES Quiz(id_quiz)
);