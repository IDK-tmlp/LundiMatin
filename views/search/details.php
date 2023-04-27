<section class="bg-primary w-100 p-1">
    <p class="text-white container">Rechercher un contact</p>
</section>

<section class="m-2">
    <p class="bg-white container p-4"><?= $client->nom ?></p>
</section>

<section class="bg-white container p-2">
    <div>
        <div class="p-4 d-flex justify-content-between">
            <p class="fw-bold">INFORMATIONS</p>
            <a href='index.php?page=search&action=edit&id=<?=$client->id?>' class='btn btn-warning border-3 text-white'><i class="bi bi-gear"></i> Editer</a>
        </div>
        <p class="border-bottom container"></p>
    </div>
    <div class="d-flex justify-content-center">
        <div class="border-end p-3 text-end fw-bold">
            <p >Prénom & NOM</p>
            <p>Télephone</p>
            <p>Email</p>
            <p>Adresse</p>
        </div>
        <div class="p-3">
            <p><?=$client->nom?></p>
            <p><?=$client->tel?></p>
            <p><?=$client->email?></p>
            <p><?=$client->adresse?><br>
                <?=$client->code_postal." ".$client->ville?>
            </p>
        </div>
    </div>
</section>