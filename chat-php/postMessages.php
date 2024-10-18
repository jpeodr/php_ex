<?php  
if (isset($_POST['nickname']) && isset($_POST['message'])) {  
    $nickname = htmlspecialchars($_POST['nickname']);  
    $message = htmlspecialchars($_POST['message']);  

    // Processar a imagem de perfil
    $imagemPerfil = '';
    if (isset($_FILES['imagemPerfil']) && $_FILES['imagemPerfil']['error'] == 0) {
        $imagemPerfil = 'uploads/' . basename($_FILES['imagemPerfil']['name']);
        move_uploaded_file($_FILES['imagemPerfil']['tmp_name'], $imagemPerfil);
        $imagemPerfil = "<img src='$imagemPerfil' alt='Imagem de perfil' style='width:50px; height:50px; border-radius:50%; object-fit:cover; margin-right:5px;'>";
    }

    // Processar a imagem da mensagem
    $imagemMensagem = '';
    if (isset($_FILES['imagemMensagem']) && $_FILES['imagemMensagem']['error'] == 0) {
        $imagemMensagem = 'uploads/' . basename($_FILES['imagemMensagem']['name']);
        move_uploaded_file($_FILES['imagemMensagem']['tmp_name'], $imagemMensagem);
        $imagemMensagem = "<img src='$imagemMensagem' alt='Imagem da mensagem' style='width:100px;height:100px;'>";
    }

    // Escrever no log com nova estrutura
    $log = fopen('chat.log', 'a');  
    fwrite($log, "<div style='display:flex; align-items:center; margin-bottom:10px; margin-left:20px;'><div style='display:flex; align-items:center;'>$imagemPerfil <strong>$nickname</strong>:&nbsp;<span>$message</span></div><br>$imagemMensagem</div>\n");
    fclose($log);  
}  
?>
