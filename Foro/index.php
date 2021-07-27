<?php

$link = mysqli_connect('localhost', 'root', '', 'foro');

if (!$link) {
    exit('Error: No se pudo conectar con la base de datos (Puede ser el usuario, contraseña o servidor)');
}
$subject = $_GET['subj_id'];
$sql = "SELECT subj_name FROM subjects WHERE `subj_id` IN ('$subject')";
$result = mysqli_query($link, $sql);
$array = mysqli_fetch_array($result);
$header = "FORO ".$array[0];


include 'header.php';


$subject=$_GET['subj_id'];
$sql = "SELECT cat_id, cat_name, cat_description FROM categories WHERE `subj_id` IN ('$subject')";
$result = mysqli_query($link, $sql);

if (!$result) {
    echo 'No se pudieron mostrar las categorías, inténtelo de nuevo más tarde.';
} else {
    if (mysqli_num_rows($result) == 0) {
        echo 'Aun no hay catergorías definidas';
    } else {

        echo '<table class="listamateriaspa">
                    <tr>
                        <th>Categorias</th>
                        <th>Semestre</th>
                    </tr>';

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td class="leftpart">';
            echo "<h3><a href='category.php?subj_id=" . $row['cat_id'] . "'>" . $row['cat_name'] . '</a></h3>' . $row['cat_description'];
            echo '</td>';
            echo '<td class="rightpart">';
            echo '<a1 href="topic.php?id=">Ultimo Tema</a1>';
            echo '</td>';
            echo '</tr>';
        }
    }
}

include 'footer.php';
?>