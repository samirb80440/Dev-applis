<?php
class Employe
{
    // Propriétés de la classe
    private $_nom;
    private $_prenom;
    private $_dateembauche;
    private $_poste;
    private $_salaire;
    private $_secteur;
    private $_durreembauche;
    private $_prime;
    private $_magasin;
    private $_enfant;

    // Méthodes set
    public function setNommage($nom) {
        $this->_nom = $nom;
    }

    public function setPrenomage($prenom) {
        $this->_prenom = $prenom;
    }

    public function setDateembauche($dateembauche) {
        $this->_dateembauche = $dateembauche;
    }

    public function setPoste($poste) {
        $this->_poste = $poste;
    }

    public function setSalaire($salaire) {
        $this->_salaire = $salaire;
    }

    public function setSecteur($secteur) {
        $this->_secteur = $secteur;
    }

    public function setMagasin($magasin) {
        $this->_magasin = $magasin;
    }

    public function setEnfant($enfant) {
        $this->_enfant = $enfant;
    }


    // Méthode pour afficher l'année de service
    public function afficherAnneedeservice(){
        $date = new DateTime();
        $dateembauche = new DateTime($this->_dateembauche);
        $datediff = $dateembauche->diff($date);
        $this->_durreembauche = $datediff->format('%R%a'); 
    }
    
        // Méthode pour calculer la prime
    public function setPrime(){
        $date = new DateTime('31-12-2024');
        $stockannée = $date->format('Y');
        $dateprime = new DateTime($stockannée . '-11-30');
        $datediff = $dateprime->diff($date);
           
        if($datediff->format('%R%a') > 0 ){
            $primedefault = 0.05;
            $pirmranc = round(($this->_durreembauche/364)) * 0.02;
            $primetotal =  1.0 + ($primedefault + $pirmranc);
            $this->_prime = 'la prime de : '. $this->_salaire * $primetotal - $this->_salaire.' a ete virer.';
            } else {
                $this->_prime = 'la prime pas encore virer .';
            }
        }


    // Méthodes get
    public function getNom() {
        return $this->_nom;
    }

    public function getPrenom() {
        return $this->_prenom;
    }
 
    public function getDateembauche(){
        return $this->_dateembauche;
    }

    
    public function getPoste(){
        return $this->_poste;
    }
        
    public function getSalaire(){
        return $this->_salaire;
    }

    public function getSecteur() {
        return $this->_secteur;
    }

    public function getDureembauche() {
        return $this->_durreembauche;
    }

    public function getPrime() {
        return $this->_prime;
    }

    public function getMagasin() {
        return $this->_magasin;
    }

    public function getAnneedeservice() {
        if($this->_durreembauche > 365){
            return "l'employe a le droit a des ticket vacances";
        } else {
            return "l'employe n'a pas le droit a des ticket vacances";
        }
    }

    public function getEnfant() {
        return $this->_enfant;
    }
    }
?>