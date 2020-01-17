<?php get_header(); ?>

<div class="container">
        <div class="row">
            <div class="col-sm">

            <h1 class="page-heading">Mes pays que j'ai visité sont ...</h1>
			
            <form id="create">
                <div class="form-group">
                    <label>Fonction Create</label>
                    <input type="text" class="form-control" placeholder="le nom du pays ...">
                    <input type="submit" class="btn btn-primary" value="Create">
                </div>
            </form>
            <p id="create-result">Si tu vois ce texte, c'est parce que tu n'as pas installé <a href="https://metamask.io/">Metamask</a> </p>
            
        
            <form id="read">
                <div class="form-group">
                    <label>Fonction read</label>
                    <input type="text" class="form-control" placeholder="le ID ...">
                    <input type="submit"  class="btn btn-primary" value="Read">
                </div>
            </form>
            <p id="read-result"></p>

            <form id="update">
                <div class="form-group">
                    <label>Fonction Update</label>
                    <input type="text" class="form-control" placeholder="ID">
                    <input type="text" class="form-control" placeholder="le nom du pays que tu souhaites modifier...">
                    <input type="submit"  class="btn btn-primary" value="Update">
                </div>
            </form>
            <p id="update-result"></p>

            <form id="destroy">
                <div class="form-group">
                    <label>Fonction Destroy</label>
                    <input type="text" class="form-control" placeholder="ID du pays à supprimer ...">
                    <input type="submit"  class="btn btn-primary" value="Destroy">
                </div>
            </form>
            <p id="destroy-result"></p>

            </div>
        </div>
    </div>


<?php get_footer(); ?>