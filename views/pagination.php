<?php 
$numero_paginas = numero_paginas($total_inmuebles, $inmuebles_config['inmuebles_por_pagina']);
$pagina_actual = pagina_actual();
?>

<?php if($numero_paginas > 1): ?>
    <ul class="pagination-controls">

        <!-- Botón anterior -->
        <?php if($pagina_actual == 1): ?>
            <li class="prev-page disabled"><i class="fa-solid fa-angle-left"></i></li>
        <?php else: ?>
            <li>
                <a href="index.php?p=<?php echo $pagina_actual - 1;?>" class="prev-page"><i class="fa-solid fa-angle-left"></i></a>
            </li>
        <?php endif; ?> 

        <!-- Calcular el rango de páginas a mostrar -->
        <?php
            if ($numero_paginas <= 5) {
                $inicio = 1;
                $fin = $numero_paginas;
            } elseif ($pagina_actual <= 3) {
                $inicio = 1;
                $fin = 5;
            } elseif ($pagina_actual >= $numero_paginas - 2) {
                $inicio = $numero_paginas - 4;
                $fin = $numero_paginas;
            } else {
                $inicio = $pagina_actual - 2;
                $fin = $pagina_actual + 2;
            }

            // Asegurarse que inicio no sea menor a 1
            $inicio = max(1, $inicio);
            $fin = min($numero_paginas, $fin);

            for ($i = $inicio; $i <= $fin; $i++):
        ?>
            <?php if ($i == $pagina_actual): ?>
                <li class="active"><?php echo $i; ?></li>
            <?php else: ?>
                <li><a href="index.php?p=<?php echo $i;?>"><?php echo $i; ?></a></li>
            <?php endif; ?>
        <?php endfor; ?>

        <!-- Botón siguiente -->
        <?php if($pagina_actual == $numero_paginas): ?>
            <li class="next-page disabled"><i class="fa-solid fa-angle-right"></i></li>
        <?php else: ?>
            <li><a href="index.php?p=<?php echo $pagina_actual + 1?>"><i class="fa-solid fa-angle-right"></i></a></li>
        <?php endif; ?>
    </ul>
<?php endif; ?>


