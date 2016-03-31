
CREATE DATABASE IF NOT EXISTS Costumeo CHARACTER SET 'utf8';
CREATE TABLE IF NOT EXISTS Costumeo.Role
(
  ID                    INT         NOT NULL AUTO_INCREMENT,
  Libelle               CHAR(150)    NOT NULL,
  Description            CHAR(150)               NOT NULL,
  Date_creation         DATE,
  Date_modification     DATE,
  PRIMARY KEY (ID)
);
CREATE TABLE Costumeo.Utilisateur
(
    id                  INT                             NOT NULL AUTO_INCREMENT,
    nom                 CHAR (100)      NOT NULL,
    prenom              CHAR (100)      NOT NULL,
    email		VARCHAR (255)   NOT NULL,
    date_naissance      DATE            NOT NULL,
    ville               CHAR (255)      NOT NULL,
    Adresse             Char(250)       NOT NULL,
    code_postal         CHAR (5)        NOT NULL,
    Pays                CHAR (250)      NOT NULL,
    Sexe                INT (1)         NOT NULL,
    Role                INT(11)    	NOT NULL,
    Date_creation       DATE            NOT NULL,
    Date_modification   DATE            NOT NULL,
  PRIMARY KEY(id), 
   FOREIGN KEY(Role) REFERENCES Costumeo.Role(ID)
);

CREATE TABLE IF NOT EXISTS Costumeo.Produits
(
  ID                            int(11)                 NOT NULL AUTO_INCREMENT,
  Libelle                       CHAR(200)                  NOT NULL,
  Description                   char(250)               NOT NULL,
  Sexe        INT(1)            NOT NULL,
  IMAGES      BLOB      NOT NULL,
  Tags 	      CHAR(250) NOT NULL,
  Prix_vente                    int(8)                                  NOT NULL,
  Nombres_produit               char(9)                 NOT NULL,
  Date_creation                 DATE,
  Date_modification             DATE,
  PRIMARY KEY(ID)
);
CREATE TABLE IF NOT EXISTS Costumeo.Produit_Utilisateur
(
        ID_produit int(11)      NOT NULL,
        ID_utilisateur int(11) NOT NULL,
        FOREIGN KEY (ID_produit) REFERENCES Costumeo.Produits(ID),
        FOREIGN KEY (ID_utilisateur) REFERENCES Costumeo.Utilisateur(id)
);

INSERT INTO Costumeo.Role (Libelle, Description, Date_creation, Date_modification)
VALUES ('123456', 'ADMIN', '2015/10/12', '2015/10/15');
INSERT INTO Costumeo.Role (Libelle, Description, Date_creation, Date_modification)
VALUES ('142563', 'UTILISATEUR', '2015/10/19', '2015/10/30');

INSERT INTO Costumeo.Utilisateur (nom, prenom, date_naissance, ville, Adresse, code_postal, Pays, Sexe, Role, Date_creation, Date_modification)
VALUES ('Velia', 'Kevin', '1993/12/11', 'Paris', '20 rue magellan', '75000', 'France', '1', '1', '2015/10/11', '2015/10/24');
INSERT INTO Costumeo.Utilisateur (nom, prenom, date_naissance, ville, Adresse, code_postal, Pays, Sexe, Role, Date_creation, Date_modification)
VALUES ('Ganeswaran', 'Sabrina', '1891/09/08', 'Londres', '20 rue Godeater', '19001', 'Angleterre', '1', '1', '2015/10/11', '2015/10/24');
INSERT INTO Costumeo.Utilisateur (nom, prenom, date_naissance, ville, Adresse, code_postal, Pays, Sexe, Role, Date_creation, Date_modification)
VALUES ('Roques', 'Myriam', '1993/06/11', 'Provins', '18 rue Loriec', '77171', 'France', '0', '2', '2015/10/11', '2015/10/24');




INSERT INTO Costumeo.Produits (Libelle, Sexe, Prix_vente, Nombres_produit,  Date_creation, Date_modification)
VALUES ('Robe rose', '1', '25', '12', '2015/10/11', '2015/10/24');
INSERT INTO Costumeo.Produits (Libelle, Sexe, Prix_vente, Nombres_produit,  Date_creation, Date_modification)
VALUES ('Robe bleu', '1', '20', '2', '2015/11/11', '2015/12/24');
INSERT INTO Costumeo.Produits (Libelle, Sexe, Prix_vente, Nombres_produit,  Date_creation, Date_modification)
VALUES ('Vieille robe', '1', '50', '1', '2015/09/10', '2015/10/24');
INSERT INTO Costumeo.Produits (Libelle, Sexe, Prix_vente, Nombres_produit,  Date_creation, Date_modification)
VALUES ('Lot de trois robes', '1','15', '2', '2015/08/13', '2015/10/24');
INSERT INTO Costumeo.Produits (Libelle, Sexe, Prix_vente, Nombres_produit,  Date_creation, Date_modification)
VALUES ('Costumes', '2','2', '18', '2015/10/11', '2015/10/24');
INSERT INTO Costumeo.Produits (Libelle, Sexe, Prix_vente, Nombres_produit,  Date_creation, Date_modification)
VALUES ('Costume blanc', '2','100', '1', '2015/05/11', '2015/10/24');
INSERT INTO Costumeo.Produits (Libelle, Sexe, Prix_vente, Nombres_produit,  Date_creation, Date_modification)
VALUES ('Costume pirate', '2','10', '99', '2015/10/11', '2015/10/24');


INSERT INTO Costumeo.Produit_Utilisateur (ID_produit, ID_utilisateur)
VALUES (1, 1);
INSERT INTO Costumeo.Produit_Utilisateur (ID_produit, ID_utilisateur)
VALUES (2, 2);
