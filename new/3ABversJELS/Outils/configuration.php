<?php            


////////////////////////////////////////////////////////////////////////////////
///////////////////////////////  INITIALISATION  ///////////////////////////////
////////////////////////////////////////////////////////////////////////////////


   $GLOBALS['fichier crepes']               = "../3AB/Crepe.xml"; 
   $GLOBALS['fichier menus']                = "../3AB/menu.xml";
   $GLOBALS['fichier commandes']            = "../3AB/commandes.xml";

   $GLOBALS['serveur mysql']                = "localhost";
   $GLOBALS['utilisateur mysql']            = "root";
   $GLOBALS['mot de passe mysql']           = "";
   /*$GLOBALS['base mysql out']               = "la-galette-orceenne";
   $GLOBALS['base mysql in']                = "crepes2";   */


                                                                                
////////////////////////////////////////////////////////////////////////////////
//////////////////////////////  BASE DE DONNEES  ///////////////////////////////
////////////////////////////////////////////////////////////////////////////////


function connexionBD ()
{                                                                                                                       
   $erreur = @mysql_connect($GLOBALS['serveur mysql'], $GLOBALS['utilisateur mysql'], $GLOBALS['mot de passe mysql'])
      or
      erreurCritique("Impossible de se connecter au serveur de bases de donn&eacute;es MySQL.", __LINE__);
   if ($erreur == FALSE)
      erreurCritique("Impossible de se connecter au serveur de bases de donn&eacute;es MySQL.", __LINE__);
}

function envoiRequete ($requete)
{
   $res = @mysql_query($requete)
      or
      erreur("La requete &agrave; la base de donn&eacute;es n'a pas abouti", __LINE__);
   if ($res == FALSE)
      erreur("La requete &agrave; la base de donn&eacute;es n'a pas abouti", __LINE__);
   return $res;
}

function recherche_rapide ($requete, $in_ou_out)
{      
   $res = envoiRequete($requete, $in_ou_out);
   $ligne = mysql_fetch_row($res);
   if ($ligne == FALSE)
      return "";
   else
      return $ligne[0];
}


function dateEnFormatSQL ($date)
{
   return substr($date,6,4) . '/' . substr($date,3,2) . '/' . substr($date,0,2);
}      

function dateEnFormatFr ($date)
{
   if (strlen($date) < 10) return $date;
   return substr($date,8,2) . '/' . substr($date,5,2) . '/' . substr($date,0,4);
}

                                                                                
////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////   X PATH   //////////////////////////////////
////////////////////////////////////////////////////////////////////////////////


function executerRequeteXPath ($fichier, $requete)
{
   $xmlDocument = new DOMDocument();
   if ($xmlDocument->load($fichier)) {
      $xpath = new DOMXPath($xmlDocument);
      $nodeList = $xpath->query($requete, $xmlDocument);
      return $nodeList;
   } else {
      return NULL;
   }
}    

function executerEvaluationXPath ($fichier, $requete)
{
    $xmlDocument = new DOMDocument();
    if ($xmlDocument->load($fichier)) {
        $xpath = new DOMXPath($xmlDocument);
        $result = $xpath->evaluate($requete, $xmlDocument);
        return $result;
    } else {
        return NULL;
    }
}
          
function contenuBalise ( /* balise */ /* (optionel) noms des sous-balises consécutives à explorer */ )
{
   if (func_num_args() == 0) {   
      return erreur("arbre xml incorrect", __LINE__);
   } else {
      $balise = func_get_arg(0);
      if ($balise) {
         for ($i = 1 ; $i < func_num_args(); $i++) {
            $balise = $balise->getElementsByTagName(func_get_arg($i));
            if ($balise) {
               $balise = $balise->item(0);
               if (!$balise) {
                  return erreur("balise non trouvee", __LINE__);
               }
            } else {
               return erreur("balise non trouvee", __LINE__);
            }
         }
         return $balise->nodeValue;
      } else {                         
         return erreur("balise non trouvee", __LINE__);
      }
   }
}

function balises ($baliseContenante, $nomBaliseContenue)
{
   if ($baliseContenante && $nomBaliseContenue) {     
      return $baliseContenante->getElementsByTagName($nomBaliseContenue);
   } else {                                                                  
      return erreur("balise non trouvee", __LINE__);
   }
}    


                                                                                
////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////  DIVERS  ///////////////////////////////////
////////////////////////////////////////////////////////////////////////////////


function erreur ($intitule, $ligne)
{
   echo "[Erreur \"$intitule\", fichier " . __FILE__ . ", ligne $ligne]";
}      

function erreurCritique ($intitule)
{
   echo "<html><head><title>Erreur</title></head><body><p>$intitule</p></body></html>";
   exit();
}


?>