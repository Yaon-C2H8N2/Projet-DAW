CREATE TABLE LOGIN
(
    ID       INT GENERATED ALWAYS AS IDENTITY,
    LOGIN    VARCHAR UNIQUE NOT NULL,
    PASSWORD VARCHAR(64)    NOT NULL,
    SALT     VARCHAR(64)    NOT NULL,
    PRIMARY KEY (ID)
);

INSERT INTO LOGIN
VALUES (DEFAULT, 'deleted', 'deleted', 'deleted');

CREATE TABLE ADMIN
(
    IDUSER INT,
    PRIMARY KEY (IDUSER),
    FOREIGN KEY (IDUSER) REFERENCES LOGIN (ID)
);

CREATE TABLE QCM
(
    ID   INT GENERATED ALWAYS AS IDENTITY,
    PATH VARCHAR NOT NULL,
    PRIMARY KEY (ID)
);

CREATE TABLE USERINFO
(
    IDUSER         INT,
    PSEUDO         VARCHAR UNIQUE,
    NOM            VARCHAR,
    PRENOM         VARCHAR,
    DATE_NAISSANCE DATE,
    IMAGE_PROFIL   VARCHAR,
    FOREIGN KEY (IDUSER) REFERENCES LOGIN (ID),
    PRIMARY KEY (IDUSER)
);

INSERT INTO USERINFO
VALUES (1, 'Utilisateur supprimé', 'supprimé', 'utilisateur', '2000-01-01', null);

CREATE TABLE QCMRESULTS
(
    IDQCM  INT       NOT NULL,
    IDUSER INT       NOT NULL,
    NOTE   INT,
    DATE   TIMESTAMP NOT NULL,
    FOREIGN KEY (IDQCM) REFERENCES QCM (ID),
    FOREIGN KEY (IDUSER) REFERENCES USERINFO (IDUSER),
    PRIMARY KEY (IDQCM, IDUSER)
);

CREATE TABLE TOPIC
(
    IDTOPIC       INT GENERATED ALWAYS AS IDENTITY,
    NOM_TOPIC     VARCHAR   NOT NULL,
    IDAUTEUR      INT       NOT NULL,
    DATE_CREATION TIMESTAMP NOT NULL,
    FOREIGN KEY (IDAUTEUR) REFERENCES USERINFO (IDUSER),
    PRIMARY KEY (IDTOPIC)
);

CREATE TABLE MESSAGES
(
    IDAUTEUR  INT       NOT NULL,
    IDTOPIC   INT       NOT NULL,
    IDMESSAGE INT GENERATED ALWAYS AS IDENTITY,
    CONTENT   VARCHAR   NOT NULL,
    DATE      TIMESTAMP NOT NULL,
    FOREIGN KEY (IDAUTEUR) REFERENCES USERINFO (IDUSER),
    FOREIGN KEY (IDTOPIC) REFERENCES TOPIC (IDTOPIC),
    PRIMARY KEY (IDAUTEUR, IDTOPIC, IDMESSAGE)
);

CREATE TABLE COURS
(
    ID   INT PRIMARY KEY GENERATED ALWAYS AS IDENTITY,
    PATH VARCHAR NOT NULL
);

-- TRIGGER POUR SUPPRIMER LES MESSAGES D'UN UTILISATEUR SUPPRIME
CREATE OR REPLACE FUNCTION supprimer_utilisateur()
    RETURNS TRIGGER
    LANGUAGE PLPGSQL
AS
$$
DECLARE
    id_utilisateur INT;
BEGIN
    id_utilisateur = OLD.ID;
    UPDATE MESSAGES SET CONTENT = 'Ce message a été supprimé' WHERE IDAUTEUR = id_utilisateur;
    UPDATE MESSAGES SET IDAUTEUR = 1 WHERE IDAUTEUR = id_utilisateur;
    UPDATE TOPIC SET IDAUTEUR = 1 WHERE IDAUTEUR = id_utilisateur;
    DELETE FROM ADMIN WHERE IDUSER = id_utilisateur;
    DELETE FROM QCMRESULTS WHERE IDUSER = id_utilisateur;
    DELETE FROM USERINFO WHERE IDUSER = id_utilisateur;
    RETURN OLD;
END
$$;

-- TRIGGER POUR SUPPRIMER LES MESSAGES D'UN UTILISATEUR SUPPRIME
CREATE OR REPLACE TRIGGER trigger_supprimer_messages_utilisateur
    BEFORE DELETE
    ON LOGIN
    FOR EACH ROW
EXECUTE FUNCTION supprimer_utilisateur();

-- INSERTION DU TOPIC PAR DEFAUT
INSERT INTO topic
VALUES (DEFAULT, 'Introduction à Neptune', 1, CURRENT_TIMESTAMP);

INSERT INTO messages
VALUES (1, 1, DEFAULT, 'Chers membres de Neptune,
    Nous souhaitons vous rappeler l''importance de maintenir une bonne conduite et un comportement respectueux sur ce forum. Notre communauté est un espace de partage et d''échange où tous les membres doivent se sentir en sécurité et respectés.
    Voici quelques règles simples que nous vous invitons à suivre:
    *Évitez les insultes et les attaques personnelles envers d''autres membres.
    *Ne postez pas de contenu offensant, discriminatoire ou illégal.
    *Respectez les opinions et les points de vue différents des vôtres, même si vous ne les partagez pas.
    *Soyez courtois et poli dans vos interactions avec les autres membres.
    *Évitez les débats houleux et les discussions qui risquent de dégénérer en conflit.
    *En respectant ces règles, vous aiderez à maintenir un environnement convivial et positif pour tous les membres de la communauté. Nous vous remercions pour votre compréhension et votre coopération.
    Cordialement, l''équipe Neptune.', CURRENT_TIMESTAMP);


-- INSERTION DES QCM
INSERT INTO qcm
VALUES (DEFAULT, 'DevWeb.xml');
INSERT INTO qcm
VALUES (DEFAULT, 'Logiciel#1.xml');

-- INSERTION DES COURS
INSERT INTO cours
VALUES (DEFAULT, 'Introduction à Java.json');
INSERT INTO cours
VALUES (DEFAULT, 'Introduction aux technologies web.json');
INSERT INTO cours
VALUES (DEFAULT, 'Introduction à la culture générale de l''informatique.json');
