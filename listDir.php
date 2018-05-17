<?PHP

if ($handle = opendir('./backup/backups/19/17')) {
    echo "Manipulador de diretório: $handle\n";
    echo "Arquivos:\n";

    /* Esta é a forma correta de varrer o diretório */
    while (false !== ($file = readdir($handle))) {
        echo "$file\n";
    }

    /* Esta é a forma INCORRETA de varrer o diretório 
    while ($file = readdir($handle)) {
        echo "$file\n";
    }*/

    closedir($handle);
}

?>