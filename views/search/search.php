<div class="bg-primary w-100">
    <p class="text-white container">Rechercher un contact</p>
</div>

<div class="m-2">
    <p class="bg-white container p-4">Recherche d'une fiche de contact</p>
</div>

<form action="index.php?page=search" method="POST" class="container border bg-white">
    <div class="d-flex flex-column align-items-center">
        <div class="form-group m-2">
            <label for='name' class="fw-bold ">Renseigner un nom ou une dénomination : </label>
            <input type="text" placeholder="Nom ou dénomination" name="name" class="form-control">
        </div>
        <div class="form-group m-2 ">
            <button type="submit" class='btn btn-warning'>Rechercher</button>
        </div>
    </div>
</form>
<table class='table border container mt-3 bg-white'>
    <thead class="table-light">
        <th></th>
        <th>Nom</th>
        <th>Adresse</th>
        <th>Ville</th>
        <th>Téléphone</th>
        <th></th>
    </thead>
    <?php
    foreach ($clients as $client) {
        $str = explode(' ',ucwords($client->nom));
        $fc = "";
        foreach ($str as $name) {
            $fc .= substr($name, 0, 1);
        }
        echo "<tr>";
        echo "<td><span class='align-items-center justify-content-center d-flex border p-2 rounded-circle text-white bg-secondary' style='width:50px;height:50px'>$fc</span></td>";
        echo "<td class='fw-bold'>$client->nom</td>";
        echo "<td>$client->adresse</td>";
        echo "<td>$client->ville</td>";
        echo "<td>$client->tel</td>";
        echo '<td><a href="index.php?page=search&action=details&id=' . $client->id . '" class="btn btn-primary rounded-pill"><i class="bi bi-search"></i> Voir</a></td>';
        echo "</tr>";
    }
    
    ?>
</table>