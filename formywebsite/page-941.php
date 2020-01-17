<?php get_header(); ?>

<div class="container">
        <h1>Mon Smart Contract Portefeuille</h1>


        <form id="deposit">
            <div class="form-group">
                <label>Nombre d'Ether à déposer sur le smart contract</label>
                <input type="text" class="form-control" placeholder="Renseigner le nombre d'ether à envoyer">
            </div>
            <button type="submit" class="btn btn-danger">Déposer de l'Ether sur le smart contract</button>
            <small class="form-text text-muted">L'adresse du smart contract est : <span
                    id="contractAddress1"></span></small>
        </form>
        <p id="deposit-result"></p>

        <form id="balanceOf">
            <div class="form-group">
                <label>Regarder le solde du smart contract (Balance Of)</label>
            </div>
            <button type="submit" class="btn btn-primary">Nombre d'Ether dans le smart contract</button>
            <small class="form-text text-muted">L'adresse du smart contract est : <span
                    id="contractAddress2"></span></small>
        </form>
        <p id="balanceOf-result"></p>

        <form id="withdraw">
            <div class="form-group">
                <label>Retirer de l'ether depuis le smart contract <span id="contractAddress"></span> à l'adresse
                    ci-dessous</label>
                <input type="text" class="form-control" placeholder="Renseigner l'adresse où envoyer de l'ether">
                <small class="form-text text-muted">Seul <span
                    id="ownerAddress"></span> (le propriétaire du smart contract) peut utiliser le bouton</small>
            </div>
            <button type="submit" class="btn btn-warning">Retirer de l'ether</button>
            <small class="form-text text-muted">L'adresse du smart contract est : <span
                    id="contractAddress3"></span></small>
        </form>
        <p id="withdraw-result"></p>


    </div>

<?php get_footer(); ?>