<form action="chambre_ajouter.php" method="POST">
    <label>Hôtel :</label>
    <select name="id_hotel" required>
        <option value="">-- Choisir un hôtel --</option>
        <?php
        include './includes/db.php';
        $hotels = $pdo->query("SELECT * FROM hotels")->fetchAll();
        foreach ($hotels as $hotel) {
            echo "<option value='{$hotel['id']}'>{$hotel['nom']}</option>";
        }
        ?>
    </select><br>

    <label>Type de chambre :</label>
    <input type="text" name="type_chambre" required><br>

    <label>Prix :</label>
    <input type="number" name="prix" step="0.01" required><br>

    <label>Disponibilité :</label>
    <select name="disponibilite" required>
        <option value="disponible">Disponible</option>
        <option value="occupée">Occupée</option>
    </select><br>

    <label>Nombre de lits :</label>
    <input type="number" name="nombre_lits" required><br>

    <button type="submit">Ajouter la chambre</button>
</form>
