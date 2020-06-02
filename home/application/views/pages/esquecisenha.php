<div class="w3-container w3-margin-top w3-margin-bottom" style="margin:0 auto;width: 70%;text-align: center;">
    <img src="<?=base_url('assets/img/LogoBRT.png')?>">
</div>
<div class="w3-container w3-light-gray w3-border-blue-gray w3-rightbar w3-leftbar" style="margin:0 auto;width: 70%;text-align: center;">
    <br><br>
    <span class="w3-large"><b>Autenticação</b></span><br><br>
    <form id="formLogin" action="validaLoginIntranet.php" method="post" name="formLogin" autocomplete="off" enctype="multipart/form-data">
        <label for="login"><input type="number" name="numMatricula" id="numMatricula" placeholder="Matr&iacute;cula" size="22" maxlength="6"></label><br>
        <label for="senha"><input type="password" name="pasSenha" id="pasSenha" placeholder="Senha" size="20" maxlength="20"></label>
        <br><br>
        <button type="submit" class="w3-button w3-light-blue w3-text-white w3-card w3-border-deep-orange w3-border-right w3-round" style="width: 200px">Autenticar</button>
    </form>
    <br>
    <div class="w3-center w3-button w3-padding w3-card w3-light-gray w3-border-deep-orange w3-border-right w3-round">
        <a href="esqueciSenha.php">Esqueci senha / N&atilde;o tenho</a>
    </div>
    <br><br>
    <div class="w3-center w3-padding w3-large w3-light-blue w3-text-light-grey">
        Colaborador,<br>Crie sua senha selecionando "Primeiro acesso" <a href="esqueciSenha.php">aqui</a>.
    </div>
    <br>
</div>

