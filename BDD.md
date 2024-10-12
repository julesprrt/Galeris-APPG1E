Script SQL de la base de donnée : à jour du 07/10/2024

CREATE TABLE Panier(
   id_panier INT,
   PRIMARY KEY(id_panier)
);

CREATE TABLE Categorie(
   id_categorie INT,
   Nom_categorie VARCHAR(50),
   PRIMARY KEY(id_categorie)
);

CREATE TABLE Utilisateur(
   Id_utilisateur INT,
   Nom VARCHAR(50) NOT NULL,
   Prénom VARCHAR(50) NOT NULL,
   Email VARCHAR(50) NOT NULL,
   Description VARCHAR(50),
   Adresse VARCHAR(50),
   Roles LOGICAL NOT NULL,
   Mot_de_passe VARCHAR(50) NOT NULL,
   Date_creation DATE NOT NULL,
   Newsletter LOGICAL,
   id_panier INT NOT NULL,
   PRIMARY KEY(Id_utilisateur),
   UNIQUE(Email),
   FOREIGN KEY(id_panier) REFERENCES Panier(id_panier)
);

CREATE TABLE Oeuvre(
   id_oeuvre INT,
   Titre VARCHAR(100) NOT NULL,
   Description VARCHAR(200) NOT NULL,
   eco_responsable LOGICAL NOT NULL,
   Date_debut DATE NOT NULL,
   Date_fin DATE NOT NULL,
   Prix DECIMAL(15,2),
   est_vendu LOGICAL,
   Type_vente LOGICAL NOT NULL,
   Status enum,
   auteur VARCHAR(50),
   id_categorie INT NOT NULL,
   Id_utilisateur INT NOT NULL,
   PRIMARY KEY(id_oeuvre),
   FOREIGN KEY(id_categorie) REFERENCES Categorie(id_categorie),
   FOREIGN KEY(Id_utilisateur) REFERENCES Utilisateur(Id_utilisateur)
);

CREATE TABLE Historique(
   id_historique VARCHAR(50),
   Prix DECIMAL(15,2),
   Date_vente DATE,
   id_oeuvre INT NOT NULL,
   Id_utilisateur INT NOT NULL,
   PRIMARY KEY(id_historique),
   FOREIGN KEY(id_oeuvre) REFERENCES Oeuvre(id_oeuvre),
   FOREIGN KEY(Id_utilisateur) REFERENCES Utilisateur(Id_utilisateur)
);

CREATE TABLE Article_panier(
   id_item_panier INT,
   id_oeuvre INT NOT NULL,
   id_panier INT NOT NULL,
   PRIMARY KEY(id_item_panier),
   FOREIGN KEY(id_oeuvre) REFERENCES Oeuvre(id_oeuvre),
   FOREIGN KEY(id_panier) REFERENCES Panier(id_panier)
);

CREATE TABLE Exposition(
   id_exposition INT,
   Description VARCHAR(200),
   Adresse VARCHAR(50),
   Ville VARCHAR(50),
   Pays VARCHAR(50),
   Code_postale VARCHAR(50),
   Titre VARCHAR(50),
   Status Enum NOT NULL,
   Id_utilisateur INT NOT NULL,
   PRIMARY KEY(id_exposition),
   FOREIGN KEY(Id_utilisateur) REFERENCES Utilisateur(Id_utilisateur)
);

CREATE TABLE Favoris(
   id_favoris INT,
   Date_favoris DATE,
   Id_utilisateur INT NOT NULL,
   id_oeuvre INT NOT NULL,
   PRIMARY KEY(id_favoris),
   FOREIGN KEY(Id_utilisateur) REFERENCES Utilisateur(Id_utilisateur),
   FOREIGN KEY(id_oeuvre) REFERENCES Oeuvre(id_oeuvre)
);

CREATE TABLE Quiz_resultat(
   id_quiz_resultat INT,
   Score INT,
   Date_quiz DATE,
   Id_utilisateur INT NOT NULL,
   PRIMARY KEY(id_quiz_resultat),
   FOREIGN KEY(Id_utilisateur) REFERENCES Utilisateur(Id_utilisateur)
);

CREATE TABLE Quiz(
   id_quiz VARCHAR(50),
   Titre VARCHAR(50),
   Description VARCHAR(200),
   Questions JSON,
   id_quiz_resultat INT NOT NULL,
   PRIMARY KEY(id_quiz),
   FOREIGN KEY(id_quiz_resultat) REFERENCES Quiz_resultat(id_quiz_resultat)
);

CREATE TABLE Code_promo(
   id_codepromo INT,
   Code INT,
   Date_expiration DATE,
   Pourcentage_reduction DECIMAL(15,2),
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

CREATE TABLE Photo(
   id_photo INT,
   Image Long blob,
   id_oeuvre INT NOT NULL,
   PRIMARY KEY(id_photo),
   FOREIGN KEY(id_oeuvre) REFERENCES Oeuvre(id_oeuvre)
);

CREATE TABLE Enchère(
   id_enchère VARCHAR(50),
   Prix DECIMAL(15,2),
   Date_enchere DATE,
   Id_utilisateur INT NOT NULL,
   id_oeuvre INT NOT NULL,
   PRIMARY KEY(id_enchère),
   FOREIGN KEY(Id_utilisateur) REFERENCES Utilisateur(Id_utilisateur),
   FOREIGN KEY(id_oeuvre) REFERENCES Oeuvre(id_oeuvre)
);

