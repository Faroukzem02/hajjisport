<?php
include "connexion.php";
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['searchQuery']) && !empty($_POST['searchQuery'])) {
    $searchQuery = $_POST['searchQuery'];
    $sql = $conn->prepare("
        SELECT 'products' AS src, id, nom, sport, type_en, type_fr, type_it, category_en, category_fr, category_it, NULL AS title1_fr, NULL AS title1_en, NULL AS title1_it, NULL AS encadrement_nom
        FROM products 
        WHERE nom LIKE ? OR sport LIKE ? OR type_en LIKE ? OR type_it LIKE ? OR type_fr LIKE ? OR category_fr LIKE ? OR category_en LIKE ? OR category_it LIKE ?
    
        UNION 
    
        SELECT 'promos' AS src, id, nom, sport, type_en, type_fr, type_it, category_en, category_fr, category_it, NULL AS title1_fr, NULL AS title1_en, NULL AS title1_it, NULL AS encadrement_nom
        FROM promos 
        WHERE nom LIKE ? OR sport LIKE ? OR type_en LIKE ? OR type_it LIKE ? OR type_fr LIKE ? OR category_fr LIKE ? OR category_en LIKE ? OR category_it LIKE ?
    
        UNION 
    
        SELECT 'services' AS src, NULL AS id, NULL AS nom, NULL AS sport, NULL AS type_en, NULL AS type_fr, NULL AS type_it, NULL AS category_en, NULL AS category_fr, NULL AS category_it, title1_fr, title1_en, title1_it, NULL AS encadrement_nom
        FROM services 
        WHERE title1_fr LIKE ? OR title1_en LIKE ? OR title1_it LIKE ?
    
        UNION 
    
        SELECT 'encadrement' AS src, id, nom, NULL AS sport, NULL AS type_en, NULL AS type_fr, NULL AS type_it, NULL AS category_en, NULL AS category_fr, NULL AS category_it, NULL AS title1_fr, NULL AS title1_en, NULL AS title1_it, nom AS encadrement_nom
        FROM encadrement 
        WHERE nom LIKE ?
    ");
    $searchParam = "%" . $searchQuery . "%";
    $sql->execute([
        $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam,
        $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam,
        $searchParam,$searchParam,$searchParam,
        $searchParam,
    ]);
    $results = "";
    if ($sql->rowCount() > 0) {
        while ($result = $sql->fetch(PDO::FETCH_ASSOC)) {
            $results .= "<div class='result'>";
            if ($result['src'] === "products") {
                $results .= "<a href='product?pid=" . $result['id'] . "'>" . $result['nom'] . " (" .  $result["category_fr"] . " " .  $result["type_fr"] . ")</a>";
            } elseif ($result['src'] === "promos") {
                $results .= "<a href='promos?pid=" . $result['id'] . "'>" . $result['nom'] . " (" .  $result["category_fr"] . " " .  $result["type_fr"] . ")</a>";
            } elseif ($result['src'] === "services") {
                $results .= "<a href='services'>" . $result['src'] . " : " . $result['title1_fr'] .  "</a>";
            }else{
                $results .= "<a href='staff?pid=" .$result['id']. "'>" . $result['src'] . " : " . $result['nom'] .  "</a>";
            }
            $results .= "</div>";
        }
        echo $results;
    } else {
        echo "<div class='no-results'>aucun resultat</div>";
    }
}
