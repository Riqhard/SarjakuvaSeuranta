<?php
    if (isset($_POST['search'])) {
        $search = $_POST['search'];

        // SQL-kysely
        $query = "SELECT * FROM sarjakuvat WHERE title LIKE ? OR description LIKE ?";
        $stmt = $yhteys->prepare($query);
        $search_term = "%" . $search . "%";
        $stmt->bind_param("ss", $search_term, $search_term);
        $stmt->execute();
        $result = $stmt->get_result();

        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if (empty($row['image'])) {
                    $row['image'] = "placeholder.png";
                }
                $imagePath = "sarjakuvien_kuvat/" . htmlspecialchars($row['image']);


switch ($loggedIn) {
  case 'admin':
    echo "<div class='sarjakuva_lista'><li>
    <img class='titlekuva' src='$imagePath' alt='" . htmlspecialchars($row['title']) . "'> <br>
    <strong>" . htmlspecialchars($row['title']) . " </strong><br>
    <strong>Sivumäärä:</strong> " . htmlspecialchars($row['chapters']) . " <br>
    <strong>Kuvaus:</strong><br> " . htmlspecialchars($row['description']) . " <br>
    <a class='mt-3 btn btn-primary delete-button' href='delete_comic.php?id=" . $row['sarjakuva_id'] . "&image=" . urlencode($row['image']) . "' onclick='return confirm(\"Haluatko varmasti poistaa tämän sarjakuvan?\")'>Poista</a>
  </li></div>";
    break;
  case true:
    echo "<div class='sarjakuva_lista'><li>
    <img class='titlekuva' src='$imagePath' alt='" . htmlspecialchars($row['title']) . "'> <br>
    <strong>" . htmlspecialchars($row['title']) . " </strong><br>
    <strong>Sivumäärä:</strong> " . htmlspecialchars($row['chapters']) . " <br>
    <strong>Kuvaus:</strong><br> " . htmlspecialchars($row['description']) . " <br>
   </li></div>";
    break;
  default:
    header("location: login.php");
    break;
  } 
            }
        } else {
            echo "<li>Ei tuloksia.</li>";
        }
    }
    ?>