<?php
    defined('BASEPATH') OR exit('URL inválida.');

    $values = false;
    if($this->input->server('REQUEST_METHOD') == 'POST') $values = true;

?>

<div class="container-fluid bg-warnig">

    <!-- Fomr Geral -->
    <form  action="<?php echo site_url('cl_gelo/checkOut'); ?>" 
                    class="needs-validation" 
                    novalidate 
                    method="post">

    <!-- Gelo -->
    <h4 class="text-center pt-2 pb-3 text-red">Gelo&nbsp;&nbsp;(Escolha seus Produtos)</h4>
    <?php if(count($produtos) === 0 ): ?>
    
        <p class="text-center">Não tenho registro de produto.</p>
    
    <?php else: ?>    

        <div class="row">

            <?php foreach($produtos as $produto): ?>
                <!-- colunas -->
                <div class="col-sm-3 col-12 text-center">


                    <div class="foto-size p-4">
                        <img src="<?php echo base_url('assets/fotos/'.$produto['foto']); ?>"
                            class="img-thumbnail"
                            width="60%" 
                            height="70%"
                        >
                    </div>
                    <!-- ./imagem -->

                    <!-- texto -->
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 text-center">
                                <div class="p-2">
                                    <h5><?php echo $produto['descricao']; ?></h5>
                                    <h5><?php echo 'Preço Unitário R$ ' .$produto['valor_unitario']; ?></h5>
                                </div>
                            </div>

                            <div class="col-10 text-right">                            
                                <div class="col-4 form-check form-check-inline">
                                    <label>Quantidade:&nbsp; </label>
                                </div>

                                <div class="col-4 form-check form-check-inline">
                                    <input type="number"
                                        name="<?php echo 'text_qtde_encomenda_' .$produto['id'] ?>"
                                        class="form-control"
                                        placeholder = "Quantidade"
                                        value="0"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ./texto -->
                    <input type="hidden"
                        name="<?php echo 'text_produto_id_' . $produto['id']; ?>" 
                        value="<?php echo $produto['id']; ?>">

                        <input type="hidden"
                        name="<?php echo 'text_descricao_' . $produto['id']; ?>" 
                        value="<?php echo $produto['descricao']; ?>">

                        <input type="hidden"
                        name="<?php echo 'text_espec_' . $produto['id']; ?>" 
                        value="<?php echo $produto['espec']; ?>">

                        <input type="hidden"
                        name="<?php echo 'text_un_med_' . $produto['id']; ?>" 
                        value="<?php echo $produto['un_med']; ?>">

                        <input type="hidden"
                        name="<?php echo 'text_valor_unitario_' . $produto['id']; ?>" 
                        value="<?php echo $produto['valor_unitario']; ?>">

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
            Encomendar
            <i class="fa fa-cart-plus fa-lg"></i>
        </button>
    </div>
    </form>
    <!-- ./Form Geral -->
</div>