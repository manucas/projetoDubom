<?php
    defined('BASEPATH') OR exit('URL inválida.');

    $values = false;
    if($this->input->server('REQUEST_METHOD') == 'POST') $values = true;

?>

<div class="container bg-warnig">

    <!-- Fomr Geral -->
    <form  action="<?php echo site_url('cl_checkout'); ?>" 
                    class="needs-validation" 
                    novalidate 
                    method="post">

    <!-- Gelo -->
    <h4 class="text-center pt-2 pb-3 text-red">Gelo&nbsp;&nbsp;(Escolha seus Produtos)</h4>
    <?php if(count($produtosG) === 0 ): ?>
    
        <p class="text-center">Não tenho registro de produto.</p>
    
    <?php else: ?>    

        <div class="row">

            <?php foreach($produtosG as $produto): ?>
                <!-- colunas -->
                <div class="col-sm-3 col-md-3 mb-4">
                    <!-- Imagem -->
                    <div class="foto-size p-4 col-md-12 text-center">
                        <a href="<?php echo site_url('cl_encomendas/selecionarProduto/'.$produto['id']); ?>">
                            <img src="
                                <?php if($produto['foto'] !== ""){
                                    echo base_url('assets/fotos/'.$produto['foto']);
                                }else{ 
                                    echo base_url('assets/fotos/sem_imagem.jpg');
                                }
                                ?>"
                                class="img-fluid img-thumbnail rounded mx-auto d-block"
                                width="60%" 
                                height="70%"
                            >
                        </a>
                    </div>
                    <!-- ./imagem -->

                    <!-- texto -->
                    <div class="col-md-12 text-center">
                        <!-- linha 1 -->
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h6><?php echo $produto['descricao']; ?></h6>
                                <h6><?php echo 'Preço Unitário R$ ' .$produto['valor_unitario']; ?></h6>
                            </div>
                        </div>
                        <!-- ./linha 1 -->
                    </div>
                    <!-- ./texto -->
                </div>
                <!-- ./colunas -->
            <?php endforeach; ?>
        </div>
        <!-- ./row -->
    <?php endif; ?>

    <br class="pt-6">

    <div class="col-12 mb-3 mt-3">
        <button type="submit"
            class="btn btn-sm btn-success btn-lg btn-block">
            CheckOut
            <i class="fa fa-cart-plus fa-lg"></i>
        </button>
    </div>

    <br class="pt-6">
    <hr class="mb-4">

    <!-- Emporio -->
    <h4 class="text-center pt-2 pb-3 text-red">Empório&nbsp;&nbsp;(Escolha seus Produtos)</h4>

    <?php if(count($produtosE) === 0 ): ?>
    
        <p class="text-center">Não tenho registro de produto.</p>
    
    <?php else: ?>    

        <div class="row">

            <?php foreach($produtosE as $produto): ?>
                <!-- colunas -->
                <div class="col-sm-3 col-md-3 mb-4 text-center">

                    <!-- Imagem -->
                    <div class="foto-size p-4 col-md-12 text-center">
                        <a href="<?php echo site_url('cl_encomendas/selecionarProduto/'.$produto['id']); ?>">
                            <img src="
                                <?php if($produto['foto'] !== ""){
                                    echo base_url('assets/fotos/'.$produto['foto']);
                                }else{ 
                                    echo base_url('assets/fotos/sem_imagem.jpg');
                                }
                                ?>"
                                class="img-fluid img-thumbnail rounded mx-auto d-block"
                                width="60%" 
                                height="70%"
                            >
                        </a>
                    </div>
                    <!-- ./imagem -->

                    <!-- texto -->
                    <div class="col-md-12 text-center">
                        <!-- linha 1 -->
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h6><?php echo $produto['descricao']; ?></h6>
                                <h6><?php echo 'Preço Unitário R$ ' .$produto['valor_unitario']; ?></h6>
                            </div>
                        </div>
                        <!-- ./linha 1 -->
                    </div>
                    <!-- ./texto -->
                </div>
                <!-- ./colunas -->
            <?php endforeach; ?>
        </div>
        <!-- ./row -->

        <br class="pt-6">

        <div class="col-12 mb-3 mt-3">
            <button type="submit"
                class="btn btn-sm btn-success btn-lg btn-block">
                CheckOut
                <i class="fa fa-cart-plus fa-lg"></i>
            </button>
        </div>

        <br class="pt-6">
        <hr class="mb-4">

    <?php endif; ?>

    </form>
    <!-- ./Form Geral -->
</div>