<?php
    defined('BASEPATH') OR exit('No direct script access allowed.');
?>

<div class="container-fluid">
    <div class="row mt-1 mb-1">
        <div class="col-md-6 offset-md-3 col-8 offset-2">
            <div class="text-center p-2 alert alert-<?php echo $tipo; ?>">
                <p><?php echo $mensagem; ?></p>
            </div>
        </div>
    </div>
</div>