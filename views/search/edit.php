<section class="bg-primary w-100 p-1">
    <p class="text-white container">Rechercher un contact</p>
</section>

<section class="m-2">
    <p class="bg-white container p-4"><?= $client->nom ?></p>
</section>

<section class="bg-white container p-2">
    <div>
        <div class="p-4 d-flex justify-content-between">
            <p class="fw-bold">EDITION</p>
            <a href='index.php?page=search&action=edit&id=<?= $client->id ?>' class='btn btn-warning text-white'><i class="bi bi-gear"></i> Editer</a>
        </div>
        <p class="border-bottom container"></p>
    </div>
    <form action="index.php?page=search&action=edit&id=<?= $client->id ?>" method="POST">
        <div class="d-flex justify-content-center">
            <div class="border-end p-3 text-end fw-bold mb-2">
                <p>Prénom & NOM</p>
                <p>Télephone</p>
                <p>Email</p>
                <p>Adresse</p>
                <p>Code postal</p>
                <p>Ville</p>
            </div>
            <div class="p-3">
                <input type="text" name="nom" value="<?= $client->nom ?>" class="form-control"></input>
                <input type="text" name="tel" value="<?= $client->tel ?>" class="form-control"></input>
                <input type="text" name="email" value="<?= $client->email ?>" class="form-control"></input>
                <input type="text" name="adresse" value="<?= $client->adresse ?>" class="form-control"></input>
                <input type="text" name="code_postal" value="<?= $client->code_postal ?>" class="form-control"></input>
                <input type="text" name="ville" value="<?= $client->ville ?>" class="form-control"></input>
            </div>
        </div>
        <p class="border-bottom container"></p>
        <div class="text-end m-2">
            <a href="index.php?page=search" class='btn border'>Annuler</a>
            <button type="submit" value="edit" class='btn border btn-success'>Enregistrer</button>
        </div>
    </form>
</section>