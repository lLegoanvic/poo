<?php

class Utilisateurs
{
    private int $id;
    private string $nom;
    private string $prenom;
    private string $tel;
    private string $email;


    public function __construct($data = [])
    {
        if(!empty($data))
        {
            $this->hydrate($data);
        }
    }

    public function hydrate($data)
    {
        foreach ($data as $attribute => $value)
        {
            $methodeSetters = 'set'.ucfirst($attribute);
            $this->$methodeSetters($value);
        }
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getTel(): string
    {
        return $this->tel;
    }

    /**
     * @param string $tel
     */
    public function setTel(string $tel): void
    {
        $this->tel = $tel;
    }

    /**
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function isUserValide()
    {
        return !(empty($this->nom) || empty($this->prenom) || empty($this->email));
    }

}

