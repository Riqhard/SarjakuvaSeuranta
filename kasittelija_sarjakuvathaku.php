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

                echo "<li>
                        <img class='titlekuva' src='$imagePath' alt='" . htmlspecialchars($row['title']) . "'> <br>
                        <strong>Title:</strong> " . htmlspecialchars($row['title']) . " <br>
                        <strong>Page count:</strong> " . htmlspecialchars($row['chapters']) . " <br>
                        <strong>Description:</strong><br> " . htmlspecialchars($row['description']) . "
                        
                    </li>";
            }
        } else {
            echo "<li>Ei tuloksia.</li>";
        }
    }
    ?>