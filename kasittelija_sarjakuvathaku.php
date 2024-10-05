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
    echo "<li>
    <img class='titlekuva' src='$imagePath' alt='" . htmlspecialchars($row['title']) . "'> <br>
    <strong>Title:</strong> " . htmlspecialchars($row['title']) . " <br>
    <strong>Page count:</strong> " . htmlspecialchars($row['chapters']) . " <br>
    <strong>Description:</strong><br> " . htmlspecialchars($row['description']) . " <br>
    <a class='mt-3 btn btn-primary delete-button' href='delete_comic.php?id=" . $row['sarjakuva_id'] . "&image=" . urlencode($row['image']) . "' onclick='return confirm(\"Haluatko varmasti poistaa tämän sarjakuvan?\")'>Poista</a>
  </li>";
    break;
  case true:
    echo "<li>
    <img class='titlekuva' src='$imagePath' alt='" . htmlspecialchars($row['title']) . "'> <br>
    <strong>Title:</strong> " . htmlspecialchars($row['title']) . " <br>
    <strong>Page count:</strong> " . htmlspecialchars($row['chapters']) . " <br>
    <strong>Description:</strong><br> " . htmlspecialchars($row['description']) . " <br>
   </li>";
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