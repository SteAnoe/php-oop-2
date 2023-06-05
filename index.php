<?php

class Prodotto {
    use rangeEtà;

    public $id;
    public $nome;
    public $prezzo;
    public $immagine;
    public $categoria;
    public $tipo;
    
    
    public function __construct($id, $nome, $prezzo, $immagine, $categoria, $tipo, $eta) {
        $this->id = $id;
        $this->nome = $nome;
        $this->prezzo = $prezzo;
        $this->immagine = $immagine;
        $this->categoria = $categoria;
        $this->tipo = $tipo;
        $this->setAge($eta);
        if (empty($nome)) {
            throw new Exception("Il prodotto non ha tutte le informazioni necessarie.");
        }
    }
    
}

class Categoria {
    public $id;
    public $nome;
    public $icona;

    public function __construct($id, $nome, $icona) {
        $this->id = $id;
        $this->nome = $nome;
        $this->icona = $icona;
    }
}

trait rangeEtà {
    public $eta;

    public function setAge($eta){
        $this->eta = $eta;
    }
    public function getAge() {
        return $this->eta;
    }
}

// Creazione di una categoria
$categoriaCani = new Categoria(1, "Cane", "fa-solid fa-dog");
$categoriaGatto = new Categoria(2, "Gatto", "fa-solid fa-cat");

// Creazione di un prodotto
$prodotti = [
    new Prodotto(1, "Cibo per cani", 10.99, "https://www.naturepetshop.it/wp-content/uploads/cibo-secco-per-cani-300x215.jpg", $categoriaCani, "Cibo", "Adulti"),
    new Prodotto(2, "Cibo per gatti", 15.99, "https://www.my-personaltrainer.it/2021/04/13/cibo-per-gatti_900x760.jpeg", $categoriaGatto, "Cibo", "Cuccioli"),
    new Prodotto(3, "Palla per cani", 20.99, "https://t1.ea.ltmcdn.com/it/posts/3/8/6/insegnare_al_cane_a_riportare_la_palla_passo_per_passo_683_600.jpg", $categoriaCani, "Palla", "Cuccioli"),
    new Prodotto(4, "Cuccia per gatti", 25.99, "https://croci.net/wp-content/uploads/2020/09/8023222228832.PT03.jpg", $categoriaGatto, "Cuccia", "Adulti"),
];

try {
    new Prodotto(1, "", 10.99, "https://www.naturepetshop.it/wp-content/uploads/cibo-secco-per-cani-300x215.jpg", $categoriaCani, "Cibo", "Adulti");
} catch (Exception $e) {
    echo "Errore: " . $e->getMessage();
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-comm Animali</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body{
            height: 100vh;
            width: 100vw;
            display: grid;
            place-items: center;
            background-color: #3C3C3C;
        }
        .card{
            position: relative;
            padding: 0;
            margin: 5px;
        }
        i{
            position: absolute;
            top: 10px;
            right: 10px;
            border: 1px solid red;
            border-radius: 50%;
            padding: 10px;
            color: red;
        }
    </style>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <?php foreach ($prodotti as $index => $elem) { ?>
                <div class="card" style="width: 18rem;">
                    <img src="<?php echo $elem->immagine ?>" class="card-img-top h-75" alt="...">
                    <i class="<?php echo $elem->categoria->icona ?>"></i>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $elem->nome ?></h5>
                        <div>Prodotto: <?php echo $elem->tipo ?></div>
                        <div>Animale: <?php echo $elem->categoria->nome ?></div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="<?php echo "#elem" . $index ?>">
                          Dettagli aggiuntivi
                        </button>
                    </div>
                </div>
                <div class="modal fade" id="<?php echo "elem" . $index ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo $elem->nome ?></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            Prezzo: €<?php echo $elem->prezzo ?>
                        </div>
                        <div>
                            Prodotto <?php echo $elem->tipo ?> per <?php echo $elem->getAge() ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                    </div>
                </div>
                </div>
            <?php } ?>
        </div> 
    </div>
 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>