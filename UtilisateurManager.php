<?php

class UtilisateurManager
{
    private PDO $db;

    public  function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function inserer(Utilisateurs $utilisateur)
    {
        $req = $this->db->prepare('INSERT INTO utilisateurs(nom, prenom, tel, email) VALUES (:nom, :prenom, :tel, :email)');

        $req->bindValue(':nom', $utilisateur->getNom());
        $req->bindValue(':prenom', $utilisateur->getPrenom());
        $req->bindValue(':tel', $utilisateur->getTel());
        $req->bindValue(':email', $utilisateur->getEmail());
        $req->execute();
    }

    public function getListeUtilisateurs()
    {
        $req = $this->db->query('SELECT * FROM utilisateurs ORDER BY nom ASC');
        $req->setFetchMode(PDO::FETCH_CLASS, 'Utilisateurs');
        $liste = $req->fetchAll();
        $req->closeCursor();
        return $liste;
    }

    public function getUtilisateur($id)
    {
        $req = $this->db->prepare('SELECT * FROM utilisateurs WHERE id= :id');
        $req->bindValue(':id', (int) $id, PDO::PARAM_INT);
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Utilisateurs');
        return $req->fetch();
    }
}