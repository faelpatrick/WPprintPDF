<?php
/*
Plugin name: RPS PrintPDF
Plugin uri: http://rafaelpatrick.com.br
Description: Plugin para imprimir conteudo do Wordpress em PDF
Version: 1.0
Author: Rafael Patrick de Souza
License: GPLy2 or later
*/
	



function add_print_btn(  $content) {
	echo "
<script  language='javascript' type='text/javascript'>
	
	if(window.location.href.indexOf('wp-') === -1){
    setTimeout(() => {

		console.log('RPS Print Load');
        let e = document.getElementsByClassName('entry-meta')[0];
        let bt = document.createElement('button');
        bt.innerText = 'PDF';
        bt.id = 'btnImprimir';
        bt.onclick = CriaPDF;
        if(e) e.appendChild(bt);

    }, 500);
}
	
    function CriaPDF() {
        var conteudo = document.querySelector('[id^=post-]').innerHTML;
        var style = '<style>';
        // style = style + '.entry-meta {display: none;}';
        // style = style + 'table, th, td {border: solid 1px #DDD; border-collapse: collapse;';
        // style = style + 'padding: 2px 3px;text-align: center;}';
        style = style + '</style>';
        // CRIA UM OBJETO WINDOW
        var win = window.open('', '', 'height=700,width=700');
        win.document.write('<html><head>');
        win.document.write('<title>Verbete</title>'); // <title> CABEÇALHO DO PDF.
        win.document.write(style); // INCLUI UM ESTILO NA TAB HEAD
        win.document.write('</head>');
        win.document.write('<body>');
        win.document.write(conteudo); // O CONTEUDO DA TABELA DENTRO DA TAG BODY
        win.document.write('</body></html>');
        win.document.close(); // FECHA A JANELA
        win.print(); // IMPRIME O CONTEUDO
    }
</script>
";
	return  $content;
}
add_filter('the_content', 'add_print_btn' );
?>
