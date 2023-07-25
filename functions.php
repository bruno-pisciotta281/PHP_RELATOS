<?php

function generateUniqueId() {
    // Combinação de uniqid() com md5() para criar um ID único
    return md5(uniqid());
}

?>